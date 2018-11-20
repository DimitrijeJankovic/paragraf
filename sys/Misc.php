<?php
    final class Misc {
        public static function url($link, $text){
            echo '<a href="' .Configuration::BASE . $link. '">' .$text. '</a>';
        }
        
        public static function redirect($link){
            ob_clean();
            header('Location: '.Configuration::BASE.$link);
            exit;
        }
        
        public static function print_r($variable){
            echo '<pre>';
            print_r($variable);
            echo '</pre>';
            die();
        }
        
    }
