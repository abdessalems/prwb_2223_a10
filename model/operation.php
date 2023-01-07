<?php

require_once "framework/Model.php";

class operation extends Model {


    public function __construct(public string $title, public int $tricount , public float $amount , public string $operation_date , public int $initiator,public string $created_at ,public  int $id ,  public ?string $name_paid = NULL  ) {

    }




    public static function get_operations(tricount $tricount) : array{
        $operations = [];
        $operations_with_paidName = [];
        $query = self::execute("select * from operations where tricount = :id order by created_at DESC", ["id" => $tricount->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {
            $operations[] = new operation($row['title'],$row['tricount'], $row['amount'], $row['operation_date'], $row['initiator'], $row['created_at'], $row['id'] );
        }
        foreach ($operations as $operation) {

            $query = self::execute("SELECT u.full_name f from users u WHERE u.id in ( SELECT initiator FROM operations WHERE initiator= :initiatorr AND tricount = :TRICOUNT )", ["initiatorr"=>$operation->initiator,"TRICOUNT"=>$operation->tricount ] );
            $data_ = $query->fetchAll() ;
            $name =  $data_[0]['f'] ;;
            $operations_with_paidName [] = new operation($operation->title,$operation->tricount, $operation->amount, $operation->operation_date, $operation->initiator,$operation->created_at,$operation->id ) ;
        }

        return $operations_with_paidName;
    }






}