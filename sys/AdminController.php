<?php
    class AdminController extends Controler{
        final function __pre(){
            if(!Session::exists('user_id')){
                Misc::redirect('login');
            }
            
        }
    }
