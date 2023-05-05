<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="stylee.css">
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION['user_name'];?></h1>
    </body>
    </html>

    <?php
}
else{
    header("Location: index.php");
    exit();
}
?>