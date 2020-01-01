<?php
    // session_start();
    // include("user.php");
    // $invalid = 0;

    // if (!empty($_POST)) {
    //     if (isset($_POST['email']) && isset($_POST['password'])) {

    //         include("database.php");
    //         $db = new database("mydatabase");

    //         $email = trim($_POST['email']);
    //         $password = trim($_POST['password']);
    //         $password_hash = md5($password);

    //         if ((!empty($email)) && (!empty($password))) {

    //             if ($db->getUser($email, $password_hash)) {
    //                 if ($db->result->num_rows > 0) {
    //                     $row = $db->result->fetch_object();
    //                     var_dump($row);
    //                     $user = new User($row->id, $row->firstname, $row->lastname, $row->email, $row->password);
    //                     $_SESSION['user'] = $user;
    //                     header("Location:home.php");
    //                 } else {
    //                     $invalid = 1;
    //                 }
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
    <link rel="stylesheet" type="text/css" href="fonts/font-style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <link rel="stylesheet" type="text/css" href="css/style-responsive.css">

    <title>Login</title>
</head>

<body>
    <main>
        <section class="welcome">
            <form action="" method="POST">
                <em>Login</em>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Password" required>

                <?php //if ($invalid == 1) {?>
                    <!-- <p class="warning">Incorrect email or password!</p> -->
                <?php //} ?>
                <button class="frm-btn" type="submit" value="Login">Login</button>
                <p>Not a member?<a href="<?php echo 'signup.php'; ?>"> Sign up now!</a></p>
            </form>
        </section>
    </main>
</body>

</html>