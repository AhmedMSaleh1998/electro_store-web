<?php
include_once "Operation.php";
include_once "Database.php";

class department extends Database implements Operation 
{
    public function Add(){      
    }
    public function Update(){
        
    } 
    public function Delete(){
        
    }
    public function Filter(){
        return parent::GetData("select * from product where name like '".$_GET["se"]."%'");
    }
    public function GetDepartmentById(){
        return parent::GetData("select * from department where departmentid='".$_GET["deptno"]."'");
    }
    public function GetAll(){
        return parent::GetData("select * from department");
    }
    public function GetPopular(){
        return parent::GetData("select * from department order by departmentid desc limit 6");
    }
}
?>