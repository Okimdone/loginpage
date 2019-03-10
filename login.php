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
        if(isset($_POST['uname']) && isset($_POST['psswd']) AND islogin($_POST['uname'], $_POST['psswd']) ){
            echo "niiiice <br>";}
        else {
        	 echo "Not nice <br>";
        }
    ?>

    <?php
        if(isset($_POST['uname1']) && isset($_POST['psswd1']) && isset($_POST['confpsswd'])){
        	  enregistrer($_POST['uname1'],$_POST['psswd1']);
        }
        else if (strnatcmp($_POST['psswd1'],$_POST['confpsswd']) != 0 ) {
        	echo "votre mdp est erroné <br>";
        }
    ?>

</body>
</html>