<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php require_once("php/functions.php") ?>
</head>
<body>
    <?php 
        if(isset($_POST['uname']) && isset($_POST['passwd']) AND islogin($_POST['uname'], $_POST['passwd']) ){
            echo "niiiice";
        }else {
            echo "Not nice";
        }
    ?>
</body>
</html>