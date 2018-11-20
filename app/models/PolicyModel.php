<?php
class PolicyModel implements ModelInterface {
    public static function getAll() {
        $SQL = 'SELECT * FROM policy ORDER BY policy_id;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute();
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
   
    public static function getById($user_id) {
        $user_id = intval($user_id);
        $SQL = 'SELECT * FROM policy WHERE policy_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$user_id]);
        return $prep->fetch(PDO::FETCH_OBJ);
    }
    
    public static function addUserPolicy($insurance_carrier, $mobile, $email, 
            $starting_date, $end_date, $name_of_insured, $surname_of_insured, 
            $email_of_insured, $date_of_birth_of_insured){
        $SQL = 'INSERT INTO policy(insurance_carrier, mobile, email, starting_date, '
                . 'end_date, name_of_insured, surname_of_insured, email_of_insured, '
                . 'date_of_birth_of_insured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';
        $prep = DataBase::getInstance()->prepare($SQL);
        return $prep->execute([$insurance_carrier, $mobile, $email, $starting_date, 
            $end_date, $name_of_insured, $surname_of_insured, $email_of_insured, 
            $date_of_birth_of_insured]);
    }
}
