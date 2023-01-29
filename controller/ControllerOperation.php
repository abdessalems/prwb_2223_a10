<?php
require_once 'model/operation.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/tricount.php';
require_once 'model/user.php';

class ControllerOperation extends Controller {


    //page d'accueil.
    public function index() : void {
        $this->view_operation();
    }

    public function view_operation(): void {
        $user= $this->get_user_or_redirect();
        $id = $_GET["param1"];
        $id_user = $_GET["param2"];
        $operation = operation::get_operation_by_id($id);
        $id_tricount =$operation->tricount ;
        $tricount = tricount::get_tricount_by_id($id_tricount) ;
        $operations =operation::get_operations($tricount);
        $operation_amount= user::get_amount_operations($operation,$operation->nbr_repartition);
        $nbr_operations =(count($operations)) ;
        $cmpt=$operation::get_including_operation_by_idUser_operationId($id_user,$operation->id); ////if the user includ in operation return >=1 si nn 0
        (new View("operation"))->show(["operation" => $operation,"tricount" =>$tricount,"id_user"=>$id_user,"operations" => $operations,"cmpt"=>$cmpt,"operation_amount"=>$operation_amount,"nbr_operations"=>$nbr_operations]);


    }
    public function view_tricount () : void {
        $user = $this->get_user_or_redirect();
        $id = $_GET["param1"] ;
        $tricount = tricount::get_tricount_by_id($id);
        $nbr_total_repartitions = 0;
        $My_total= 0 ;
        $Total_expenses =0 ;
       if (isset($_GET["param1"]) && $_GET["param1"] !== "") {
            $operations = operation::get_operations($tricount);
           foreach ($operations as $operation) {
               $nbr_total_repartitions =$nbr_total_repartitions + $operation->nbr_repartition ;
               if ($user->full_name=== $operation->name_paid) {
                   $My_total= $My_total + $operation->amount ;
               }
               $Total_expenses =$Total_expenses + $operation->amount  ;
           }
        }
        (new View("tricount"))->show(["operations" => $operations ,"tricount" => $tricount,
            "nbr_total_repartitions" =>$nbr_total_repartitions,"My_total"=>$My_total,"Total_expenses"=>$Total_expenses,"trcount"=>$tricount]);

    }

    public function add_operation():void
    {
        $idTricount = $_GET["param1"];
        print_r($idTricount);
       $tricount = tricount::get_tricount_by_id($idTricount);
        $paidBy= user::get_all_user();
        $errors = [];
//        if(isset($_POST['title']) && $_POST['amount'] && $_POST["paidBy"]) {
//            $title = $_POST['title'];
//            $amount = $_POST['amount'];
//            $date = $_POST['date'];
//            $checkbox = $_POST['checkbox'];
//            $paiided = $_POST['paidBy'];
//            print_r($title);         print_r($paiided);
//            print_r($amount);      print_r($date);
//            print_r($checkbox);
//        }
//        $operation = new operation("$title",$idTricount,$amount,$date,1);
//        print_r($operation);

        (new View("add_operation"))->show(["tricount" => $tricount,"paidBy" =>$paidBy]);
    }


}
