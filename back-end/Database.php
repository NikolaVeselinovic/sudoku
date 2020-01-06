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
    function getUserById($id){
        $query = "SELECT `id`, `user_name`, `password`, `email`, `name`, `lastname`, `isAdmin` FROM `user` WHERE `id`='" . $id. "' LIMIT 0, 25";
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
    function getAllUsers($key){
        $query = "SELECT `id`, `user_name`, `password`, `email`, `name`, `lastname`, `isAdmin` FROM `user`
         WHERE  `user_name` LIKE '%".$key."%'  OR `name` LIKE '%".$key."%'  OR `lastname` LIKE '%".$key."%'";
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
   
    function getAllScores($desc){
        if($desc == 1){
            $query = "SELECT `user`.`id`, `user`.`user_name`, `user`.`name`, `user`.`lastname`, `r`.`id`, `r`.`user_id`, `r`.`timeInSeconds` FROM `result` `r` INNER JOIN (SELECT `result`.`user_id`, MIN(`result`.`timeInSeconds`)
             AS `score` FROM `result` GROUP BY `result`.`user_id`) `grouped` ON `r`.`user_id` = `grouped`.`user_id` AND `r`.`timeInSeconds` = `grouped`.`score` INNER JOIN `user` ON `user`.`id`=`r`.`user_id` 
             ORDER BY `r`.`timeInSeconds` DESC ";
        }else {
            $query = "SELECT `user`.`id`, `user`.`user_name`, `user`.`name`, `user`.`lastname`, `r`.`id`, `r`.`user_id`, `r`.`timeInSeconds` FROM `result` `r` INNER JOIN (SELECT `result`.`user_id`, MIN(`result`.`timeInSeconds`)
            AS `score` FROM `result` GROUP BY `result`.`user_id`) `grouped` ON `r`.`user_id` = `grouped`.`user_id` AND `r`.`timeInSeconds` = `grouped`.`score` INNER JOIN `user` ON `user`.`id`=`r`.`user_id` 
            ORDER BY `r`.`timeInSeconds` ASC ";
        }
        if ($this->result = $this->dblink->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    function saveResult($userid, $time, $date){
        $query = "INSERT INTO `result`(`user_id`, `timeInSeconds`, `date`) VALUES ('". $userid ."','".$time."','".$date."')";
        if ($this->dblink->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    
}
