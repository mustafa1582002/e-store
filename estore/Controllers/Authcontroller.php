<?php
require_once '../../Modals/user.php';
require_once '../../Controllers/DbController.php';

class Authconroller{
    protected $db;

    public function login(User $user){
        $this->db = new DbController();
        
        if($this->db->openconnection()){
            $query= "select * from users where email = '$user->email' and password = '$user->password'";
            $result=$this->db->select($query);
            
            if($result===false){
                echo "ERROR IN QUERY : ";
                return false;
            }
            else{
                if(count($result)==0){
                    session_start();
                    $_SESSION['errMsg']="you have entered wrong data : ";
                    $this->db->closeconnection();
                    return false;
                }
                else{
                    session_start();
                    $_SESSION['userId']=$result[0]['Id'];
                    $_SESSION['Name']=$result[0]['Name'];
                    if($result[0]['RoleId']==1)
                    {
                        $_SESSION['RoleId']="Admin";
                    }
                    else{
                        $_SESSION['RoleId']="Client";
                    }
                    $this->db->closeconnection();
                    return true;
                }
            }
        }
        else{
            echo "ERROR IN DATABASE CONNECTION : ";
        return false;
        }
    }


    public function register(User $user){
        $this->db = new DbController();
        
        if($this->db->openconnection())
        {
            $query= "insert into users values ('','$user->name','$user->email','$user->password','2')";
            $result=$this->db->insert($query);
            if($result!=false)
            {
                session_start();
                $_SESSION['email']=$user->email;
                $_SESSION['Name']=$user->name;
                $_SESSION["RoleId"]="Client";
                $this->db->closeconnection();
                return true;
            }
            else
            {
            $_SESSION["errMsg"]="Somthing went wrong... try again later";
            $this->db->closeconnection();
            return false;
            }
        }
        else{
        echo "ERROR IN DATABASE CONNECTION : ";
        $this->db->closeconnection();
        return false;
        }
    }
}
?>