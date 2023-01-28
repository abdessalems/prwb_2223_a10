<?php

require_once "framework/Model.php";
require_once 'model/Tricount.php';

<<<<<<< HEAD
class User extends Model {
=======
class user extends Model
{
>>>>>>> 987c348893f1bd3714da1a2254501512f4bce987


    public function __construct(public string $mail, public string $hashed_password, public string $full_name, public string $role, public string $iban, public int $id)
    {

    }


    private static function check_password(string $clear_password, string $hash): bool
    {
        return $hash === Tools::my_hash($clear_password);
    }

    public static function validate_password(string $mail, string $current_password, string $new_password, string $confirm_password): array
    {
        $errors = [];
        $user = user::get_user_by_mail($mail);
        if (!self::check_password($current_password, $user->hashed_password)) {
            $errors [] = "The current password has been Wrong , please try again . ";
        }
        if ($new_password != $confirm_password) {
            $errors [] = "the confirm password diffirent on ur new password , please try again . ";
        }
        if ($new_password == $current_password) {
            $errors [] = "the current password must be diffirent from the old one  . ";
        }
        return $errors;
    }

    public static function validate_login(string $mail, string $password): array
    {
        $errors = [];
        $user = user::get_user_by_mail($mail);
        if ($user) {
            if (!self::check_password($password, $user->hashed_password)) {
                $errors[] = "Wrong password. Please try again.";

            }
        } else {
            $errors[] = "Can't find a user with the email '$mail'. Please sign up.";
        }
        if (empty($errors)) {
            echo " emmpty errors";
        }
        return $errors;
    }

<<<<<<< HEAD
    public static function get_user_by_mail(string $mail) :User|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
=======

    public static function get_user_by_mail(string $mail): user|false
    {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail" => $mail]);
>>>>>>> 987c348893f1bd3714da1a2254501512f4bce987
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            return new user($data["mail"], $data["hashed_password"], $data["full_name"], $data["role"], $data["iban"], $data["id"]);
        }

    }

    public function get_user_by_id(int $id): user|false
    {
        $query = self::execute("SELECT * FROM users where id = :id", ["id" => $id]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            return new user($data["mail"], $data["hashed_password"], $data["full_name"], $data["role"], $data["iban"], $data["id"]);
        }

    }

    public function update(string $mail, string $full_name, string $iban, string $password): user
    {
        if (self::get_user_by_id($this->id)) {
            self::execute("UPDATE users SET mail= :mail,hashed_password= :password, full_name= :full_name,iban= :iban WHERE id= :id ",
                ["mail" => $mail, "password" => $password, "full_name" => $full_name, "iban" => $iban, "id" => $this->id]);
        } else {
            self::execute("INSERT INTO users(mail,password,full_name,role,iban,id) VALUES(:mail,:password,:full_name,:role,:iban,:id)",
                ["mail" => $this->mail, "password" => $this->hashed_password, "full_name" => $this->full_name,
                    "role" => $this->role, "iban" => $this->iban, "id" => $this->id]);
        }
        return $this;
    }

}




