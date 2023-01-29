<?php

require_once 'model/User.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/Tricount.php';


<<<<<<< HEAD
class ControllerUser extends Controller {
=======
class ControllerUser extends Controller
{

>>>>>>> feat_UC_edit_operation

    //page d'accueil. 
    public function index(): void
    {
        $this->profile();
    }

    public function tricount(): void
    {
        $user = $this->get_user_or_redirect();
        $tricounts = $this->get_tricount($user);
        //$nbr_Participent_Tricount = $this->get_nbr_Participent_Tricount($tricounts);
        (new View('list_tricounts'))->show(['user' => $user, "tricounts" => $tricounts]);
    }

    public function get_nbr_Participent_Tricount(tricount $tricount): int
    {
        return tricount::Participent_Tricount($tricount);
    }

    public function get_tricount(user $user): array
    {
<<<<<<< HEAD
=======

>>>>>>> feat_UC_edit_operation
        return tricount::get_tricounts($user);
    }


}




