
<?php
include("back-end/user.php");
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
                <?php
                foreach($result_json as $key => $user){?>
                <li class="row">
                    <em><?php echo $key+1; ?></em>
                    <em><?php echo $user->user_name; ?></em>
                    <em><?php echo $user->name; ?></em>
                    <em><?php echo $user->lastname; ?></em>
                    <em></em>
                </li>
                <?php } ?>
            </ul>
        </div>
        </section>
    </main>
    
</body>
</html>