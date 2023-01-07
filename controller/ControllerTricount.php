<?php

require_once 'model/user.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/tricount.php';

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

    public function addTricounts () : void {
        $user = $this->get_user_or_redirect();
        
         (new View("add_tricount"))->show(["user" => $user ]);

    }

    public function addNewTricount () : void {
        $user = $this->get_user_or_redirect();
        $creator = $this->get_creator($user);
        $errors = [];

        if (isset($_POST['title'])) {
            $errors = $this->add_tricount($user, $creator);
        }
        
        (new View('add_tricount'))->show(["title" => $title, 
                                        "description" => $description, 
                                        "user" => $user, 
                                        "errors" => $errors]);;
    }
    private function add_Tricount(user $user,user $creator) : array {
        $errors = [];
        if (isset($_POST['title'])) {
            $body = $_POST['title'];
            $description = $_POST['description'];
            $tricount = new tricount($title,$description,$user);
            $errors = $tricount->validate();
            if(empty($errors)){
                $creator->add_tricount($tricount);
                 $this->redirect("tricount", "index", $creator->id);        
            }
        }
        return $errors;
        
    }

    private function get_creator(user $user) : user {
        if (!isset($_GET["param1"]) || $_GET["param1"] == "") {
            return $user;
        } else {
            return user::get_user_by_id($_GET["param1"]);
        }
    }
    
}
