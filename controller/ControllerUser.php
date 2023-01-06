<?php

require_once 'model/user.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/tricount.php';

class ControllerUser extends Controller {
    

    //page d'accueil. 
    public function index() : void {
        $this->profile();
    }

    public function tricount() : void{
        $user = $this->get_user_or_redirect();
        $tricounts = $this->get_tricount($user);
        (new View('list_tricounts'))->show(['user'=> $user,"tricounts" => $tricounts] );
    }


     public function get_tricount(user $user): array{
        return tricount::get_tricounts($user);
    }









}
