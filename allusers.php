<?php
include("back-end/user.php");
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$ch = curl_init('http://localhost/sudoku/back-end/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result_json = json_decode($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <link rel="stylesheet" type="text/css" href="css/style-responsive.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            getAllUsers('<?php echo $_SESSION['user']->id; ?>', '', '', '');
                    
            $('#username').on('input', function(e) {
                setTimeout( function(){
                    getAllUsers('<?php echo $_SESSION['user']->id; ?>', $('#username').val(), $('#name').val(), $('#lastname').val());
                },500);
            });
            $('#name').on('input', function(e) {
                setTimeout( function(){
                    getAllUsers('<?php echo $_SESSION['user']->id; ?>', $('#username').val(), $('#name').val(), $('#lastname').val());
                },2000);
            });
            $('#lastname').on('input', function(e) {
                setTimeout( function(){
                    getAllUsers('<?php echo $_SESSION['user']->id; ?>', $('#username').val(), $('#name').val(), $('#lastname').val());
                },2000);
            });

        });

        // $( "input" ).html('milos');


        (function() {
            var css = document.createElement('link');
            css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css';
            css.rel = 'stylesheet';
            css.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All users</title>
</head>

<body>
    <main>
        <section class="welcome">
            <div class="allusers">
                <h5>All users</h5>
                <ul>
                    <li>
                        <em>&#8470;</em>
                        <em>Username</em>
                        <em>Name</em>
                        <em>Lastname</em>
                        <em></em>
                    </li>
                    <li class="search">
                        <form autocomplete="off" action="" name="search" class="form">
                            <em></em>
                            <em><input id="username" type="text" name="username" placeholder="Username"></em>
                            <em><input id="name" type="text" name="name" placeholder="Name"></em>
                            <em> <input id="lastname" type="text" name="lastname" placeholder="Lastname"></em>
                            <em></em>
                        </form>
                    </li>

                    <?php
                    /* foreach ($result_json as $key => $user) { ?>
                        <li class="row">

                            <em><?php echo $key + 1; ?></em>
                            <em><?php echo $user->user_name; ?></em>
                            <em><?php echo $user->name; ?></em>
                            <em><?php echo $user->lastname; ?></em>
                            <em class="icons">
                                <?php if ($user->user_name != $_SESSION['user']->user_name) { ?>
                                    <i class="fas fa-trash-alt" onclick="deleteUser('<?php echo $user->user_name; ?>')"></i>
                                <?php } ?>
                                <i class="fas fa-pencil-alt" onclick="editUser('<?php echo $user->id; ?>')"></i>
                            </em>
                        </li>
                                <?php }*/ ?>
                </ul>
            </div>
        </section>
    </main>

</body>


</html>