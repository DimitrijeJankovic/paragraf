<?php

if(isset($_POST['method'])){
    echo $_POST['method']();
}

class MainController extends Controler {
   
    function index() {  

        $policies = PolicyModel::getAll();

        if(!empty($policies)){

            foreach($policies as $policie){
                $policie->starts = date("d.m.Y", strtotime($policie->starts));
                $policie->ends = date("d.m.Y", strtotime($policie->ends));
            }

            $this->set('policies', $policies);
        }else{
            $this->set('message', 'Trenutno ne postoji ni jedna polisa!');
        }  
    }

    function addPolice(){

        if (isset($_POST['submit'])) {

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

            $carrier = filter_input(INPUT_POST, 'carrier');
            $carrier_tel = filter_input(INPUT_POST, 'tel');
            $carrier_email = filter_input(INPUT_POST, 'c_email');
            $police_from = filter_input(INPUT_POST, 'from');
            $police_to = filter_input(INPUT_POST, 'to');

            $res = PolicyModel::addUserPolicy($carrier, $carrier_tel, $carrier_email, $police_from, $police_to);

            if($res){
                Misc::redirect('paragraf');
            }else{
                $this->set('message', 'Nova polisa neuspesno kreirana!'); 
            }

        }
    }

    public function printPolice($police_id){
        $usersPolicePrint = PolicyModel::policePrint($police_id);
        $this->set('users', $usersPolicePrint);
    }

    public function addUsersToPolice($police_id){
        
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

        foreach ($users as $user){
            $name = $user['name']." ".$user['surname'];
            InsuredModel::addInsured($police_id, $name, $user['email'], $user['born']);
        }

        $return = new stdClass();
        $return->success = true;
        $return->errorMeesage = '';
        $return->data['users'] = $users;

        $json = json_encode($return);
        
        echo $json;
    }

}

function getUsersForPolice(){

    if(isset($_POST['policie_id'])){
        $id = $_POST['policie_id'];

        $res = InsuredModel::getByPolicieId($id);

        foreach($res as $r){
            $r->born = date("d.m.Y", strtotime($r->born));
        }

        $return = new stdClass();
        $return->success = true;
        $return->errorMeesage = '';
        $return->data['users'] = $res;

        $json = json_encode($return);
        
        echo $json;

    }else{
        echo 'Error';
    }

}
