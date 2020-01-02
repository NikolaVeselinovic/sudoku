<?php
session_start();
include("back-end/user.php");
$invalid = 0;
if (!empty($_POST)) {
    if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['lastname'])) {
        $user_name = trim($_POST['user_name']);
        $password = trim($_POST['password']);
        $password_hash = md5($password);
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        $lastname = trim($_POST['lastname']);




        if ((!empty($user_name)) && (!empty($password)) && (!empty($email)) && (!empty($name)) && (!empty($lastname))) {
            $data = array("email" => $email, "password" => $password_hash, "name" => $name, "user_name" => $user_name, "lastname" => $lastname);
            $data_string = json_encode($data);

            $ch = curl_init('http://localhost/sudoku/back-end/signup');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string)
                )
            );

            $result = curl_exec($ch);
            $result_json = json_decode($result);
            if (property_exists($result_json, 'id')) {
                $user = new User($result_json->id, $result_json->user_name, $result_json->password, $result_json->email, $result_json->name, $result_json->lastname, $result_json->isAdmin);
                $_SESSION['user'] = $user;
                header("Location:home.php");
            } else {
                $invalid = 1;
            }
            // if ($db->addUser($firstname, $lastname, $email, $password_hash)) {
            //     $lastId=$db->dblink->insert_id;
            //     $user = new User($lastId, $firstname, $lastname, $email, $password);
            //     $_SESSION['user'] = $user;
            //     header("Location:home.php");
            // } else {
            //     echo 'User is not entered in database!';
            // }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-style.css">
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <link rel="stylesheet" type="text/css" href="css/style-responsive.css">
    <title>Signup</title>
</head>

<body>
    <main>
        <section class="welcome">
            <form action="" method="post" class="signup">
                <em>Signup</em>
                <span>It's quick and easy!</span>

                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="lastname" placeholder="Last name" required>
                <input type="text" name="user_name" placeholder="Username" required>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Password" required>
                <?php if ($invalid == 1) { ?>
                    <p class="warning">Username or password already exists!</p>
                <?php } ?>
                <button type="submit" action="">Sign Up</button>
                <p>By clicking Sing Up you agree to our<a href="#"> Terms Data Policy</a> and<a href="#"> Cookie Policy.</a> You may receive SMS notifications from us and can opt out at any time.</p>
            </form>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>