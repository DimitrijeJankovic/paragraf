<?php

$html = '
    <h3>Polisa Osiguranja</h3>
    <table class="table" style="border: 1px solid black;">
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
    <tbody>
';

foreach ($DATA['users'] as $key => $user){
    $html .= '<tr>
          <th scope="row">'. $key .'</th>
          <th scope="row">'. $user->carrier_of_policy .'</th>
          <th scope="row">'. $user->car_mobile .'</th>
          <th scope="row">'. $user->car_email .'</th>
          <th scope="row">'. $user->starts .' - '. $user->ends .'</th>
          <th scope="row">'. $user->name .'</th>
          <th scope="row">'. $user->insured_email .'</th>
          <th scope="row">'. $user->born .'</th>
        </tr>';
          
};

$html .= '</tbody></table>';
$mpdf = new Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();