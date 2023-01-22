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

    public function view_tricount() : void {
        $user = $this->get_user_or_redirect();
        $id_tricount = $_GET["param1"] ;
        $id_user =$_GET["param2"];
        $tricount = tricount::get_tricount_by_id($id_tricount);
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
        (new View("tricount"))->show(["operations" => $operations , "tricount" => $tricount,
            "nbr_total_repartitions" =>$nbr_total_repartitions,"My_total"=>$My_total,"Total_expenses"=>$Total_expenses,"trcount"=>$tricount,"id_user"=>$id_user]);

    }




}
