<?php

require_once "framework/Model.php";
require_once 'model/Tricount.php';

class User extends Model {



    public function __construct(public int $id,public string $mail, public string $hashed_password) {
        

    }

    private static function check_password(string $clear_password, string $hash) : bool {
        // echo Tools::my_hash($clear_password);
        return $hash === Tools::my_hash($clear_password);
    }

    public static function validate_login(string $mail, string $password) : array {
        $errors = [];
        $user = user::get_user_by_mail($mail);
        if ($user) {
            if (!self::check_password($password, $user->hashed_password)) {
                $errors[] = "Wrong password. Please try again.";

            }
        } else {
            $errors[] = "Can't find a user with the email '$mail'. Please sign up.";
        }
        return $errors;
    }

    public static function get_user_by_mail(string $mail) :User|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
           
            return new user($data["id"],$data["mail"], $data["hashed_password"]);
        }

    }



}




