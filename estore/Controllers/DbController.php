<?php

//use LDAP\Result;

class DbController{
    public $DbHost="localhost";
    public $DbName="estore";
    public $DbUser="root";
    public $DbPassaword="";
    public $Connection;

    public function openconnection(){
        $this->Connection=new mysqli($this->DbHost,$this->DbUser,$this->DbPassaword,$this->DbName);
        if($this->Connection->connect_errno){
            echo "FAILED TO CONNECT DATABASE : ". $this->Connection->connect_errno ;
            return false;
        }
        else{
            return true;
        }
    }
    public function Closeconnection(){

        if($this->Connection){
            $this->Connection->Closeconnection;
        }
        else{
            echo "connection isnot opened";
        }
    }
    public function select($qry){
        $result=$this->Connection->query($qry);
        if(!$result){
            echo "ERROR IN QUERY : " .mysqli_error($this->Connection);
            return false;
        }
        else{
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function insert($qry){
        $result=$this->Connection->query($qry);
        if(!$result){
            echo "ERROR IN QUERY : " .mysqli_error($this->Connection);
            return false;
        }
        else{
            
            return $this->Connection->insert_id;
        }
    }
    public function delete($qry){
        $result=$this->Connection->query($qry);
        if(!$result){
            echo "ERROR IN QUERY : " .mysqli_error($this->Connection);
            return false;
        }
        else{
            
            return $result;
        }
    }
}

?>