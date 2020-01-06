<?php
require 'flight/Flight.php';
require 'jsonindent.php';

Flight::register('db', 'Database', array('sudoku'));
$json_podaci = file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci);


Flight::route('/', function () {
    echo 'hello world!';
});

Flight::route('POST /signup', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["message"] = "Empty";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (
            !property_exists($podaci, 'email') || !property_exists($podaci, 'password') || !property_exists($podaci, 'user_name')
            || !property_exists($podaci, 'name') || !property_exists($podaci, 'lastname')
        ) {
            $odgovor["message"] = "Incorect data.";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->addUser($podaci->user_name, $podaci->email, $podaci->password, $podaci->name, $podaci->lastname)) {
                if ($db->result->num_rows > 0) {
                    $odgovor = $db->result->fetch_object();
                }else{
                    $odgovor["message"] = "Error";
                }
                
            } else {
                $odgovor["message"] = "Error";
            }
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        }
    }
});

Flight::route('POST /login', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["message"] = "Empty";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (!property_exists($podaci, 'email') || !property_exists($podaci, 'password')) {
            $odgovor["message"] = "Incorect data.";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->getUser($podaci->email, $podaci->password)) {
                if ($db->result->num_rows > 0) {
                    $odgovor = $db->result->fetch_object();
                } else {
                    $odgovor["message"] = "Email or password is incorect.";
                }
            }
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        }
    }
});

Flight::route('GET /users', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    if(isset($_GET['key'])){
        $key = $_GET['key'];
    }else{
        $key = "";
    }
        if ($db->getAllUsers($key)) {
            if ($db->result->num_rows > 0) {
                $odgovor = [];
                while($row = $db->result->fetch_object()){
                    array_push($odgovor, $row);
                }                
            } else {
                $odgovor["message"] = "Error";
            }
        }
        $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    
});

Flight::route('GET /results', function(){
	header ("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $desc = 0;
    if(isset($_GET['desc'])){
        if($_GET['desc']==1){
            $desc = 1;
        }
    }
    if ($db->getAllScores($desc)) {
        if ($db->result->num_rows > 0) {
            $odgovor = [];
            while($row = $db->result->fetch_object()){
                array_push($odgovor, $row);
            }                
        } else {
            $odgovor["message"] = "Error";
        }
    }
    $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
    echo $json_odgovor;
    return false;
});

Flight::route('POST /results', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["message"] = "Empty";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (!property_exists($podaci, 'userid') || !property_exists($podaci, 'time') || !property_exists($podaci, 'date')) {
            $odgovor["message"] = "Incorect data.";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->saveResult($podaci->userid, $podaci->time, $podaci->date)) {              
                    $odgovor["message"] = "Successfully saved result";
            }
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        }
    }
});


Flight::route('DELETE /user/@username', function($username){
    header ("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    if ($db->deleteUser($username)){
            $response["message"] = "User successfully deleted!";
            $json_response = json_encode ($response,JSON_UNESCAPED_UNICODE);
            echo $json_response;
            return false;
    } else {
            $response["message"] = "Error";
            $json_response = json_encode ($response,JSON_UNESCAPED_UNICODE);
            echo $json_response;
            return false;
    
    }		
            
});
Flight::route('GET /user/@id', function($id){
    header ("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    if ($db->getUserById($id)){
        if ($db->result->num_rows > 0) {
            $response =  $db->result->fetch_object();               
        } else {
            $response["message"] = "Error";
        }
        $json_response = json_encode ($response,JSON_UNESCAPED_UNICODE);
        echo $json_response;
        return false;
    } else {
            $response["message"] = "Error";
            $json_response = json_encode ($response,JSON_UNESCAPED_UNICODE);
            echo $json_response;
            return false;
    
    }		
            
});


Flight::route('POST /edit-profile', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["message"] = "Empty";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (
            !property_exists($podaci, 'email') || !property_exists($podaci, 'password') || !property_exists($podaci, 'user_name')
            || !property_exists($podaci, 'name') || !property_exists($podaci, 'lastname') || !property_exists($podaci, 'id')
        ) {
            $odgovor["message"] = "Incorect data.";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->editUser($podaci->id, $podaci->user_name, $podaci->email, $podaci->password, $podaci->name, $podaci->lastname)) {
                if ($db->result->num_rows > 0) {
                    $odgovor = $db->result->fetch_object();
                }else{
                    $odgovor["message"] = "Error";
                }
                
            } else {
                $odgovor["message"] = "Error";
            }
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        }
    }
});

Flight::start();
