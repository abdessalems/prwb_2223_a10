<?php

require_once "framework/Model.php";

class reoperation_template extends Model {


    public function __construct(public int $id,  public string $title) {

    }


}