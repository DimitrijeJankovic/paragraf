<?php
class PolicyModel implements ModelInterface {
    public static function getAll() {
        $SQL = 'SELECT * FROM policie ORDER BY policie_id;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute();
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
   
    public static function getById($policie_id) {
        $policie_id = intval($policie_id);
        $SQL = 'SELECT * FROM policie WHERE policie_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$policie_id]);
        return $prep->fetch(PDO::FETCH_OBJ);
    }
    
    public static function addUserPolicy($insurance_carrier, $mobile, $email, 
            $starting_date, $end_date){
        $SQL = 'INSERT INTO policie(carrier_of_policy, car_mobile, car_email,
            starts, ends) VALUES (?, ?, ?, ?, ?);';
        $prep = DataBase::getInstance()->prepare($SQL);
        return $prep->execute([$insurance_carrier, $mobile, $email, $starting_date, $end_date]);
    }

    public static function policePrint($police_id){
        $police_id = intval($police_id);
        $SQL = 'SELECT * FROM `policie`
                INNER JOIN insured ON policie.policie_id = insured.policie_id
                WHERE policie.policie_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$police_id]);
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
}
