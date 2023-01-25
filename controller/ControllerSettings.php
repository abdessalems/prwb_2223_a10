<?php

require_once 'model/user.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerSettings extends Controller
{


    //page d'accueil.
    public function index(): void
    {
        $this->settings();
    }

    public function edit_profile(): void
    {
        $user = $this->get_user_or_redirect();
        $password = $user->hashed_password;
        if (isset($_POST['mail'])) {
            $mail = $_POST['mail'];
            $full_name = $_POST['full_name'];
            $iban = $_POST['iban'];
            $user->update($mail, $full_name, $iban, $password);
            $this->redirect("settings", "settings");
        } else {

            (new View("edit_profile"))->show(["user" => $user]);
        }
    }
    


    public function login(): void
    {
        $mail = '';
        $password = '';
        $errors = [];
        if (isset($_POST['mail']) && isset($_POST['password'])) {
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            $errors = user::validate_login($mail, $password);
            if (empty($errors)) {
                $this->log_user(user::get_user_by_mail($mail));
            }
        }
        (new View("login"))->show(["mail" => $mail, "password" => $password, "errors" => $errors]);
    }

    public function settings(): void
    {
        $user = $this->get_user_or_redirect();

        // $mail = $_POST['mail'];
        // $user = $user::get_user_by_mail($mail);

        (new View("settings"))->show(["user" => $user]);

    }


}










