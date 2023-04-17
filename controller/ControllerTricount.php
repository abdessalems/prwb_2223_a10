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

    public function tricount_exists_service() : void {
        $res = "false";
        if(isset($_GET["param1"]) && $_GET["param1"] !== ""){
            $tricount = tricount::get_tricount_by_title($_GET["param1"]);
            
            if($tricount)
                $res =  "true";
        } 
        echo $res;
    }
    public function tricount(): void
    {
        $user = $this->get_user_or_redirect();
        $user=user::get_user_by_mail($user->mail) ;
        $tricounts = $this->get_tricount($user);
        $user = $_SESSION['user'];
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
        $user = $_SESSION['user'];
        $tricounts = $user->get_tricounts();
        $nbr_Participent_Tricount = $tricounts->Participent_Tricount();
        (new View("tricounts"))->show(["user" => $user, "tricounts" => $tricounts]);

    }

    public function addTricounts(): void
    {

        $user = $this->get_user_or_redirect();
        // $idUser=$user->id;
        $user_aftet_insert = user::get_user_by_mail($user->mail) ;
        $errors = [];
        if (isset($_POST['title'])) {
            $des = $_POST['description'];
            $title = $_POST['title'];
            $n_tricount = new tricount($title, $user_aftet_insert->id, $des);
            $errors = tricount::validate($n_tricount, $user_aftet_insert);
            if (empty($errors)) {
                $n_tricount->insert_tricount();
                $this->redirect("tricount", "tricount");
            }
        }
        (new View("add_tricount"))->show(["user" => $user, "errors" => $errors]);
    }


    public function view_tricount(): void
    {
        $user = $this->get_user_or_redirect();
        $id_tricount = $_GET["param1"];
        $id_user = $user->id;
        if (tricount::security_tricount($user, $id_tricount)) {
            $tricount = tricount::get_tricount_by_id($id_tricount);
            $nbr_total_repartitions = 0;
            $My_total = 0;
            $Total_expenses = 0;
            if (isset($_GET["param1"]) && $_GET["param1"] !== "") {
                $operations = operation::get_operations($tricount);
                foreach ($operations as $operation) {
                    $operation_amount = user::get_amount_operations($operation);
                    $operation->amount = round($operation->amount, 2);
                    if (empty($operation_amount)) {
                        if ($operation->initiator == $id_user) {
                            $My_total = $My_total + $operation->amount;
                        }
                    } else {
                        foreach ($operation_amount as $o) {
                            if ($o->id === $user->id) {
                                $My_total = $My_total + $o->amount;
                            }
                        }

                    }

                    $nbr_total_repartitions = $nbr_total_repartitions + $operation->nbr_repartition;
                    $Total_expenses = $Total_expenses + $operation->amount;
                }

            }
            (new View("tricount"))->show(["operations" => $operations, "tricount" => $tricount,
                "nbr_total_repartitions" => $nbr_total_repartitions, "My_total" => $My_total, "Total_expenses" => $Total_expenses, "trcount" => $tricount, "id_user" => $id_user]);
        } else
            $this->redirect("error");
    }

    public
    function EditTricounts(): void
    {
        $user = $this->get_user_or_redirect();
        $idTricount = $_GET["param1"];
        $id_user = $user->id;
        $tricount = tricount::get_tricount_by_id($idTricount);
        $subscribers = $tricount::get_subscriber($idTricount);
        $Nosubscribers = $tricount::getNOsubscriber($idTricount, $id_user);
        $ceator = tricount::get_creator($id_user);
        $subscriber = "";
        $title = "";
        $description = "";
        $errors=[];
        $lastTitle = $tricount->title;




        if (isset($_POST['title'])) {
            $title = $_POST['title'];

            $description = $_POST['description'];
            $new_tricount = new tricount($title, $id_user, $description, $idTricount);
            if ($lastTitle == $title) {
                $tricount->update_tricount($new_tricount, $idTricount);
                $this->redirect("tricount", "tricount");
            } else {
                $errors = tricount::validatetitle($new_tricount, $user);
                if (empty($errors)) {
                    $tricount->update_tricount($new_tricount, $idTricount);
                    $this->redirect("tricount", "tricount");

                }
            }
               (new View("edit_tricount"))->show(["user" => $user, "tricount" => $tricount, "id_user" => $id_user, "subscribers" => $subscribers, "Nosubscribers" => $Nosubscribers,"errors" => $errors]);
            }
        else {
                (new View("edit_tricount"))->show(["user" => $user, "tricount" => $tricount, "id_user" => $id_user, "subscribers" => $subscribers, "Nosubscribers" => $Nosubscribers,"errors" => $errors]);
            }
        }



    public function editSubscriber(): void
    {
        $user = $this->get_user_or_redirect();
        $idTricount = $_GET["param1"];

        if (isset($_POST['subscriber']) && !empty($_POST['subscriber'])) {
            $nameSubscriber = $_POST['subscriber'];
            $idSubscriber = user::get_user_by_name($nameSubscriber);
            tricount::add_Subscriber($idTricount, $idSubscriber);
            $this->redirect("tricount", "EditTricounts/$idTricount");
        }

        (new View("edit_Tricount"))->show(["user" => $user]);
    }


    public
    function deleteTricount(): void
    {
        $user = $this->get_user_or_redirect();
        $idTricount = $_GET["param1"];
        $tricount = tricount::get_tricount_by_id($idTricount);
        $Operation = operation::get_operations($tricount);

        foreach ($Operation as $Operation) {
            operation::delete_operation($Operation->id);

        }


        tricount::delete_tricount($idTricount);


        $this->redirect("tricount", "tricount");

        (new View("delete_tricount"))->show(["user" => $user]);
    }

    public
    function first_delete(): void
    {
        $user = $this->get_user_or_redirect();
        $idTricount = $_GET["param1"];
        $tricount = tricount::get_tricount_by_id($idTricount);

        (new View("delete_tricount"))->show(["user" => $user, "tricount" => $tricount]);
    }

    public function deleteSubscriber(): void
    {
        $user = $this->get_user_or_redirect();
        var_dump("ocs");


            $tricountid = $_GET["param1"];
            var_dump($tricountid);

            $nameSubscriber = $_GET["param2"];
            var_dump($nameSubscriber);
            $idSubscriber = user::get_user_by_name($nameSubscriber);
            var_dump($idSubscriber);
            Tricount::delete_subscriber($tricountid,$idSubscriber);
            $this->redirect("tricount", "EditTricounts/$tricountid");
        }




