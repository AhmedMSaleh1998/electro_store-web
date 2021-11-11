<?php
include_once "Operation.php";
include_once "Database.php";
class customer extends Database implements operation{

    var $customerid;
    var $name;
    var $password;
    var $phone;
    var $email;
    var $country;
    var $state;
    var $city;

    public function getcustid(){
        return $this->customerid;
    }
    public function setcustid($value){
        $this->custid= $value;
    }
    public function getname(){
        return $this->name;
    }
    public function setname($value){
        $this->name= $value;
    }
    public function getpassword(){
        return $this->password;
    }
    public function setpassword($value){
        $this->password=$value;
    }
    public function getphone(){
        return $this->phone;
    }
    public function setphone($value){
        $this->phone=$value;
    }
    public function getemail(){
        return $this->email;
    }
    public function setemail($value){
        $this->email=$value;
    }
    public function getcountry(){
        return $this->country;
    }
    public function setcountry($value){
        $this->country=$value;
    }
    public function getstate(){
        return $this->state;
    }
    public function setstate($value){
        $this->state=$value;
    }
    public function getcity(){
        return $this->city;
    }
    public function setcity($value){
        $this->city=$value;
    }
    
    public function Add(){
        return parent::RunDML("insert into customer values (Default,'".$this->getname()."','".$this->getpassword()."','".$this->getphone()."','".$this->getemail()."','".$this->getcountry()."','".$this->getstate()."','".$this->getcity()."')");
    }
    public function Update(){
        return parent::RunDML("update customer set name='".$this->getname()."',password='".$this->getpassword()."',phone='".$this->getphone()."',email='".$this->getemail()."',country='".$this->getcountry()."',state='".$this->getstate()."',city='".$this->getcity()."' where customerid='".$_SESSION["id"]."'");
    }
    public function UpdatePW(){
        return parent::RunDML("update customer set  Password='".$this->getpassword()."' where customerid='".$_GET["id"]."'");
    }
    public function Delete(){
        return parent::RunDML("delete from customer  where customerid='".$_SESSION["id"]."'");
    }
    public function Getall(){

    }
    public function Login(){
        $rs = parent::GetData("select * from customer where
                           ( email   = '".$this->getemail()   ."'  or
                            phone    = '".$this->getphone()   ."') and
                            password = '".$this->getpassword()."'
                            ");
                return $rs;
    }
    public function GetByID(){
        $rs=parent::GetData("select * from customer where customerid='".$_SESSION["id"]."'");
        return $rs;
    }
    public function GetByEmail(){
        $rs=parent::GetData("select * from customer where email='".$this->getemail()."'");
        return $rs;
    }
}

?>