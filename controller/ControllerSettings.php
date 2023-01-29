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
            $user_befor =user::get_user_by_mail($user->mail) ;
            $user->mail=$mail;
            var_dump($user_befor);
            $user->full_name=$full_name;
            $user->iban=$iban;
            $user->update($user_befor->id,$mail, $full_name, $iban, $password);
            $this->redirect("settings", "settings");
        }
        (new View("edit_profile"))->show(["user" => $user]);

    }


    public function change_password(): void
    {
        $user = $this->get_user_or_redirect();
        $p = ""; 
        $np = "";
        $cp = "";
        $errors = [];
        $name = $user->full_name;
        $iban = $user->iban;
        $mail = $user->mail;
        if (isset($_POST['password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            $p = $_POST['password'];
            $np = $_POST['new_password'];
            $cp = $_POST['confirm_password'];
            $errors = user::validate_password_change_Pass($mail, $p, $np, $cp);
            $po = Tools::my_hash($np);
            if (empty($errors)) {
                $user->update($user->id,$mail, $name, $iban, $po);
                $this->redirect("settings", "settings");
            }
        }
        (new View("change_password"))->show(["user" => $user, "errors" => $errors]);

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










