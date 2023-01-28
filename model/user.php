<?php

require_once "framework/Model.php";
require_once 'model/Tricount.php';




class user extends Model
{

    public function __construct(public string $mail, public string $hashed_password, public string $full_name, public ?string $iban = null)
    {
    }


//    private static function check_password(string $clear_password, string $hash): bool
//    {
//        return $hash === Tools::my_hash($clear_password);
//    }
//
//    public static function validate_password(string $mail, string $current_password, string $new_password, string $confirm_password): array
//    {
//        $errors = [];
//        $user = user::get_user_by_mail($mail);
//        if (!self::check_password($current_password, $user->hashed_password)) {
//            $errors [] = "The current password has been Wrong , please try again . ";
//        }
//        if ($new_password != $confirm_password) {
//            $errors [] = "the confirm password diffirent on ur new password , please try again . ";
//        }
//        if ($new_password == $current_password) {
//            $errors [] = "the current password must be diffirent from the old one  . ";
//        }
//        return $errors;
//    }
//
//    public static function validate_login(string $mail, string $password): array
//    {
//        $errors = [];
//        $user = user::get_user_by_mail($mail);
//        if ($user) {
//            if (!self::check_password($password, $user->hashed_password)) {
//                $errors[] = "Wrong password. Please try again.";
//
//            }
//        } else {
//            $errors[] = "Can't find a user with the email '$mail'. Please sign up.";
//        }
//        if (empty($errors)) {
//            echo " emmpty errors";
//        }
//        return $errors;
//    }


    public static function get_user_by_mail(string $mail): user|false
    {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail" => $mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            return new user($data["mail"], $data["full_name"], $data["iban"], $data["hashed_password"]);
        }

    }

    private static function validate_password(string $password): array
    {
        $errors = [];
        if (strlen($password) < 8 || strlen($password) > 16) {
            $errors[] = "Password length must be between 8 and 16.";
        }
        if (!((preg_match("/[A-Z]/", $password)) && preg_match("/\d/", $password) && preg_match("/['\";:,.\/?!\\-]/", $password))) {
            $errors[] = "Password must contain one uppercase letter, one number and one punctuation mark.";
        }
        return $errors;
    }

    public static function validate_name(string $full_name): array
    {
        $errors = [];
        if (strlen($full_name) == 0) {
            $errors[] = "Name is required";
        }
        if (!preg_match("/^[a-zA-Zz]*$/", $full_name)) {
            $errors[] = "Name should contain only letters";
        }
        return $errors;

    }

}


