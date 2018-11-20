<?php

class AddPoliceController extends Controler{
            
    function index() {
        
        if (isset($_POST['submit'])) {
            
            
            if(!isset($_POST['tip'])){
                $this->set('message', 'Izaberite tip polise!');
            } else {
                if(empty($_POST['carrier'])){
                    $this->set('message', 'Potrebno je Ime i prezime nosioca polise!'); 
                }
                if(empty($_POST['tel'])){ 
                    $this->set('message', 'Potreban je Telefon nosioca polise!');
                }
                if(empty($_POST['c_email'])){ 
                    $this->set('message', 'Potrebna je Email adresa nosioca polise!'); 
                }
                if(empty($_POST['from'])){ 
                    $this->set('message', 'Potreban je datup pocetka polise!'); 
                }
                if(empty($_POST['to'])){ 
                    $this->set('message', 'Potreban je datup zavrsetka polise!'); 
                }
                
                $json = [
                    "carrier" => filter_input(INPUT_POST, 'carrier'),
                    "carrier_tel" => filter_input(INPUT_POST, 'tel'),
                    "carrier_email" => filter_input(INPUT_POST, 'c_email'),
                    "police_from" => filter_input(INPUT_POST, 'from'),
                    "police_to" => filter_input(INPUT_POST, 'to')
                ];
                
                if($_POST['tip'] == 1){
                    
                    if(empty($_POST['name_o'])){ 
                        $this->set('message', 'Potrebno je Ime osiguranika!'); 
                    }
                    if(empty($_POST['surname_o'])){ 
                        $this->set('message', 'Potrebno je Prezime osiguranika'); 
                    }
                    if(empty($_POST['email_o'])){ 
                        $this->set('message', 'Potrebna je Email adresa osiguranika'); 
                    }
                    if(empty($_POST['date_o'])){ 
                        $this->set('message', 'Potreban je Datum rodjenja osiguranika'); 
                    }
                    
                    $user = [
                        "name" => filter_input(INPUT_POST, 'name_o'),
                        "surname" => filter_input(INPUT_POST, 'surname_o'),
                        "email" => filter_input(INPUT_POST, 'email_o'),
                        "born" => filter_input(INPUT_POST, 'date_o'),
                    ];
                    
                    $json['users'][] = $user;
                    
                }else{
                    
                    $users = [];
                    
                    foreach ($_POST['name'] as $key => $value){
                        if(empty($value)){
                            $x = $key + 1;
                            $this->set('message', "Potrebno je Ime $x. osiguranika!"); 
                        }else{
                            if(empty($users)){
                                $users[]['name'] = $value; 
                            }else{
                                if(!array_key_exists($key, $users)){
                                    $users[$key]['name'] = $value;
                                } else {
                                    $users[$key]['name'] = $value;
                                }
                            }
                        }
                    }
                    foreach ($_POST['surname'] as $key => $value){
                        if(empty($value)){
                            $x = $key + 1;
                            $this->set('message', "Potrebno je Prezime $x. osiguranika!"); 
                        } else {
                            if(empty($users)){
                                $users[]['surname'] = $value; 
                            }else{
                                if(!array_key_exists($key, $users)){
                                    $users[$key]['surname'] = $value;
                                } else {
                                    $users[$key]['surname'] = $value;
                                }
                            }
                        }
                    }
                    foreach ($_POST['email'] as $key => $value){
                        if(empty($value)){
                            $x = $key + 1;
                            $this->set('message', "Potrebna je Email adresa $x. osiguranika!"); 
                        } else {
                            if(empty($users)){
                                $users[]['email'] = $value; 
                            }else{
                                if(!array_key_exists($key, $users)){
                                    $users[$key]['email'] = $value;
                                } else {
                                    $users[$key]['email'] = $value;
                                }
                            }
                        }
                    }
                    foreach ($_POST['date'] as $key => $value){
                        if(empty($value)){
                            $x = $key + 1;
                            $this->set('message', "Potreban je Datum rodjenja $x. osiguranika!"); 
                        } else {
                            if(empty($users)){
                                $users[]['born'] = $value; 
                            }else{
                                if(!array_key_exists($key, $users)){
                                    $users[$key]['born'] = $value;
                                } else {
                                    $users[$key]['born'] = $value;
                                }
                            }
                        }
                    }
                    
                    $json['users'] = $users;
                    
                }
                
                // make pdf
                $pdf = $this->makePDF($json);
                $pdf_url = Configuration::BASE.Configuration::PDF_LOCATION.'table.pdf';
                
                // update DB
                foreach ($json['users'] as $user){
                    PolicyModel::addUserPolicy($json['carrier'], $json['carrier_tel'],
                            $json['carrier_email'], $json['police_from'], $json['police_to'],
                            $user['name'], $user['surname'], $user['email'], $user['born']);
                    
                    // send mail to users
                    $this->sendMail($user['email'], $pdf_url);
                }
                
                // send mail to carrier of police
                $mail = $this->sendMail($json['carrier_email'], $pdf_url);
                
                if($mail){
                    unset($pdf_url);
                }
                
                Misc::redirect('paragraf');
               
            }
        }
    }
    
    private function sendMail($email, $pdf){
        
        $html = '<!DOCTYPE html><html><head></head><body>';
        $html .= 'U pilogu se nalazi pfg sa novim korisnicima.';
        $html .= '</body></html>';
        
        $mailer = new \PHPMailer\PHPMailer\PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = Configuration::MAIL_HOST;
        $mailer->Port = Configuration::MAIL_PORT;
        $mailer->SMTPSecure = Configuration::MAIL_PROTOCOL;
        $mailer->SMTPAuth = true;
        $mailer->Username = Configuration::MAIL_USERNAME;
        $mailer->Password = Configuration::MAIL_PASSWORD;
        
        $mailer->isHTML(true);
        $mailer->Bodyy = $html;
        $mailer->Subject = 'Nova Polisa';
        $mailer->addAttachment($pdf);
        $mailer->setFrom(Configuration::MAIL_USERNAME);
        
        $mailer->addAddress($email);
        
        $mailer->send();
        
    }
    
    private function makePDF($array){
        
        $html = '
        
            <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nosioc osiguranja</th>
                <th scope="col">Telefon</th>
                <th scope="col">Email</th>
                <th scope="col">Datum putovanja</th>
                <th scope="col">Osiguranik</th>
                <th scope="col">Osiguranik Email</th>
                <th scope="col">Osiguranik Datum Rodnjenja</th>
              </tr>
            </thead>
            <tbody>';
        
        foreach ($array['users'] as $key => $user){
            $html .= '<tr>
                  <th scope="row">'. $key .'</th>
                  <th scope="row">'. $array['carrier'] .'</th>
                  <th scope="row">'. $array['carrier_tel'] .'</th>
                  <th scope="row">'. $array['carrier_email'] .'</th>
                  <th scope="row">'. $array['police_from'] .' - '. $array['police_to'] .'</th>
                  <th scope="row">'. $user['name'] .' '. $user['surname'] .'</th>
                  <th scope="row">'. $user['email'] .'</th>
                  <th scope="row">'. $user['born'] .'</th>
                </tr>';
                  
        };
                
        $html .= '</tbody></table>';
        
        $mpdf = new Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output(Configuration::ABS_PATH.Configuration::PDF_LOCATION.'table.pdf','F');
        
    }
}
