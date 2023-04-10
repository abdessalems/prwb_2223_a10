<?php
require_once 'model/operation.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';
require_once 'model/tricount.php';
require_once 'model/user.php';

class ControllerOperation extends Controller
{


    //page d'accueil.
    public function index(): void
    {
        $this->view_operation();
    }

    public function edit_operation(): void
    {
        $user = $this->get_user_or_redirect();
        $id_operation = $_GET["param1"];
        $id_user = $user->id;
        $operation = operation::get_operation_by_id($id_operation);
        $tricount = tricount::get_tricount_by_id($operation->tricount);
        $operations = operation::get_operations($tricount);
        $operation_amount = user::get_amount_operations($operation);
        if (operation::security_edit_operation($id_user, $operation_amount,$operation->initiator)) {

            if (isset($_POST['title'])) {
                $initiator = user::get_user_by_id($_POST['initiator']);
                $new_operation = new operation($_POST['title'], $operation->tricount, $_POST['amount'],
                    $_POST['date'], $_POST['initiator'], $operation->created_at, $operation->id, $initiator->full_name);
                $operation->update_operation($new_operation, $initiator->id);
                $operation->update_amount_operations($new_operation, $_POST['weight'], $operation_amount);
                $operation = operation::get_operation_by_id($id_operation);
                $operation_amount = user::get_amount_operations($operation, $operation->nbr_repartition);
                $this->redirect("operation", "view_operation", $id_operation);

            }
            (new View("edit_operation"))->show(["operation" => $operation, "tricount" => $tricount, "id_user" => $id_user, "operations" => $operations, "operation_amount" => $operation_amount]);
        } else   $this->redirect("error");
    }


    public function view_operation(): void
    {
        $user = $this->get_user_or_redirect();
        $id_operation = $_GET["param1"];
        $id_user = $user->id;
        $operation = operation::get_operation_by_id($id_operation);
        $tricount = tricount::get_tricount_by_id($operation->tricount);
        $operations = operation::get_operations($tricount);
        $operation_amount = user::get_amount_operations($operation);
        $nbr_operations = (count($operations));
        $all_operation = $operation::get_operations($tricount);
        if (operation::security_operation($id_user, $all_operation)) {
            $id_next_operation = operation::get_next_operation($id_operation, $all_operation);
            $id_previous_operation = operation::get_prev_operation($id_operation, $all_operation);
            $id_first_operation = $all_operation[0]->id;
            $id_last_operation = $all_operation[count($all_operation) - 1]->id;
            $cmpt = $operation::get_including_operation_by_idUser_operationId($id_user, $operation->id); ////if the user includ in operation return >=1 si nn 0
            (new View("operation"))->show(["id_next_operation" => $id_next_operation, "id_previous_operation" => $id_previous_operation, "operation" => $operation, "all_operation" => $all_operation, "id_operation" => $id_operation, "tricount" => $tricount, "id_user" => $id_user, "operations" => $operations, "cmpt" => $cmpt, "operation_amount" => $operation_amount, "nbr_operations" => $nbr_operations, 'id_first_operation' => $id_first_operation, "id_last_operation" => $id_last_operation]);

        } else
            $this->redirect("error");

    }


    public function add_operation(): void
    {

        $user = $this->get_user_or_redirect();
        $idUser = $user->id;
        $idTricount = $_GET["param1"];
        $paid = "";
        $name = "";
        $date = "";
        $amount = "";
        $title = "";
        $itr = "";


        $errors = "";
        $paidBy = [];
        $allName = [];
        $allUseId = [];
        $allWeight = [];
        $tableau = [];
        $errors = [];
        $paidBy = user::get_all_user();
        $tricount = tricount::get_tricount_by_id($idTricount);
        if (isset($_POST['title']) && isset($_POST["amount"]) && isset($_POST["date"])) {
            $title = $_POST['title'];
            $amount = $_POST['amount'];
            $date = $_POST["date"];
            $itr = $_POST["paid"];

            $itrator = user::get_user_by_name($itr);
            $newoperation = new operation($title, $idTricount, $amount, $date, $itrator);


            $errors = operation::validateOperation($newoperation);
            if (empty($errors)) {
                $newoperation->add_operation();


                $idNewOperation = operation::getIdOperatiobByTitle($newoperation->title);
                foreach ($paidBy as $index => $person) {
                    if (isset($_POST['checkbox_' . $index]) && isset($_POST['weight_' . $index])) {
                        $checkbox = $_POST['checkbox_' . $index];
                        $weight = $_POST['weight_' . $index];

                        array_push($allWeight, $weight);

                        $userId = user::get_user_by_name($checkbox);
                        array_push($allUseId, $userId);
                    }
                }
            }

            $tableau = array_combine($allUseId, $allWeight);


            foreach ($tableau as $userId => $weight) {
                $weight = intval($weight);
                if ($weight === 0) {
                    $weight = 1;
                }


                operation::add_reartition($idNewOperation, $userId, $weight);
            }
            $this->redirect("tricount", "view_tricount/$idTricount/$idUser");


        }

        $paidBy = user::get_all_user();
        (new View("add_operation"))->show(["tricount" => $tricount, "title" => $title, "amount" => $amount, "date" => $date, "paid" => $itr, "paidBy" => $paidBy, "errors" => $errors, "idUser" => $idUser]);
    }

    public function delete_opertation(): void
    {
        $id_operation = $_GET["param1"];

        $operation = operation::get_operation_by_id($id_operation);
        (new View("delete_operation"))->show(["operation" => $operation]);
    }

    public function delete_confirmation(): void
    {

        $id_operation = $_GET["param1"];
        $operation = operation::get_operation_by_id($id_operation);
        $operation::delete_operation($id_operation);
        $this->redirect("tricount", "tricount");


        (new View("delete_operation"))->show(["operation" => $operation]);
    }


}






