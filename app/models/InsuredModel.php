<?php

class InsuredModel implements ModelInterface {

    public static function getAll() {
        $SQL = 'SELECT * FROM insured ORDER BY insured_id;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute();
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
   
    public static function getById($user_id) {
        $user_id = intval($user_id);
        $SQL = 'SELECT * FROM insured WHERE insured_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$user_id]);
        return $prep->fetch(PDO::FETCH_OBJ);
    }

    public static function getByPolicieId($id){
        $id = intval($id);
        $SQL = 'SELECT * FROM insured WHERE policie_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$id]);
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }

    public static function addInsured($policie_id, $name, $email, $born){
        $SQL = 'INSERT INTO insured(policie_id, name, insured_email, born) VALUES (?, ?, ?, ?);';
        $prep = DataBase::getInstance()->prepare($SQL);
        return $prep->execute([$policie_id, $name, $email, $born]);
    }

}