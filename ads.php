<?php
include_once "Operation.php";
include_once "Database.php";

class Ads extends Database implements operation{
    public function Add(){
       
    }
    public function Update(){
       
    }
    public function UpdatePW(){
       
    }
    public function Delete(){
        
    }
    public function Getall(){
        return parent::GetData("select * from ads where endtime > CURDATE()");
    }
}
