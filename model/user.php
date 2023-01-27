<?php

require_once "framework/Model.php";

class user extends Model {



    public function __construct(public int $id,public string $mail, public string $hashed_password) {


    }


    public static function get_amount_operations(operation $operation,int $nbr_repartition) : array {
        $operation_amount=$operation->amount ;
        $operations_with_amount = [] ;

        $query = self::execute("SELECT * FROM users INNER JOIN repartitions on users.id=repartitions.user AND repartitions.operation = :operation ORDER BY `repartitions`.`weight` DESC", ["operation" => $operation->id]);
        $data = $query->fetchAll();
        $total_weight = 0 ;
        foreach ($data as $row) {
            $total_weight = $total_weight + $row['weight'] ;
        }
        foreach ($data as $row) {
            $amount_for_this_person= ($operation_amount / $total_weight ) * ($row['weight']) ;
            $operations_with_amount[] = new user($row['id'],$row['mail'],$row['hashed_password'],$row['full_name'],$amount_for_this_person);
        }
        return $operations_with_amount ;  

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

    public static function get_user_by_mail(string $mail) : user|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            return new user($data["id"],$data["mail"], $data["hashed_password"]);
        }

    }

//    public static function get_user_by_name ( String   $name) : array {
//        $query = self::execute( "SELECT users.id ,users.* FROM users WHERE full_name =:full_name", ["full_name" => $name]);
//
//        return $query->fetchAll() ;
//
//    }

    public static function get_user_by_name(String $name): int {
        $query = self::execute("SELECT users.id FROM users WHERE full_name =:full_name", ["full_name" => $name]);
        $result = $query->fetch();
        return intval($result['id']);
    }

}




