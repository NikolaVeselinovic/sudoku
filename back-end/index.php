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

                $odgovor["message"] = "User added.";
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

        if ($db->getAllUsers()) {
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


Flight::start();