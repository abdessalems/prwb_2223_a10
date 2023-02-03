<?php


require_once 'model/User.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerMain extends Controller
{

    public function index(): void // todo : Don't change page index because first page after login list tricount
    {
        if ($this->user_logged()) {
            $this->redirect("tricount", "tricount");
        } else {
            (new View("index"))->show();
        }

    }


//    public function index() : void {
    //    if ($this->user_logged()) {
    //      $this->redirect("user", "full_name");
    //     } else {
    //       (new View("signup"))->show();
    //   }
    //  }

    public function signup(): void
    {
        $mail = '';
        $fullname = '';
        $iban = '';
        $password = '';
        $password_confirm = '';
        $errors = [];


        if (isset($_POST['mail']) && isset($_POST['fullname']) && isset($_POST['iban']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
            $mail = $_POST['mail'];
            $fullname = trim($_POST['fullname']);
            $iban = $_POST['iban'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

                $user = new user ($mail, Tools::my_hash($password), $fullname);
            $errors = user::validate_unicity($mail);
            $errors = array_merge($errors, $user->validate());
            $errors = array_merge($errors, user::validate_name($fullname));
            $errors = array_merge($errors, user::validate_iban($iban));
            // $errors = array_merge($errors, user::validate_passwords($password, $password_confirm));

            if (count($errors) == 0) {
                $user->persist(); //sauve l'utilisateur
                $this->log_user($user);
            }
        }


        (new View("signup"))->show(["mail" => $mail, "fullname" => $fullname, "iban" => $iban, "password" => $password,
            "password_confirm" => $password_confirm, "errors" => $errors]);


    }

    //gestion de la connexion d'un utilisateur
    public function login(): void
    {
        $mail = '';
        $password = '';
        $errors = [];
        if (isset($_POST['mail']) && isset($_POST['password'])) { //note : pourraient contenir des chaînes vides
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            $errors = user::validate_login($mail,$password);
            if (empty($errors)) {
                $this->log_user(user::get_user_by_mail($mail));
            }
        }
        (new View("login"))->show(["mail" => $mail, "password" => $password, "errors" => $errors]);
    }

    /**
     * Console_log is used to show php logs in the browser console (js console)
     * mainly used for inspecting the variables to help in debug
     * @param $output
     * @param $with_script_tags
     * @return void
     */
    public static function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }



}

