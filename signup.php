<?php
// session_start();
// include("user.php");

// if (!empty($_POST)) {
//     if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {

//         include("database.php");
//         $db = new database("mydatabase");

//         $firstname = trim($_POST['firstname']);
//         $lastname = trim($_POST['lastname']);
//         $email = trim($_POST['email']);
//         $password = trim($_POST['password']);
//         $password_hash = md5($password);

//         if ((!empty($firstname)) && (!empty($lastname)) && (!empty($email)) && (!empty($password_hash))) {
            
//             if ($db->addUser($firstname, $lastname, $email, $password_hash)) {
//                 $lastId=$db->dblink->insert_id;
//                 $user = new User($lastId, $firstname, $lastname, $email, $password);
//                 $_SESSION['user'] = $user;
//                 header("Location:home.php");
//             } else {
//                 echo 'User is not entered in database!';
//             }
//         }
//     }
// }
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
                <em>Sign up</em>
                <span>It's quick and easy!</span>

                <input type="text" name="firstname" placeholder="First name" required>
                <input type="text" name="lastname" placeholder="Last name" required>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit" action="">Sign Up</button>
                <p>By clicking Sing Up you agree to our<a href="#"> Terms Data Policy</a> and<a href="#"> Cookie Policy.</a> You may receive SMS notifications from us and can opt out at any time.</p>
            </form>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>