<?php

require_once 'model/user.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerMain extends Controller {
    public function index() : void {
        if ($this->user_logged()) {
            $this->redirect("user", "full_name");
        } else {
            (new View("signup"))->show();
        }
    }

    public function signup() : void {
        $email = '';
        $fullname = '';
        $iban = '';
        $password = '';
        $password_confirm = '';
        $errors = [];


        if (isset($_POST['email']) && isset($_POST['fullname']) && isset($_POST['iban'])&& isset($_POST['password']) && isset($_POST['password_confirm'])) {
            $email = $_POST['email'];
            $fullname = trim($_POST['fullname']);
            $iban = $_POST['iban'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            $user = new user ($email,$fullname,$iban, Tools::my_hash($password));
            $errors = user::validate_unicity($email);
            $errors = array_merge($errors, $user->validate());
            $errors = array_merge($errors, user::validate_passwords($password, $password_confirm));

            if (count($errors) == 0) { 
                $user->persist(); //sauve l'utilisateur
                $this->log_user($user);
            }
        }

       
        (new View("signup"))->show(["email" => $email,"fullname" =>$fullname,"iban" =>$iban, "password" => $password, 
                                         "password_confirm" => $password_confirm, "errors" => $errors]);
    }

}