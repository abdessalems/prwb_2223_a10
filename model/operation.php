<?php

require_once "framework/Model.php";


class operation extends Model
{


    public function __construct(public string $title, public int $tricount, public string $amount, public string $operation_date, public int $initiator, public string $created_at, public int $id, public ?string $name_paid = NULL, public ?int $nbr_repartition = NULL)
    {
    }

    public function update_operation(operation $operation, int $id_user): operation
    {

        if (self::get_operation_by_id($operation->id))
            self::execute("UPDATE operations SET title=:title,amount=:amount,operation_date=:date,initiator=:initiator WHERE id= :id",
                ["id" => $operation->id, "title" => $operation->title, "amount" => $operation->amount, "date" => $operation->operation_date,
                    "initiator" => $id_user, "amount" => $operation->amount]);
        return $this;
    }

    public static function get_prev_operation(int $id_operation, array $operations): int
    {
        $array_length = count($operations) - 1;
        $i = $array_length;
        $test = false;
        $result = $id_operation;
        if ($array_length < 1) {
            return $id_operation;
        }
        while (($test == false) || ($i > 0)) {
            if ($operations[0]->id == $id_operation) {
                $result = $operations[$array_length]->id;
                $test = true;
            }
            if ($operations[$i]->id == $id_operation) {
                $result = $operations[$i - 1]->id;
                $test = true;
            }
            $i--;
        }
        return $result;
    }

    public static function get_next_operation(int $id_operation, array $operations): int
    {
        $array_length = count($operations) - 1;
        $i = 0;
        $test = false;
        $result = $id_operation;
        if ($array_length < 1) {
            return $id_operation;
        }
        while (($test == false) || ($i < $array_length)) {
            if ($operations[$array_length]->id == $id_operation) {
                $result = $operations[0]->id;
                $test = true;
            }
            if ($operations[$i]->id == $id_operation) {
                $result = $operations[$i + 1]->id;
                $test = true;
            }
            $i++;
        }
        return $result;
    }


    public static function get_nbr_repartitions_By_operationt_id(string $id): int
    {
        $nb = 0;
        $query = self::execute("SELECT COUNT(*) nbr FROM `repartitions` WHERE operation= :id ;", ["id" => $id]);
        $data_ = $query->fetchAll();
        $nb = $data_[0]['nbr'];
        return $nb;
    }


    public static function get_including_operation_by_idUser_operationId(int $idUser, int $idOperation): int
    {//if the user includ in operation return >=1 si nn 0
        $query = self::execute("SELECT * FROM repartitions WHERE user= :user AND operation= :operation ;", ["user" => $idUser, "operation" => $idOperation]);
        $data = $query->fetchAll();
        $cmpt = $query->rowCount();
        return $cmpt;
    }

    public static function get_operation_by_id(int $id): operation|false
    {
        $query = self::execute("SELECT * FROM operations WHERE id= :id ;", ["id" => $id]);
        $data = $query->fetchAll();
        //$nb= $data[0]['title'] ;
        // echo $nb ;
        if ($query->rowCount() == 0) {
            return false;
        } else {
            $operation = new operation($data[0]["title"], $data[0]["tricount"], $data[0]["amount"], $data[0]["operation_date"], $data[0]["initiator"], $data[0]["created_at"], $data[0]["id"]);
            //echo $data[0]["title"] ;
            $id_operation = $operation->id;
            $query = self::execute("SELECT u.full_name f from users u WHERE u.id in ( SELECT initiator FROM operations WHERE initiator= :initiatorr AND tricount = :TRICOUNT )", ["initiatorr" => $operation->initiator, "TRICOUNT" => $operation->tricount]);
            $data_ = $query->fetchAll();
            $name = $data_[0]['f'];
            $nbr_repartitions_By_operationt = $operation::get_nbr_repartitions_By_operationt_id($id_operation);// function for get number repartitions
            $operations_with_paidName_and_Nbrepartition = new operation($operation->title, $operation->tricount, $operation->amount, $operation->operation_date,
                $operation->initiator, $operation->created_at, $operation->id, $name, $nbr_repartitions_By_operationt);

            return $operations_with_paidName_and_Nbrepartition;
        }

    }


    public static function get_operations(tricount $tricount): array
    {
        $operations = [];
        $operations_with_paidName_and_Nbrepartition = [];
        $query = self::execute("select * from operations where tricount = :id order by created_at DESC", ["id" => $tricount->id]);
        $data = $query->fetchAll();
        foreach ($data as $row) {
            $operations[] = new operation($row['title'], $row['tricount'], $row['amount'], $row['operation_date'], $row['initiator'], $row['created_at'], $row['id']);
        }
        foreach ($operations as $operation) {
            $id_operation = $operation->id;
            $query = self::execute("SELECT u.full_name f from users u WHERE u.id in ( SELECT initiator FROM operations WHERE initiator= :initiatorr AND tricount = :TRICOUNT )", ["initiatorr" => $operation->initiator, "TRICOUNT" => $operation->tricount]);
            $data_ = $query->fetchAll();
            $name = $data_[0]['f'];
            $nbr_repartitions_By_operationt = $operation::get_nbr_repartitions_By_operationt_id($id_operation);// function for get number repartitions
            $operations_with_paidName_and_Nbrepartition [] = new operation($operation->title, $operation->tricount, $operation->amount, $operation->operation_date,
                $operation->initiator, $operation->created_at, $operation->id, $name, $nbr_repartitions_By_operationt);
        }


        return $operations_with_paidName_and_Nbrepartition;
    }

    public function add_operation(operation $operation): operation|array
    {

        self::execute("INSERT INTO `operations`( `title`, `tricount`, `amount`, `operation_date`, `initiator`)
                                                 VALUES (:title,:trcount,:amount,:operation_date,:initiator)",
            ["title" => $this->title, "tricount" => $this->tricount, "amount" => $this->amount, "operation_date" => $this->operation_date, "initiator" => $this->initiator]);
        return $this;
    }


    public function insert_operation(operation $operation): operation|array
    {

        self::execute("INSERT INTO `operations`( `title`, `tricount`, `amount`, `operation_date`, `initiator`)
                                                 VALUES (:title,:trcount,:amount,:operation_date,:initiator)",
            ["title" => $this->title, "tricount" => $this->tricount, "amount" => $this->amount, "operation_date" => $this->operation_date, "initiator" => $this->initiator]);

        return $this;


    }
}