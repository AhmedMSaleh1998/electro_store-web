<?php
include_once "Operation.php";
include_once "Database.php";

class product extends Database implements Operation 
{
    public function Add(){      
    }
    public function Update(){
        
    } 
    public function Delete(){
        
    }
    public function Filter1(){
        return parent::GetData("select * from product where name like '".$_GET["se"]."%'");
    }
    public function Filter2(){
        return parent::GetData("select * from product where price <= '".$_GET["price[]"]."'");
    }
    public function GetAll(){
        return parent::GetData("select * from product");
    }
    public function GetProductById(){
        return parent::GetData("select * from product where productid='".$_GET["prono"]."'");
    }
    public function GetProductByDepartment(){
        return parent::GetData("select * from product where departmentid='".$_GET["deptno"]."'");
    }
    public function GetPopularMobile(){
        return parent::GetData("select * from product where departmentid=1 order by productid desc limit 3");
    }
    public function GetPopularLaptop(){
        return parent::GetData("select * from product where departmentid=13 order by productid desc limit 3");
    }
}
?>