//    public
//    function deleteSubscriber(): void
//    {
//        $user = $this->get_user_or_redirect();
//        $idTricount = $_GET["param1"];
//        $nameSubscriber = $_GET["param2"];
//        var_dump($nameSubscriber);
//        $idSubscriber = user::get_user_by_name($nameSubscriber);
//        print_r($idSubscriber);
//        print_r($idTricount);
//
//        tricount::delete_subscriber($idTricount, $idSubscriber);
//
//        $tricount = tricount::get_tricount_by_id($idTricount);
//        $subscribers = $tricount::get_subscriber($idTricount);
//        $Nosubscribers = $tricount::getNOsubscriber($idTricount, $idSubscriber);
//        $idSubscriber = user::get_user_by_name($nameSubscriber);
//        $this->redirect("tricount", "EditTricounts/$idTricount/$user->id");
//
//
//        (new View("edit_Tricount"))->show(["user" => $user, "tricount" => $tricount, "subscribers" => $subscribers, "Nosubscribers" => $Nosubscribers]);
//
//
//    }


    public
    function view_balance(): void
    {
        $user = $this->get_user_or_redirect();
        $id_tricount = $_GET["param1"];
        $tricount = tricount::get_tricount_by_id($id_tricount);

        //$operations = operation::get_operationOfTricountId($id_tricount);
        $operations = operation::get_operations($tricount);

        $participents = tricount::getParticipentByTricount($id_tricount);
        foreach ($operations as $operation) {

            $weightForOperation = operation::getWeightForOperation($operation->id);

            $initiator = operation::getInitiator($operation->id);

            $AmountOfOperation = operation::getAmountOfOperation($operation->id);

            $partOfAmont = $AmountOfOperation / $weightForOperation;

            $operationPart = operation::participentByOperation($operation->id);


            foreach ($participents as $participent) {
                $participates = false;
                foreach ($operationPart as $row) {
                    if ($row["user"] == $participent->id) {
                        $participates = true;
                    }
                }

                if ($participates) {
                    $id = $participent->id;
                    $weightForPartipent = operation::weightForPartipent($operation->id, $id);
                    if ($initiator == $id) {

                        $participent->account += round($AmountOfOperation - ($weightForPartipent * $partOfAmont), 2);

                    } else {

                        $participent->account -= round($weightForPartipent * $partOfAmont, 2);
                    }
                }
            }

        }


        (new View("balance"))->show(["participents" => $participents, "tricount" => $tricount, "user" => $user]);

    }


    public
    function index(): void
    {
        // TODO: Implement index() method.
    }


    // public
    // function validateTitle(): void

    // {
    //     $user = $this->get_user_or_redirect();
    //     $id_tricount = $_GET["param1"];
    //     $tricount = tricount::get_tricount_by_id($id_tricount);
    //     tricount::validatetitle( $tricount, $user)
    // }
}


