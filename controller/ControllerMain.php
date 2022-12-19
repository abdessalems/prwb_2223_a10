<?php

require_once 'model/Member.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerMain extends Controller {
    public function index() : void {
        echo "<h1>Heyjj!</h1>";
    }

    public function signup() : void {
        $email = '';
        $fullname = '';
        $iban = '';
        $password = '';
        $password_confirm = '';
        $errors = [];

       
        (new View("signup"))->show(["email" => $email,"fullname" =>$fullname,"iban" =>$iban, "password" => $password, 
                                         "password_confirm" => $password_confirm, "errors" => $errors]);
    }

}