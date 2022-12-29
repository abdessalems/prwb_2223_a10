<?php

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
        $nbr_Participent_Tricount= $tricounts->Participent_Tricount();

        (new View("tricounts"))->show(["user" => $user, "tricounts" => $tricounts ]);
    }



}
