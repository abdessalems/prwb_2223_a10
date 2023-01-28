<?php

require_once "framework/Model.php";

class tricount extends Model {


    public function __construct( public string $title, public int $creator,public ?int $id =null, public  ?string $description =null ,public ?string $created_at =null , public ?int $nb_participant= NULL) {

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
            $tricount= new tricount($data["title"],$data["creator"],$data["id"], $data["description"],$data["created_at"],$data["creator"]);
            $query = self::execute("SELECT COUNT(*) nbr FROM subscriptions WHERE tricount= :TRICOUNT", ["TRICOUNT"=>$tricount->id] );
            $data_ = $query->fetchAll() ;
            $nbr_participents = $data_[0]['nbr'] ;
            return new tricount($tricount->title, $tricount->creator,$tricount->id, $tricount->description, $tricount->created_at,$nbr_participents ) ;

        }

    }

    public static function get_subscriber(int $idtricount) :array{
        $subscriber=[];
        $query = self::execute(" SELECT users.full_name FROM subscriptions,users  where tricount=:tricount and subscriptions.user=users.id", ["tricount" => $idtricount]);

        if ($query->rowCount() > 0) {
            $subscriber = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $subscriber;

    }
    public static function get_creator(int $userId) :array
    {
        $subscriber = [];

        $query = self::execute("SELECT users.full_name FROM users WHERE id = :id", ["id" => $userId]);
        if ($query->rowCount() > 0) {
            $subscriber = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $subscriber;


    }
    public static function getNOsubscriber(int $idtricount,int $idUser) :array{
        $subscriber=[];
//        $query = self::execute("SELECT users.full_name FROM users  where users.id NOT IN (select subscriptions.user  from subscriptions WHERE tricount=:tricount and subscriptions.user=users.id)and  users.id !=: id", ["tricount" => $idtricount,"id"=>$idUser]);
        $query = self::execute("SELECT users.full_name FROM users  where users.id NOT IN (select subscriptions.user  from subscriptions WHERE tricount=:tricount and subscriptions.user=users.id)and  users.id !=:id", ["tricount" => $idtricount,"id"=>$idUser]);
        if ($query->rowCount() > 0) {
            $subscriber = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $subscriber;

    }
    public static function get_tricounts(user $user) : array{
        $tricounts = [];
        $tricounts_with_particepent = [];
        $query = self::execute("select * from tricounts where creator = :id order by created_at DESC", ["id" => $user->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {
            $tricounts[] = new tricount($row['title'], $row['creator'],$row['id'] ,$row['description'], $row['created_at'],  );
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

    public   function update_tricount(tricount $tricount,int $idTricount ): tricount
    {



        self::execute("UPDATE tricounts SET title =:new_title, description =:new_description WHERE tricounts.id =:idTricount", ["idTricount" => $idTricount , "new_title" => $tricount->title, "new_description" =>$tricount->description ]);
        return $this;
    }
    public static  function delete_tricount(int $idTricount )
    {
        self::execute("DELETE FROM tricounts WHERE id=:id", ["id" => $idTricount ]);
        self::execute("DELETE FROM tricounts WHERE id=:id", ["id" => $idTricount ]);

    }

    public static function add_Subscriber(int $idTricount, int $idUser) {
        self::execute("INSERT INTO `subscriptions` (`tricount`, `user`) VALUES (:tricount_id, :user_id)", ["tricount_id" => $idTricount, "user_id" => $idUser]);
    }

    public static function delete_subscriber(int $idTricount, int $idUser) {
        self::execute("delete from subscriptions WHERE tricount=:tricount and user =:user ", ["tricount" => $idTricount, "user" => $idUser]);
    }
    
    





}