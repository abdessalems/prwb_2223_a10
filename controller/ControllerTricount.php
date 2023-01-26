<?php
require_once 'model/operation.php';
require_once 'model/tricount.php';
require_once 'model/user.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerTricount extends Controller {
    
   
    //page d'accueil. 
    public function index() : void {
        $this->Tricounts();
    }

    //liste des tricounts de l'utilisateur connecté.
    public function Tricounts() : void {
        $user = $this->get_user_or_redirect();
        $tricounts = $user->get_tricounts();

        (new View("tricounts"))->show(["user" => $user, "tricounts" => $tricounts ]);
    }

    public function view_tricount () : void {
        $user = $this->get_user_or_redirect();
        $id = $_GET["param1"] ;
        $id_user =$_GET["param2"];

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
            "nbr_total_repartitions" =>$nbr_total_repartitions,"My_total"=>$My_total,"Total_expenses"=>$Total_expenses,"trcount"=>$tricount,"id_user"=>$id_user]);

    }

    public function EditTricounts () : void {
        $user = $this->get_user_or_redirect();
        $idTricount = 4;
        $id_user =1;
        $tricount = tricount::get_tricount_by_id($idTricount);
        $subscribers =$tricount::get_subscriber($idTricount);
        $Nosubscribers=$tricount::getNOsubscriber($idTricount);


            if(isset($_POST['title'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];

                $new_tricount = new tricount($title, $id_user,$idTricount, $description);
                print_r($new_tricount);
                $tricount->update_tricount($new_tricount,$idTricount );
                print_r($tricount);
                (new View("editTricount"))->show(["user" => $user,"tricount" => $tricount,"id_user"=>$id_user,"subscribers"=>$subscribers,"Nosubscribers" =>$Nosubscribers] );
            }
            else {
                (new View("editTricount"))->show(["user" => $user, "tricount" => $tricount, "id_user" => $id_user, "subscribers" => $subscribers, "Nosubscribers" => $Nosubscribers]);
            }
    }

    public function Editeditsubscriber () : void {
        $user = $this->get_user_or_redirect();
        $idTricount = 4;
        $id_user =1;
        $tricount = tricount::get_tricount_by_id($idTricount);
        $subscribers =$tricount::get_subscriber($idTricount);
        $Nosubscribers=$tricount::getNOsubscriber($idTricount);



            (new View("editTricount"))->show(["user" => $user, "tricount" => $tricount, "id_user" => $id_user, "subscribers" => $subscribers, "Nosubscribers" => $Nosubscribers]);
        }



//if (isset($_POST['titlee'])) {
//$new_operation = new operation($_POST['titlee'], $operation->tricount, $_POST['amount']
//, $_POST['date'], $operation->initiator, $operation->created_at, $operation->id, $_POST['paid']);
//$operation->update_operation($new_operation, $operation->initiator);
//(new View("edit_operation"))->show(["operation" => $operation, "tricount" => $tricount, "id_user" => $id_user, "operations" => $operations, "operation_amount" => $operation_amount]);






}
