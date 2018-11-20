<?php
class MainController extends Controler {
   
    function index() {  
        
        $this->set('users', PolicyModel::getAll());
   
    }

}
