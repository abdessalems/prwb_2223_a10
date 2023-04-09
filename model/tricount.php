<?php

require_once "framework/Model.php";

class tricount extends Model
{


//    public function __construct( public string $title, public string $description, public string $created_at,
// public int $creator, public int $nb_participant ,public int $id)
//    {
//    }


    public function __construct( public string $title, public int $creator, public ?string $description = null,public ?int $id = NULL, public ?string $created_at = NULL,public ?int $nb_participant=null )
    {

    }

//    public function __construct( public string $title, public int $creator, public ?string $description = null,public ?int $id = NULL, public ?string $created_at = NULL,public ?int $nb_participant=null )
//    {
//
//    }


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

            $tricount = new tricount( $data["title"],$data["creator"], $data["description"],$data["id"], $data["created_at"],0);
            $query = self::execute("SELECT COUNT(*) nbr FROM subscriptions WHERE tricount= :TRICOUNT", ["TRICOUNT" => $tricount->id]);
            $data_ = $query->fetchAll();
            $nbr_participents = $data_[0]['nbr'];
           // ( $data["title"],$data["creator"], $data["description"],$data["id"], $data["created_at"],0);

            return new tricount( $tricount->title,$tricount->creator, $tricount->description,$tricount->id, $tricount->created_at, $nbr_participents);

        }

    }


    public static function get_tricounts(user $user): array
    {
        $tricounts = [];
        $tricounts_with_particepent = [];
        $query = self::execute("select * from tricounts where creator = :id order by created_at DESC", ["id" => $user->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {

            $tricounts[] = new tricount($row["title"],$row["creator"], $row["description"],$row["id"], $row["created_at"],0);
        }
        foreach ($tricounts as $tricount) {
            //$nb = $this->Participent_Tricount($tricount) ;
            $query = self::execute("SELECT COUNT(*) nbr FROM subscriptions WHERE tricount= :TRICOUNT", ["TRICOUNT" => $tricount->id]);
            $data_ = $query->fetchAll();
            $nbr_participents = $data_[0]['nbr'];
            $tricounts_with_particepent [] = new tricount( $tricount->title,$tricount->creator, $tricount->description,$tricount->id, $tricount->created_at, $nbr_participents);
        }

        return $tricounts_with_particepent;
    }


    public static function titleExists(string $title, int $creator) : bool {
        $query = self::execute("SELECT COUNT(*) FROM tricounts WHERE title = :title AND creator = :creator", ["title" => $title, "creator" => $creator]);
        $data = $query->fetchColumn();
        return $data > 0;
    }

    public static function validate(Tricount $tricount, User $user) : array {
        $errors = [];

        if (empty($tricount->title)) {
            $errors[] = "Title must be filled.";
        } else if (self::titleExists($tricount->title, $user->id)) {
            $errors[] = "Title already exists .";
        }

        return $errors;
    }

    public static function validatetitle(Tricount $tricount, User $user) : array {
        $errors = [];


        if (self::titleExists($tricount->title, $user->id)) {
            $errors[] = "Title already exists .";
        }

        return $errors;
    }

    public static function getParticipentByTricount(int $tricountId):array{
        $query = self::execute("SELECT * FROM users WHERE id in (SELECT DISTINCT user FROM subscriptions WHERE tricount=:id) ORDER BY full_name",["id" => $tricountId]);
        $data = $query->fetchAll();
        $results = [];
        foreach($data as $row){
            $results[] = new User($row["mail"],$row["hashed_password"],$row["full_name"],$row["iban"],$row["id"]);
        }
        return $results;
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


    public   function update_tricount(tricount $tricount,int $idTricount ): tricount
    {
         self::execute("UPDATE tricounts SET title =:new_title, description =:new_description WHERE tricounts.id =:idTricount", ["idTricount" => $idTricount , "new_title" => $tricount->title, "new_description" =>$tricount->description ]);
        return $this;
    }
    public static  function delete_tricount(int $idTricount )
    {
        self::execute("DELETE FROM  subscriptions where  subscriptions.tricount=:id", ["id" => $idTricount ]);
        self::execute("DELETE FROM repartition_template_items WHERE repartition_template in (select id from repartition_templates where tricount=:id )", ["id" => $idTricount ]);
        self::execute("DELETE FROM repartition_templates WHERE repartition_templates.tricount=:id", ["id" => $idTricount ]);
        self::execute("DELETE FROM tricounts WHERE id=:id", ["id" => $idTricount ]);

    }




    public static function add_Subscriber(int $idTricount, int $idUser) {
        self::execute("INSERT INTO `subscriptions` (`tricount`, `user`) VALUES (:tricount_id, :user_id)", ["tricount_id" => $idTricount, "user_id" => $idUser]);
    }

    public static function delete_subscriber(int $idTricount, int $idUser) {
        try {
            self::execute("delete from subscriptions WHERE (tricount=:tricount and user =:user) ", ["tricount" => $idTricount, "user" => $idUser]);

            if (self::getRowCount() > 0) {
                return 'success';
            } else {
                return 'error';
            }
        } catch (PDOException $e) {

            return 'error';
        }
    }




}


