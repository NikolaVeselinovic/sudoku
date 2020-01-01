<?php
session_start();
include("back-end/user.php");
$invalid = 0;

if (!empty($_POST)) {
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password_hash = md5($password);

        if ((!empty($email)) && (!empty($password))) {
            $data = array("email" => $email, "password" => $password_hash);
            $data_string = json_encode($data);

            $ch = curl_init('http://localhost/sudoku/back-end/login');
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

                <?php if ($invalid == 1) { ?>
                    <p class="warning">Incorrect email or password!</p>
                <?php } ?>
                <button class="frm-btn" type="submit" value="Login">Login</button>
                <p>Not a member?<a href="<?php echo 'signup.php'; ?>"> Sign up now!</a></p>
            </form>
        </section>
    </main>
</body>

</html>