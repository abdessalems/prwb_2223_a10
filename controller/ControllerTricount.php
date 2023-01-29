<?php

require_once 'model/User.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/Tricount.php';

class ControllerTricount extends Controller {

    public function tricount() : void{
        $user = $this->get_user_or_redirect();
        $userr= user::get_user_by_mail($user->mail);
        $tricounts = $this->get_tricount($userr);
        //$nbr_Participent_Tricount = $this->get_nbr_Participent_Tricount($tricounts);
        (new View('list_tricounts'))->show(['user'=> $user,"tricounts" => $tricounts] );
    }

    public function get_nbr_Participent_Tricount (tricount $tricount) : int {
        return tricount::Participent_Tricount($tricount) ;
    }

    public function get_tricount(user $user): array
    {
        return tricount::get_tricounts($user);
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
        $errors = [];
        if(isset($_POST['title']) ) {
            $des= $_POST['description'];
            $title=$_POST['title'];

            //$n_tricount = new tricount($tit,$des,$user) ;
            $n_tricount = new tricount($title,$user,$des) ;
            $errors = tricount::validate($n_tricount,$user);
            if(empty($errors)) {
                $n_tricount->insert_tricount();
            }
        }
         (new View("add_tricount"))->show(["user" => $user,"errors"=>$errors ]);

    }


    public function index(): void
    {
        // TODO: Implement index() method.
    }
}
