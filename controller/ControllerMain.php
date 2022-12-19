<?php

require_once 'model/Member.php';
require_once 'framework/View.php';
require_once 'framework/Controller.php';

class ControllerMain extends Controller {
    public function index() : void {
        echo "<h1>Heyjj!</h1>";
    }

}