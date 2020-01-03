<?php
include("back-end/user.php");
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$ch = curl_init('http://localhost/sudoku/back-end/results');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result_json = json_decode($result);
//  var_dump($result_json);
//  die();
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
        // $(document).ready(function(){
        //     sort();
        // });
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
            <div class="rank">
                <h5>Ranking list</h5>
                <ul>
                    <li class="column">
                        <em>&#8470;</em>
                        <em>Username</em>
                        <em>Name</em>
                        <em>Lastname</em>
                        <em>Score</em>
                        <em class="icons">
                            <i class="fas fa-sort-up"></i></i>
                            <i class="fas fa-sort-down"></i>
                        </em>
                    </li>
                    <?php
                    foreach ($result_json as $key => $user) { ?>
                        <li class="row">
                            <em><?php echo $key + 1; ?></em>
                            <em><?php echo $user->user_name; ?></em>
                            <em><?php echo $user->name; ?></em>
                            <em><?php echo $user->lastname; ?></em>
                            <em><?php echo $user->timeInSeconds; ?></em>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </section>
    </main>

</body>


</html>