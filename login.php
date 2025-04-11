<!DOCTYPE html>
<?php
        session_start(); //Startar sessionen
        $host="localhost";
        $user="root";
        $pass="";
        $db="luminarareal";
        $conn=mysqli_connect($host,$user,$pass,$db);
        if(isset($_POST['btnLogin'])){
            $username=$_POST['username']; //Gotta make variable for the SQL
            $password=$_POST['password'];
            $strQuery="SELECT * FROM users WHERE username='$username' AND password='$password';";  
            if($result=mysqli_query($conn,$strQuery)){ //Was it possible to question the database for this?
                if(!mysqli_num_rows($result)==1){   //It was, now check if it didn't was just one row
                   //echo "Inte inloggad!";  //Batty boy!
                   $_SESSION['5sp']="";
                   $_SESSION['5ddf']="";
                   $_SESSION['name']="";  
                   header("Location: login.php"); //Redirect to the login page                 
                }else{  //You made it! you are authorized!
                    $raden=mysqli_fetch_assoc($result);   //Get the row with data
                    //echo "Välkommen ".strtoupper($raden['username']); //use this to print name
                    $_SESSION['5sp']=$raden['id'];
                    $_SESSION['5ddf']=$raden['userlevel'];
                    $_SESSION['name']=$raden['username'];
                    header("Location: Luminara.php"); //Redirect to the home page
                }
            }   
        }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grg</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
 

    <form action="login.php" method="post">
    <label for="username">Användarnamn:</label><br>
    <input type="text" name="username" required><br>

    <label for="password">Lösenord:</label><br>
    <input type="password" name="password" required><br>

    <button type="submit" name="btnLogin">Logga in</button>
</form>



</body>
</html>