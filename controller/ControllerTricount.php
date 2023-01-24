<?php

require_once 'model/user.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/tricount.php';

class ControllerTricount extends Controller {
    
   
    //page d'accueil. 
    public function index() : void {
        $this->addTricounts();
    }

    //liste des tricounts de l'utilisateur connecté.
    public function Tricounts() : void {
        $user = $this->get_user_or_redirect();
        $tricounts = $user->get_tricounts();
        $nbr_Participent_Tricount= $tricounts->Participent_Tricount();

        (new View("tricounts"))->show(["user" => $user, "tricounts" => $tricounts ]);
    }

    public function addTricounts () : void {
        $user = $this->get_user_or_redirect();
        if(isset($_POST['title']) ) {
            $des= $_POST['description'];
            $tit=$_POST['title'];

            //$n_tricount = new tricount($tit,$des,$user) ;
            $n_tricount = new tricount($tit,$user,$des) ;

            $n_tricount->insert_tricount();

        }
         (new View("add_tricount"))->show(["user" => $user ]);

    }


    
}
