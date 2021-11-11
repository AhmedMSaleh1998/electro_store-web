<?php

class validation {

    public function validateName($_POST["txtname"]){
        if (empty($_POST["txtname"])) {
            $nameErr = "Name is required";
            // check if name only contains letters and whitespace
        } elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST["txtname"])){
            $nameErr = "Only letters and white space allowed";
        }else{
             return $cust->setname($_POST["txtname"]);
            }
    }
}

?>