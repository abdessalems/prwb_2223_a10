<?php

require_once "framework/Model.php";

class reoperation extends Model {

    public function __construct(public int $weight,  public int $user) {

    }


}