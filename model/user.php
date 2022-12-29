<?php

require_once "framework/Model.php";

class user extends Model {



    public function __construct(public string $mail, public string $hashed_password, public string $full_name, public string $role , public ?string $iban = null) {
    }
    public static function get_user_by_mail(string $mail) : user|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
           
            return new user($data["mail"],$data["full_name"],$data["iban"], $data["hashed_password"]);
        }

    }
    private static function validate_password(string $password) : array {
        $errors = [];
        if (strlen($password) < 8 || strlen($password) > 16) {
            $errors[] = "Password length must be between 8 and 16.";
        } if (!((preg_match("/[A-Z]/", $password)) && preg_match("/\d/", $password) && preg_match("/['\";:,.\/?!\\-]/", $password))) {
            $errors[] = "Password must contain one uppercase letter, one number and one punctuation mark.";
        }
        return $errors;
    }
    public static function validate_iban(string $iban) : array{
        $errors = [];
        
        return $errors ;
    }

    public static function validate_passwords(string $password, string $password_confirm) : array {
        $errors = user::validate_password($password);
        if ($password != $password_confirm) {
            $errors[] = "You have to enter twice the same password.";
        }
        return $errors;
    }

    public static function validate_unicity(string $mail) : array {
        $errors = [];
        $member = self::get_user_by_mail($mail);
        if ($member) {
            $errors[] = "This user already exists.";
        } 
        return $errors;
    }
    public function persist() : user {
        if(self::get_user_by_mail($this->mail))
           self::execute("UPDATE users SET mail:=mail, full_name=:full_name, iban=:iban WHERE =mail:mail ", 
                         ["mail"=>$this->mail, ""=>$this->profile, "pseudo"=>$this->pseudo, "password"=>$this->hashed_password]);
        else
            self::execute("INSERT INTO users(mail,hashed_password,full_name,iban) VALUES(:mail,:hashed_password,:full_name,:iban)", 
                          ["pseudo"=>$this->mail, "password"=>$this->hashed_password, "full_name"=>$this->full_NAME, "iban"=>$this->iban]);
        return $this;
    }

}