<?php

require_once "framework/Model.php";

class tricount extends Model {


    public function __construct(public string $title,  public ?string $description = null,
    public string $created_at , public int $creator,) {

    }


}