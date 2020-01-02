<?php
include "back-end/user.php";
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
$invalid = 0;
$valid = 0;

if(!empty($_GET)){
    if(isset($_GET['u'])){
        $valid=$_GET['u'];
    }
}

if (!empty($_POST)) {
    if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['lastname'])) {
        $user_name = trim($_POST['user_name']);
        $password = trim($_POST['password']);
        $password_hash = md5($password);
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        $lastname = trim($_POST['lastname']);

        if ((!empty($user_name)) && (!empty($password)) && (!empty($email)) && (!empty($name)) && (!empty($lastname))) {
            $data = array("id" => $_SESSION['user']->id,"email" => $email, "password" => $password_hash, "name" => $name, "user_name" => $user_name, "lastname" => $lastname);
            $data_string = json_encode($data);
            $ch = curl_init('http://localhost/sudoku/back-end/edit-profile');
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
            var_dump($result);
            $result_json = json_decode($result);
            var_dump($result_json);
            if (property_exists($result_json, 'id')) {
                $user = new User($result_json->id, $result_json->user_name, $result_json->password, $result_json->email, $result_json->name, $result_json->lastname, $result_json->isAdmin);
                $_SESSION['user'] = $user;
                header("Location: edit-profile.php?u=1");
            } else {
                $invalid = 1;
            }
        }
    }
}else{
    $hash = $_SESSION['user']->password;
    $hash_type = "md5";
    $email = "nikolaveselinovic388@gmail.com";
    $code = "f2ce482aab6c1b95";
    $url = "https://md5decrypt.net/en/Api/api.php?hash=".$hash."&hash_type=".$hash_type."&email=".$email."&code=".$code;
    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    $password = file_get_contents($url, false, $context);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="fonts/font-style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <link rel="stylesheet" type="text/css" href="css/style-responsive.css">

    <title>Sudoku - Edit profile</title>
</head>

<body>
    <main>
        <section class="welcome">
        <form action="" method="post" class="signup edit">
                <em>Edit profile</em>
                <input type="text" name="name" placeholder="Name" value="<?php echo $_SESSION['user']->name; ?>" required>
                <input type="text" name="lastname" placeholder="Last name" value="<?php echo $_SESSION['user']->lastname; ?>" required>
                <input type="text" name="user_name" placeholder="Username" value="<?php echo $_SESSION['user']->user_name; ?>" required>
                <input type="text" name="email" placeholder="E-mail" value="<?php echo $_SESSION['user']->email; ?>" required>
                <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                <?php if ($invalid == 1) { ?>
                    <p class="warning">Username or email already exists!</p>
                <?php } ?>
                <?php if ($valid == 1) { ?>
                    <p class="warning good">User successfully updated!</p>
                <?php } ?>
                <button type="submit" action="">Save</button>
                <a href="menu.php">Back to Menu</a>
            </form>
        </section>
    </main>
</body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
</html>