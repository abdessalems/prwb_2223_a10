<?php

require_once 'model/user.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerMain extends Controller {

 
    public function index() : void {
        if ($this->user_logged()) {
            $this->redirect("user", "full_name");
        } else {
            (new View("login"))->show();
        }
    }

    //gestion de la connexion d'un utilisateur
    public function login() : void {
        $mail = '';
        $password = '';
        $errors = [];
        if (isset($_POST['mail']) && isset($_POST['password'])) { //note : pourraient contenir des chaînes vides
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            $errors = user::validate_login($mail, $password);
            if (empty($errors)) {
                $this->log_user(user::get_user_by_mail($mail));
            }
        }
        (new View("login"))->show(["mail" => $mail, "password" => $password, "errors" => $errors]);
    }

    

}
