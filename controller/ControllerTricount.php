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
        $tricount = tricount::get_tricount_by_id($id);

       if (isset($_GET["param1"]) && $_GET["param1"] !== "") {
            $operations = operation::get_operations($tricount);
        }
        (new View("tricount"))->show(["operations" => $operations ,"tricount" => $tricount]);

    }





}
