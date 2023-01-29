<?php

require_once "framework/Model.php";

class tricount extends Model
{


//    public function __construct( public string $title, public string $description, public string $created_at, public int $creator, public int $nb_participant ,public int $id)
//    {
//    }


    public function __construct( public string $title,   public int $creator,public ?string $description = null,public ?int $id = NULL, public ?string $created_at = NULL,public ?int $nb_participant=null )
    {

    }


    public static function get_tricount(user $user): tricount
    {
        $query = self::execute("SELECT * FROM tricounts WHERE creator = :id", ["id" => $user->id]);
        $data = $query->fetchAll();
        return $data;

    }


    public static function get_tricount_by_id(int $id): tricount|false
    {
        //echo $id;
        $query = self::execute("SELECT * FROM tricounts where id = :id", ["id" => $id]);
        // echo $id + 1;
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
            $tricount = new tricount( $data["title"], $data["description"], $data["created_at"], $data["creator"],0,$data["id"]);
            $query = self::execute("SELECT COUNT(*) nbr FROM subscriptions WHERE tricount= :TRICOUNT", ["TRICOUNT" => $tricount->id]);
            $data_ = $query->fetchAll();
            $nbr_participents = $data_[0]['nbr'];

            return new tricount( $tricount->title, $tricount->description, $tricount->created_at, $tricount->creator, $nbr_participents,$tricount->id,);

        }

    }


    public static function get_tricounts(user $user): array
    {
        $tricounts = [];
        $tricounts_with_particepent = [];
        $query = self::execute("select * from tricounts where creator = :id order by created_at DESC", ["id" => $user->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {
            $tricounts[] = new tricount( $row["title"], $row["description"], $row["created_at"], $row["creator"],0,$row["id"]);;
        }
        foreach ($tricounts as $tricount) {
            //$nb = $this->Participent_Tricount($tricount) ;
            $query = self::execute("SELECT COUNT(*) nbr FROM subscriptions WHERE tricount= :TRICOUNT", ["TRICOUNT" => $tricount->id]);
            $data_ = $query->fetchAll();
            $nbr_participents = $data_[0]['nbr'];
            $tricounts_with_particepent [] = new tricount($tricount->title, $tricount->description, $tricount->created_at, $tricount->creator, $nbr_participents,$tricount->id, );
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


    public
    static function validate(tricount $tricount, User $user): array
    {
        $errors = [];

        if (!(strlen($tricount->title) > 0)) {
            $errors[] = "title must be filled";
        }
//    else if(self::titleExists($tricount->title,$user->id)){
//            $errors[] = "title already exists in the database";
//       }
        return $errors;
    }


    public
    function insert_tricount(): tricount|array
    {

        if (empty($errors)) {
            $description = $this->description !== "" ? $this->description : 'NULL';
            self::execute("INSERT INTO tricounts ( `title`, `description`, `creator`) 
                                                 VALUES (:title,:description,:creator)",
                ["title" => $this->title, "description" => $description, "creator" => $this->creator]);
            return $this;
        }
        return $errors;
    }


}


