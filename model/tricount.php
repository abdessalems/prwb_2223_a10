<?php

require_once "framework/Model.php";

class tricount extends Model {



    public function __construct( public int $id ,public string $title, public int $creator,public ?string $description = null, public ?string $created_at = NULL,public ?int $nb_participant=NULl)
    {

    }

    public static function get_tricount ( User $user) : tricount {
        $query = self::execute("SELECT * FROM `tricounts` WHERE creator = :id", ["id" => $user->id]);
        $data = $query->fetchAll();
        return $data ;



    }
    public static function get_tricounts(User $user) : array{
        $tricounts = [];
        $tricounts_with_particepent = [];
        $query = self::execute("select * from tricounts where creator = :id order by created_at DESC", ["id" => $user->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {
            $tricounts[] = new Tricount($row['id'],$row['title'],$row['creator'], $row['description'], $row['created_at'],0);
        }
        foreach ($tricounts as $tricount) {
            //$nb = $this->Participent_Tricount($tricount) ;
            $query = self::execute("SELECT COUNT(*) nbr FROM subscriptions WHERE tricount= :TRICOUNT", ["TRICOUNT"=>$tricount->id] );
            $data_ = $query->fetchAll() ;
            $nbr_participents = $data_[0]['nbr'] ;
            $tricounts_with_particepent [] = new Tricount($tricount->id,$tricount->title, $tricount->creator, $tricount->description, $tricount->created_at,$nbr_participents ) ;
        }

        return $tricounts_with_particepent;
    }
//   public  static function titleExists( string  $title,int  $creator) :bool {
//
//        $query=self::execute("SELECT COUNT(*) FROM tricounts WHERE title :=title and creator=:creator " , ["title"=>$title,"creator"=>$creator]);
//        $data_ = $query->fetchall();
//       $nbr_title = $data_[0];
//       $nbr_title =1;
//       if ($nbr_title > 0) {
//           return true;
//       } else {
//           return false;
//       }
//    }



    public static function validate(tricount $tricount,User $user) : array {
        $errors = [];

        if(!(strlen($tricount->title) > 0)){
            $errors[] = "title must be filled";
       }
//    else if(self::titleExists($tricount->title,$user->id)){
//            $errors[] = "title already exists in the database";
//       }
        return $errors;
    }


    public function insert_tricount():  tricount|array {

        if(empty($errors)) {
            $description = $this->description !== "" ? $this->description : 'NULL';
            self::execute("INSERT INTO tricounts ( `title`, `description`, `creator`) 
                                                 VALUES (:title,:description,:creator)",
                ["title" => $this->title, "description" => $description, "creator" => $this->creator->id]);
            return $this;
        }
        return $errors;
    }







}