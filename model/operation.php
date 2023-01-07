<?php

require_once "framework/Model.php";

class operation extends Model {


    public function __construct(public string $title, public int $tricount , public float $amount , public string $operation_date , public int $initiator,public string $created_at ,public  int $id ,public ?string $name_paid = NULL,public ?int $nbr_repartition = NULL  ) {

    }


    public static function get_nbr_repartitions_By_operationt_id(string $id) : int {
        $nb = 0 ;
        $query = self::execute("SELECT COUNT(*) nbr FROM `repartitions` WHERE operation= :id ;", ["id"=>$id] );
        $data_ = $query->fetchAll() ;
        $nb= $data_[0]['nbr'] ;
        return $nb ;
    }

    public static function get_operations(tricount $tricount) : array{
        $operations = [];
        $operations_with_paidName_and_Nbrepartition = [];
        $query = self::execute("select * from operations where tricount = :id order by created_at DESC", ["id" => $tricount->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {
            $operations[] = new operation($row['title'],$row['tricount'], $row['amount'], $row['operation_date'], $row['initiator'], $row['created_at'], $row['id'] );
        }
        foreach ($operations as $operation) {
            $id_operation = $operation->id;
            $query = self::execute("SELECT u.full_name f from users u WHERE u.id in ( SELECT initiator FROM operations WHERE initiator= :initiatorr AND tricount = :TRICOUNT )", ["initiatorr"=>$operation->initiator,"TRICOUNT"=>$operation->tricount ] );
            $data_ = $query->fetchAll() ;
            $name =  $data_[0]['f'] ;
            $nbr_repartitions_By_operationt =$operation::get_nbr_repartitions_By_operationt_id($id_operation) ;// function for get number repartitions
            $operations_with_paidName_and_Nbrepartition [] = new operation($operation->title,$operation->tricount, $operation->amount, $operation->operation_date,
                                                         $operation->initiator,$operation->created_at,$operation->id,$name,$nbr_repartitions_By_operationt) ;
        }



        return $operations_with_paidName_and_Nbrepartition;
    }






}