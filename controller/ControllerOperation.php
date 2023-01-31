<?php
require_once 'model/operation.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/tricount.php';
require_once 'model/user.php';

class ControllerOperation extends Controller
{


    //page d'accueil.
    public function index(): void
    {
        $this->view_operation();
    }


    public function edit_operation(): void
    {
        $id_operation = $_GET["param1"];
        $id_user = $_GET["param2"];
        $operation = operation::get_operation_by_id($id_operation);
        $tricount = tricount::get_tricount_by_id($operation->tricount);
        $operations = operation::get_operations($tricount);
        $operation_amount = user::get_amount_operations($operation, $operation->nbr_repartition);
        //print_r($operation_amount) ;
        if (isset($_POST['titlee'])) {
            $new_operation = new operation($_POST['titlee'], $operation->tricount, $_POST['amount']
                , $_POST['date'], $operation->initiator, $operation->created_at, $operation->id, $_POST['paid']);
            $operation->update_operation($new_operation, $operation->initiator);
            (new View("edit_operation"))->show(["operation" => $operation, "tricount" => $tricount, "id_user" => $id_user, "operations" => $operations, "operation_amount" => $operation_amount]);

        }

        (new View("edit_operation"))->show(["operation" => $operation, "tricount" => $tricount, "id_user" => $id_user, "operations" => $operations, "operation_amount" => $operation_amount]);

        // ,"tricount" => $tricount, "nbr_total_repartitions" =>$nbr_total_repartitions,"My_total"=>$My_total,"Total_expenses"=>$Total_expenses,"trcount"=>$tricount,"id_user"=>$id_user]);


    }
    public function view_balance():void
    {
        $user = $this->get_user_or_redirect();
        $id_operation = $_GET["param1"];
        $operationgg = operation::get_operation_by_id($id_operation);
        $tricount = tricount::get_tricount_by_id($operationgg->tricount);
        $operations = operation::get_operations($tricount);

        foreach ($operations as $operation){
            $participentByOperation= operation::participentByOperation($operation->id);
            $weightForOperation=operation::getWeightForOperation($operation->id);
            $initiator=operation::getInitiator($operation->id);
            $AmountOfOperation=operation::getAmountOfOperation($operation->id);
            $partOfAmont=$AmountOfOperation/$weightForOperation;
            $initiator=operation::getInitiator($operation->id);
            foreach ($participentByOperation as $participent){
                $weightForPartipent=operation::weightForPartipent($operation->id);

                if($initiator==$participent->initiator){

                }
            }


        }


         $participentByOperation= operation::participentByOperation($id_operation);
         //print_r($participentByOperation);
         $weightForOperation=operation::getWeightForOperation($id_operation);

         $initiator=operation::getInitiator($id_operation);

         $AmountOfOperation=operation::getAmountOfOperation($id_operation);
         $partOfAmont=$AmountOfOperation/$weightForOperation;
         print_r($partOfAmont);
        (new View("balance"))->show(["operation" => $operation]);

    }


    public function view_operation(): void
    {
        $user = $this->get_user_or_redirect();
        $id_operation = $_GET["param1"];
        $id_user = $_GET["param2"];
        $operation = operation::get_operation_by_id($id_operation);
        $tricount = tricount::get_tricount_by_id($operation->tricount);
        $operations = operation::get_operations($tricount);
        $operation_amount = user::get_amount_operations($operation, $operation->nbr_repartition);
        $nbr_operations = (count($operations));
        $all_operation = $operation::get_operations($tricount);
        $id_next_operation = operation::get_next_operation($id_operation, $all_operation);
        $id_previous_operation = operation::get_prev_operation($id_operation, $all_operation);
        $cmpt = $operation::get_including_operation_by_idUser_operationId($id_user, $operation->id); ////if the user includ in operation return >=1 si nn 0
        (new View("operation"))->show(["id_next_operation" => $id_next_operation, "id_previous_operation" => $id_previous_operation, "operation" => $operation, "all_operation" => $all_operation, "id_operation" => $id_operation, "tricount" => $tricount, "id_user" => $id_user, "operations" => $operations, "cmpt" => $cmpt, "operation_amount" => $operation_amount, "nbr_operations" => $nbr_operations]);
    }

    public function add_operation(): void
    {


        $idTricount = $_GET["param1"];
        $paid = "";
        $name = "";
        $date= "";
        $amount="";


        $errors="";
        $paidBy = [];
        $allName=[];
        $allUseId=[];
        $allWeight=[];
        $tableau=[];
        $paidBy = user::get_all_user();
         $tricount = tricount::get_tricount_by_id($idTricount);
        if(isset($_POST['title']) && isset($_POST["amount"])&& isset($_POST["date"])  ){
            $title = $_POST['title'];
            $amount = $_POST['amount'];
            $date= $_POST["date"];
            $itr= $_POST["paid"];
            $itrator=user::get_user_by_name($itr);
            $newoperation = new operation($title,$idTricount,$amount,$date,$itrator);

            $errors = operation::validateOperation($newoperation);
            if (empty($errors)) {
                $newoperation-> add_operation();


            }
            foreach ($paidBy as $index => $person) {
                if (isset($_POST['checkbox_' . $index]) && isset($_POST['weight_' . $index])) {
                    $checkbox = $_POST['checkbox_' . $index];
                    $weight = $_POST['weight_' . $index];
                    $userId = user::get_user_by_name($checkbox);


//                    $allWeight=$weight;
//                    $allUseId=$userId;


                }

            }
                $allWeight=$weight;
                $allUseId=$userId;


                print_r($allUseId);
            print_r($allWeight);
            $tableau = array_merge($allUseId,$allWeight);


            foreach ($tableau as $allUseId=>$allWeight ) {

                operation::add_reartition($newoperation, $userId, $weight);
            }
            $paidBy = user::get_all_user();
        }
        $paidBy = user::get_all_user();




        (new View("add_operation"))->show(["tricount" => $tricount, "paidBy" => $paidBy,"errors"=>$errors]);
    }
    public function delete_opertation():void{

        $id_operation = $_GET["param1"];

        $operation = operation::get_operation_by_id($id_operation);


        (new View("delete_operation"))->show(["operation" => $operation]);
    }

    public function delete_confirmation():void{

        $id_operation = $_GET["param1"];
        $operation = operation::get_operation_by_id($id_operation);
        $operation::delete_operation($id_operation);

        (new View("delete_operation"))->show(["operation" => $operation]);
    }



}





