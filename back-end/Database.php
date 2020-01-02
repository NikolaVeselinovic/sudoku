<?php
class Database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname;
    private $dblink;
    public $result;

    function __construct($dbname)
    {
        $this->dbname = $dbname;
        $this->Connect();
    }

    function Connect()
    {
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if ($this->dblink->connect_errno) {
            printf("Konekcija neuspešna: %s\n", $this->dblink->connect_error);
            exit();
        }
        $this->dblink->set_charset("utf8");
    }

    function getUser($email, $password){
        $query = "SELECT `id`, `user_name`, `password`, `email`, `name`, `lastname`, `isAdmin` FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "' LIMIT 0, 25";
        if ($this->result = $this->dblink->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    function addUser($username, $email, $password, $name, $lastname){
        $query="INSERT INTO `user`(`user_name`, `password`, `email`, `name`, `lastname`, `isAdmin`) VALUES ('".$username."','".$password."','".$email."','".$name."','".$lastname."',0)";
        if ($this->dblink->query($query)) {
            $last_id = $this->dblink->insert_id;
            $query = "SELECT `id`, `user_name`, `password`, `email`, `name`, `lastname`, `isAdmin` FROM `user` WHERE `id`='" . $last_id . "' LIMIT 0, 25";
            if ($this->result = $this->dblink->query($query)) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    function editUser($id, $username, $email, $password, $name, $lastname){
        $query = "UPDATE `user` SET `user_name`='". $username ."',`password`='". $password ."',`email`='". $email ."',`name`='". $name ."',`lastname`='". $lastname ."' WHERE `id`='". $id ."'";
        // $query="INSERT INTO `user`(`user_name`, `password`, `email`, `name`, `lastname`, `isAdmin`) VALUES ('".$username."','".$password."','".$email."','".$name."','".$lastname."',0)";
        if ($this->dblink->query($query)) {
            $query = "SELECT `id`, `user_name`, `password`, `email`, `name`, `lastname`, `isAdmin` FROM `user` WHERE `id`='" . $id. "' LIMIT 0, 25";
            if ($this->result = $this->dblink->query($query)) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    function getAllUsers(){
        $query = "SELECT `id`, `user_name`, `password`, `email`, `name`, `lastname`, `isAdmin` FROM `user`";
        if ($this->result = $this->dblink->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    
    function deleteUser($username){
        $query="DELETE FROM `user` WHERE `user_name`='" . $username . "'";
        if ($this->dblink->query($query)) {
            return true;
        } else {
            return false;
        }
    }
   

    
}
