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

        $user_b = $this->get_user_or_redirect();
        $user = user::get_user_by_mail($user_b->mail) ;
        $password = $user->hashed_password;
        $errors = [];
        $user_name = $user->full_name ;
        $user_mail= $user->mail ;
        $user_iban = $user->iban ;
        if (isset($_POST['full_name'])) {
            $user_name = $_POST['full_name'];
            $user_mail=  $_POST['mail'];
            $user_iban = $_POST['iban'];
            $user_befor = user::get_user_by_mail($user->mail);
            $errors = user::validate_name($user_name);
            if (!empty($user_iban)){
                $errors = array_merge($errors, user::validate_iban($user_iban));
            }
            if (count($errors) == 0) {
                $user->update($user_mail, $user_name,$user_iban, $password, $user_befor->id);
                $this->redirect("settings", "settings");
            }

        }
        (new View("edit_profile"))->show(["user" => $user, "errors" => $errors,"user_name" => $user_name
            ,"user_mail" => $user_mail,"user_iban" => $user_iban]);
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
        if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            $p = $_POST['current_password'];
            $np = $_POST['new_password'];
            $cp = $_POST['confirm_password'];
            $errors = user::validate_password_change_Pass($mail, $p, $np, $cp);
            $po = Tools::my_hash($np);
            if (empty($errors)) {
                $user->update($mail, $name, $iban, $po, $user->id);
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
        $errors = [];

        $a = "aaaaa" ;

        (new View("settings"))->show(["user" => $user,"a"=>$a , "errors"=>$errors]);
    }


}










