<?php

require_once "framework/Model.php";

class user extends Model {



    public function __construct(public string $mail, public string $hashed_password) {
        
        echo "LOGIN WORK NOW<br>";
        echo "LOGIN DONE <br>";
    }

    private static function check_password(string $clear_password, string $hash) : bool {
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
            $errors[] = "Can't find a member with the email '$mail'. Please sign up.";
        }
        return $errors;
    }
    public static function get_user_by_mail(string $mail) : user|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
           
            return new user($data["mail"], $data["hashed_password"]);
        }

    }




}