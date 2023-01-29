<?php

require_once "framework/Model.php";
require_once 'model/Tricount.php';

<<<<<<< HEAD
=======
class user extends Model
{
>>>>>>> feat_UC_edit_operation

class user extends Model
{

<<<<<<< HEAD
    public function __construct(public int $id,public string $mail, public string $hashed_password, public string $full_name, public ?string $iban )
    {
    }
=======
    public function __construct(public int $id, public string $mail, public string $hashed_password, public string $full_name, public float $amount, public ?int $weight = null)
    {
>>>>>>> feat_UC_edit_operation


    private static function check_password(string $clear_password, string $hash): bool
    {
        return $hash === Tools::my_hash($clear_password);
    }

<<<<<<< HEAD
    public static function validate_password_change_Pass(string $mail, string $current_password, string $new_password, string $confirm_password): array
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
=======
    public static function get_amount_operations(operation $operation, int $nbr_repartition): array
    {
        $operation_amount = $operation->amount;
        $operations_with_amount = [];

        $query = self::execute("SELECT * FROM users INNER JOIN repartitions on users.id=repartitions.user AND repartitions.operation = :operation ORDER BY `repartitions`.`weight` DESC", ["operation" => $operation->id]);
        $data = $query->fetchAll();
        $total_weight = 0;
        foreach ($data as $row) {
            $total_weight = $total_weight + $row['weight'];
        }
        foreach ($data as $row) {
            $amount_for_this_person = ($operation_amount / $total_weight) * ($row['weight']);
            $operations_with_amount[] = new user($row['id'], $row['mail'], $row['hashed_password'], $row['full_name'], $amount_for_this_person, $row['weight']);
        }
        return $operations_with_amount;

    }


    private static function check_password(string $clear_password, string $hash): bool
    {
        // echo Tools::my_hash($clear_password);
        return $hash === Tools::my_hash($clear_password);
>>>>>>> feat_UC_edit_operation
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


=======
>>>>>>> feat_UC_edit_operation
    public static function get_user_by_mail(string $mail): user|false
    {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail" => $mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
<<<<<<< HEAD
            return new user($data["id"],$data["mail"],$data["hashed_password"],$data["full_name"], $data["iban"]);
=======

            return new user($data["id"], $data["mail"], $data["hashed_password"], $data["full_name"], 0);
>>>>>>> feat_UC_edit_operation
        }

    }


    public function get_user_by_id(int $id): user|false
    {
        $query = self::execute("SELECT * FROM users where id = :id", ["id" => $id]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {



            return new user($data["id"],$data["mail"],$data["hashed_password"],$data["full_name"], $data["iban"]);
        }

    }


    public function update(int $id,string $mail, string $full_name, string $iban, string $password): user
    {
        if (self::get_user_by_id($id)) {
            self::execute("UPDATE users SET mail= :mail,hashed_password= :password, full_name= :full_name,iban= :iban WHERE id= :id ",
                ["mail" => $mail, "password" => $password, "full_name" => $full_name, "iban" => $iban, "id" => $id]);
        } else {
            self::execute("INSERT INTO users(mail,password,full_name,role,iban,id) VALUES(:mail,:password,:full_name,:role,:iban,:id)",
                ["mail" => $this->mail, "password" => $this->hashed_password, "full_name" => $this->full_name,
                    "role" => $this->role, "iban" => $this->iban, "id" => $id]);
        }
        return $this;
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


