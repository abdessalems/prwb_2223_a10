<?php

require_once "framework/Model.php";
require_once 'model/Tricount.php';

class user extends Model
{


//    public function __construct(public int $id, public string $mail,
// public string $hashed_password, public string $full_name, public ?string $iban ,
// public ?float $amount =null, public ?int $weight = null)
//    {}



    public function __construct(public string $mail, public string $hashed_password, public string $full_name, public ?string $iban = null, public ?int $id = null, public ?float $amount = null, public ?int $weight = null,public ?float $account=0)
    {}


//    public function __construct(public string $mail, public string $hashed_password, public string $full_name, public ?string $iban = null,public ?int $id=null,public ?float $amount =null, public ?int $weight = null,public ?float $account=0) {
//
//    }

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



    public static function validate_name(string $full_name) : array{
        $errors = [];
        if (strlen($full_name) == 0) {
            $errors[] = "Name is required";}
        if (!preg_match("/^[a-zA-Z-' ]*$/", $full_name)) {
            $errors[] = "Name should contain only letters";
        }
        return $errors ;
    }



    public static  function validate_ibann($input)
    {
        $iban = strtolower($input);

        // The official min length is 5. Also prevents substringing too short input.
        if(strlen($iban) < 5) return false;

        // lengths of iban per country
        $Countries = array(
            'al'=>28,'ad'=>24,'at'=>20,'az'=>28,'bh'=>22,'be'=>16,'ba'=>20,'br'=>29,'bg'=>22,'cr'=>21,'hr'=>21,'cy'=>28,'cz'=>24,
            'dk'=>18,'do'=>28,'ee'=>20,'fo'=>18,'fi'=>18,'fr'=>27,'ge'=>22,'de'=>22,'gi'=>23,'gr'=>27,'gl'=>18,'gt'=>28,'hu'=>28,
            'is'=>26,'ie'=>22,'il'=>23,'it'=>27,'jo'=>30,'kz'=>20,'kw'=>30,'lv'=>21,'lb'=>28,'li'=>21,'lt'=>20,'lu'=>20,'mk'=>19,
            'mt'=>31,'mr'=>27,'mu'=>30,'mc'=>27,'md'=>24,'me'=>22,'nl'=>18,'no'=>15,'pk'=>24,'ps'=>29,'pl'=>28,'pt'=>25,'qa'=>29,
            'ro'=>24,'sm'=>27,'sa'=>24,'rs'=>22,'sk'=>24,'si'=>19,'es'=>24,'se'=>24,'ch'=>21,'tn'=>24,'tr'=>26,'ae'=>23,'gb'=>22,'vg'=>24
        );
        // subsitution scheme for letters
        $Chars = array(
            'a'=>10,'b'=>11,'c'=>12,'d'=>13,'e'=>14,'f'=>15,'g'=>16,'h'=>17,'i'=>18,'j'=>19,'k'=>20,'l'=>21,'m'=>22,
            'n'=>23,'o'=>24,'p'=>25,'q'=>26,'r'=>27,'s'=>28,'t'=>29,'u'=>30,'v'=>31,'w'=>32,'x'=>33,'y'=>34,'z'=>35
        );

        // Check input country code is known
        if (!isset($Countries[ substr($iban,0,2) ])) return false;

        // Check total length for given country code
        if (strlen($iban) != $Countries[ substr($iban,0,2) ]) { return false; }

        // Move first 4 chars to end
        $MovedChar = substr($iban, 4) . substr($iban,0,4);

        // Replace letters by their numeric variant
        $MovedCharArray = str_split($MovedChar);
        $NewString = "";
        foreach ($MovedCharArray as $k => $v) {
            if ( !is_numeric($MovedCharArray[$k]) ) {
                // if any other cahracter then the known letters, its bogus
                if(!isset($Chars[$MovedCharArray[$k]])) return false;
                $MovedCharArray[$k] = $Chars[$MovedCharArray[$k]];
            }
            $NewString .= $MovedCharArray[$k];
        }

        // Now we just need to validate the checksum
        // Use bcmod if available
        if (function_exists("bcmod")) { return bcmod($NewString, '97') == 1; }

        // Else use this workaround
        // http://au2.php.net/manual/en/function.bcmod.php#38474
        $x = $NewString; $y = "97";
        $take = 5; $mod = "";
        do {
            $a = (int)$mod . substr($x, 0, $take);
            $x = substr($x, $take);
            $mod = $a % $y;
        }
        while (strlen($x));
        return (int)$mod == 1;

    }

     public static function validate_iban(string $iban) : array{
        $errors = [];
        if (!strlen($iban) == 16) {
            $errors[] = "Iban should contain 16 caracters";}

        return $errors ;
    }

    public static function validate_passwords(string $password, string $password_confirm): array
    {
        $errors = user::validate_password($password);
        if ($password != $password_confirm) {
            $errors[] = "You have to enter twice the same password.";
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
    public static function get_user_by_name(String $name): int {
        $query = self::execute("SELECT users.id FROM users WHERE full_name =:full_name", ["full_name" => $name]);
        $result = $query->fetch();
        return intval($result['id']);
    }



    public static function get_all_user():array|false{
        $query = self::execute("SELECT * FROM users",[]);
        $result = $query->fetchAll();
        return $result;
    }


}


