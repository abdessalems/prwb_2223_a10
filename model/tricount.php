<?php

require_once "framework/Model.php";

class tricount extends Model {


    public function __construct(public int $id, public string $title, public  string $description ,public string $created_at , public int $creator, public ?int $nb_participant= NULL) {

    }

    public static function get_tricount ( user $user) : tricount {
        $query = self::execute("SELECT * FROM tricounts WHERE creator = :id", ["id" => $user->id]);
        $data = $query->fetchAll();
        return $data ;

    }


    public static function get_tricount_by_id(int $id) : tricount|false {
       // echo $id;
        $query = self::execute("SELECT * FROM tricounts where id = :id", ["id"=>$id]);
        // echo $id + 1;
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
            return new tricount($data["id"],$data["title"], $data["description"],$data["created_at"],$data["creator"]);
        }

    }
    public static function get_member_by_pseudo(string $pseudo) : Member|false {
        $query = self::execute("SELECT * FROM Members where pseudo = :pseudo", ["pseudo"=>$pseudo]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
            return new Member($data["pseudo"], $data["password"], $data["profile"], $data["picture_path"]);
        }
    }

    public static function get_tricounts(user $user) : array{
        $tricounts = [];
        $tricounts_with_particepent = [];
        $query = self::execute("select * from tricounts where creator = :id order by created_at DESC", ["id" => $user->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {
            $tricounts[] = new tricount($row['id'],$row['title'], $row['description'], $row['created_at'], $row['creator'],0 );
        }
        foreach ($tricounts as $tricount) {
            //$nb = $this->Participent_Tricount($tricount) ;
            $query = self::execute("SELECT COUNT(*) nbr FROM subscriptions WHERE tricount= :TRICOUNT", ["TRICOUNT"=>$tricount->id] );
            $data_ = $query->fetchAll() ;
            $nbr_participents = $data_[0]['nbr'] ;
            $tricounts_with_particepent [] = new tricount($tricount->id,$tricount->title, $tricount->description, $tricount->created_at, $tricount->creator,$nbr_participents ) ;
        }

        return $tricounts_with_particepent;
    }


}