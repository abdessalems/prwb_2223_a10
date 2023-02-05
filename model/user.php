<?php

require_once "framework/Model.php";
require_once 'model/Tricount.php';

class user extends Model
{


//    public function __construct(public int $id, public string $mail,
// public string $hashed_password, public string $full_name, public ?string $iban ,
// public ?float $amount =null, public ?int $weight = null)
//    {}


    public function __construct(public string $mail, public string $hashed_password, public string $full_name, public ?string $iban = null, public ?int $id = null, public ?float $amount = null, public ?int $weight = null)
    {
    }

    private static function check_password(string $clear_password, string $hash): bool
    {

        return $hash === Tools::my_hash($clear_password);
    }


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
        $errors = array_merge($errors, user::validate_password($current_password));
        $errors = array_merge($errors, user::validate_password($confirm_password));


        return $errors;

    }

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


            $operations_with_amount[] = new user($row['mail'], $row['hashed_password'], $row['full_name'], $row['iban'], $row['id'], $amount_for_this_person, $row['weight']);
        }
        return $operations_with_amount;

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



//    public static function get_user_by_mail(string $mail): user|false
//    {
//        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail" => $mail]);
//        $data = $query->fetch(); // un seul résultat au maximum
//        if ($query->rowCount() == 0) {
//            return false;
//        } else {
//            return new user($data['id'], $data['mail'], $data['hashed_password'], $data['full_name'],$data['iban']);
//
//        }
//
//    }
    public static function get_user_by_mail(string $mail): user|false
    {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail" => $mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            //(public string $mail, public string $hashed_password, public string $full_name, public ?string $iban = null,public ?int $id=null,public ?float $amount =null, public ?int $weight = null) {


            return new user($data["mail"], $data["hashed_password"], $data["full_name"], $data["iban"], $data['id']);
        }

    }


    public function get_user_by_id(int $id): user|false
    {
        $query = self::execute("SELECT * FROM users where id = :id", ["id" => $id]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {


            return new user($data["mail"], $data["hashed_password"], $data["full_name"], $data["iban"], $data["id"]);
        }

    }

    /**
     * Update an existing user in the database
     * @param int $id
     * @param string $mail
     * @param string $full_name
     * @param string $iban
     * @param string $password
     * @return $this
     */

    public function update(string $mail, string $full_name, string $iban, string $password, int $id): user
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

    /**
     * Insert a new user to the database
     * @param string $mail
     * @param string $full_name
     * @param string $iban
     * @param string $hashed_password
     * @return $this
     */
    public function insert(string $mail, string $full_name, string $iban, string $hashed_password): user
    {
        self::execute("INSERT INTO users(mail,password,full_name,role,iban) VALUES(:mail,:password,:full_name,:role,:iban)",
            ["mail" => $mail, "password" => $hashed_password, "full_name" => $full_name,
                "iban" => $iban]);
        return $this;
    }


    public static function validate_password(string $password): array
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


    public static function validate_iban(string $iban): array
    {
        $errors = [];
        echo strlen($iban) == 16;
        if (!strlen($iban) == 16) {
            $errors[] = "Iban should contain 16 caracters";
        }
        return $errors;
    }

    public static function validate_passwords(string $password, string $password_confirm): array
    {
        $errors = user::validate_password($password);
        if ($password != $password_confirm) {
            $errors[] = "You have to enter twice the same password.";
        }
        return $errors;
    }

    public static function isValidIban(string $iban): array
    {
        $errors = [];

        /*Régles de validation par pays*/
        static $rules = array(
            'AL' => '[0-9]{8}[0-9A-Z]{16}',
            'AD' => '[0-9]{8}[0-9A-Z]{12}',
            'AT' => '[0-9]{16}',
            'BE' => '[0-9]{12}',
            'BA' => '[0-9]{16}',
            'BG' => '[A-Z]{4}[0-9]{6}[0-9A-Z]{8}',
            'HR' => '[0-9]{17}',
            'CY' => '[0-9]{8}[0-9A-Z]{16}',
            'CZ' => '[0-9]{20}',
            'DK' => '[0-9]{14}',
            'EE' => '[0-9]{16}',
            'FO' => '[0-9]{14}',
            'FI' => '[0-9]{14}',
            'FR' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}',
            'GE' => '[0-9A-Z]{2}[0-9]{16}',
            'DE' => '[0-9]{18}',
            'GI' => '[A-Z]{4}[0-9A-Z]{15}',
            'GR' => '[0-9]{7}[0-9A-Z]{16}',
            'GL' => '[0-9]{14}',
            'HU' => '[0-9]{24}',
            'IS' => '[0-9]{22}',
            'IE' => '[0-9A-Z]{4}[0-9]{14}',
            'IL' => '[0-9]{19}',
            'IT' => '[A-Z][0-9]{10}[0-9A-Z]{12}',
            'KZ' => '[0-9]{3}[0-9A-Z]{3}[0-9]{10}',
            'KW' => '[A-Z]{4}[0-9]{22}',
            'LV' => '[A-Z]{4}[0-9A-Z]{13}',
            'LB' => '[0-9]{4}[0-9A-Z]{20}',
            'LI' => '[0-9]{5}[0-9A-Z]{12}',
            'LT' => '[0-9]{16}',
            'LU' => '[0-9]{3}[0-9A-Z]{13}',
            'MK' => '[0-9]{3}[0-9A-Z]{10}[0-9]{2}',
            'MT' => '[A-Z]{4}[0-9]{5}[0-9A-Z]{18}',
            'MR' => '[0-9]{23}',
            'MU' => '[A-Z]{4}[0-9]{19}[A-Z]{3}',
            'MC' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}',
            'ME' => '[0-9]{18}',
            'NL' => '[A-Z]{4}[0-9]{10}',
            'NO' => '[0-9]{11}',
            'PL' => '[0-9]{24}',
            'PT' => '[0-9]{21}',
            'RO' => '[A-Z]{4}[0-9A-Z]{16}',
            'SM' => '[A-Z][0-9]{10}[0-9A-Z]{12}',
            'SA' => '[0-9]{2}[0-9A-Z]{18}',
            'RS' => '[0-9]{18}',
            'SK' => '[0-9]{20}',
            'SI' => '[0-9]{15}',
            'ES' => '[0-9]{20}',
            'SE' => '[0-9]{20}',
            'CH' => '[0-9]{5}[0-9A-Z]{12}',
            'TN' => '[0-9]{20}',
            'TR' => '[0-9]{5}[0-9A-Z]{17}',
            'AE' => '[0-9]{19}',
            'GB' => '[A-Z]{4}[0-9]{14}'
        );
        /*On vérifie la longueur minimale*/
        if (mb_strlen($iban) < 18) {
            $errors[] = "18 CHAR !";
        }
        /*On récupère le code ISO du pays*/
        $ctr = substr($iban, 0, 2);
        if (isset($rules[$ctr]) === false) {
            $errors[] = "2 first char only lettre !";
        }
        return $errors;
    }

    public static function validate_unicity(string $mail): array
    {
        $errors = [];
        $member = self::get_user_by_mail($mail);
        if ($member) {
            $errors[] = "This user already exists.";
        }
        return $errors;
    }

    public function validate(): array
    {
        $errors = [];
        if (!strlen($this->mail) > 0) {
            $errors[] = "Email is required.";
        }
        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "you must respect  form of email";
        }
        return $errors;
    }

    public function persist(): user
    {
        if (self::get_user_by_mail($this->mail))
            self::execute("UPDATE users SET mail:=mail, full_name=:full_name, iban=:iban WHERE mail=:mail ",
                ["mail" => $this->mail, "mail" => $this->mail, "password" => $this->hashed_password]);
        else
            self::execute("INSERT INTO users(mail,hashed_password,full_name,iban) VALUES(:mail,:password,:full_name,:iban)",
                ["mail" => $this->mail, "password" => $this->hashed_password, "full_name" => $this->full_name, "iban" => $this->iban]);
        return $this;
    }


}


