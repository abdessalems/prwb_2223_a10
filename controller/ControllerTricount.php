<?php

require_once 'model/User.php';

require_once 'model/operation.php';
require_once 'model/tricount.php';
require_once 'model/user.php';

require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/Tricount.php';


class ControllerTricount extends Controller
{

    public function tricount(): void
    {
        $user = $this->get_user_or_redirect();
        $userr = user::get_user_by_mail($user->mail);
        $tricounts = $this->get_tricount($userr);
        //$nbr_Participent_Tricount = $this->get_nbr_Participent_Tricount($tricounts);
        (new View('list_tricounts'))->show(['user' => $user, "tricounts" => $tricounts]);
    }

    public function get_nbr_Participent_Tricount(tricount $tricount): int
    {
        return tricount::Participent_Tricount($tricount);
    }

    public function get_tricount(user $user): array
    {
        return tricount::get_tricounts($user);
    }


//liste des tricounts de l'utilisateur connecté.
    public function Tricounts(): void
    {
        $user = $this->get_user_or_redirect();
        $tricounts = $user->get_tricounts();
        $nbr_Participent_Tricount = $tricounts->Participent_Tricount();
        (new View("tricounts"))->show(["user" => $user, "tricounts" => $tricounts]);

    }


    public function addTricounts(): void
    {
        $user = $this->get_user_or_redirect();
        $idUser=$user->id;

        $errors = [];
        if (isset($_POST['title'])) {
            $des = $_POST['description'];
            $title = $_POST['title'];
            $n_tricount = new tricount($title, $idUser, $des);
            $errors = tricount::validate($n_tricount, $user);
            if (empty($errors)) {
                $n_tricount->insert_tricount();
            }
        }
        (new View("add_tricount"))->show(["user" => $user, "errors" => $errors]);
    }

    public function view_tricount(): void
    {
        $user = $this->get_user_or_redirect();
        $id_tricount = $_GET["param1"];
        $id_user = $_GET["param2"];
        $tricount = tricount::get_tricount_by_id($id_tricount);
        $nbr_total_repartitions = 0;
        $My_total = 0;
        $Total_expenses = 0;
        if (isset($_GET["param1"]) && $_GET["param1"] !== "") {
            $operations = operation::get_operations($tricount);
            foreach ($operations as $operation) {
                $nbr_total_repartitions = $nbr_total_repartitions + $operation->nbr_repartition;
                if ($user->full_name === $operation->name_paid) {
                    $My_total = $My_total + $operation->amount;
                }
                $Total_expenses = $Total_expenses + $operation->amount;
            }
        }
        (new View("tricount"))->show(["operations" => $operations, "tricount" => $tricount,
            "nbr_total_repartitions" => $nbr_total_repartitions, "My_total" => $My_total, "Total_expenses" => $Total_expenses, "trcount" => $tricount, "id_user" => $id_user]);

    }
 public function EditTricounts () : void
{
    $user = $this->get_user_or_redirect();
    $idTricount = $_GET["param1"];
    $id_user = $_GET["param2"];
    $tricount = tricount::get_tricount_by_id($idTricount);
    $subscribers = $tricount::get_subscriber($idTricount);
    $Nosubscribers = $tricount::getNOsubscriber($idTricount, $id_user);
    $ceator = tricount::get_creator($id_user);

    //  $subscribers = array_merge($subscribers, $ceator);

    //  $nameSubscriber = $_POST['subscriber'];
    // print_r(user::get_user_by_name($nameSubscriber));
//        print_r($nameSubscriber);




//        if (isset($nameSubscriber)) {
//            tricount::add_Subscriber($idTricount, $newSubsribers['id']);
//        }

    if(isset($_POST['title'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];


        $new_tricount = new tricount($title, $id_user, $description,$idTricount);
        print_r($new_tricount);
        $tricount->update_tricount($new_tricount,$idTricount );
        print_r($tricount);
        (new View("edit_tricount"))->show(["user" => $user,"tricount" => $tricount,"id_user"=>$id_user,"subscribers"=>$subscribers,"Nosubscribers" =>$Nosubscribers] );
    }
    else {
        (new View("edit_tricount"))->show(["user" => $user, "tricount" => $tricount, "id_user" => $id_user, "subscribers" => $subscribers, "Nosubscribers" => $Nosubscribers]);
    }



}

    public function editSubscriber () : void {
        $user = $this->get_user_or_redirect();

        $idTricount = $_GET["param1"];
        $nameSubscriber = $_POST['subscriber'];
        $idSubscriber= user::get_user_by_name($nameSubscriber);
        if (isset($nameSubscriber)) {tricount::add_Subscriber($idTricount, $idSubscriber);
        }


        (new View("editTricount"))->show(["user" => $user]);
    }

    public function deleteTricount () : void {
        $user = $this->get_user_or_redirect();
        $idTricount = $_GET["param1"];
        echo "bbb";

        tricount::delete_tricount($idTricount);




        (new View("editTricount"))->show(["user" => $user]);
    }
    public function deleteSubscriber():void{
        $user = $this->get_user_or_redirect();
        $idTricount = $_GET["param1"];
        $nameSubscriber = $_GET["param2"];
        $idSubscriber = user::get_user_by_name($nameSubscriber);
        $tricount = tricount::get_tricount_by_id($idTricount);
        $subscribers = $tricount::get_subscriber($idTricount);
        $Nosubscribers = $tricount::getNOsubscriber($idTricount, $idSubscriber);
        $idSubscriber = user::get_user_by_name($nameSubscriber);

        tricount::delete_subscriber($idSubscriber,$idTricount);
        (new View("editTricount"))->show(["user" => $user, "tricount" => $tricount, "subscribers" => $subscribers, "Nosubscribers" => $Nosubscribers]);


    }

    public function index(): void
    {
        // TODO: Implement index() method.
    }
}


