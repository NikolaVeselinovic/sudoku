<?php
class User
{
    public $id;
    public $user_name;
    public $password;
    public $email;
    public $name;
    public $lastname;
    public $isAdmin;
    
    

    function __construct($id, $user_name, $password, $email, $name, $lastname, $isAdmin)
    {        

        $this->id = $id;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->isAdmin = $isAdmin;
     
    }

}
