<?php 

$user = "";
$usererror = false;

if(isset($_POST['submit']))
{
    $user=$_POST['username'] ?? "";
    $pass=$_POST['password'] ?? "";
    $cpass = $_POST['confirm-password'] ?? "";
    $email=$_POST['email'] ?? "";
    $hash = password_hash($pass, PASSWORD_DEFAULT); 

    if($pass != $cpass){
        $errormsg = "Passwords do not match.";
    }
    else{
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        require './includes/library.php';
        $pdo = connectDB();
        $query = "INSERT INTO `3420project_accounts`(`username`, `password`, `email`) VALUES (?,?,?);";
        $stmnt = $pdo->prepare($query);
        $stmnt->execute([$user, $hash, $email]);
        $result = $stmnt->fetch();
        $msg = "Registration Complete";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'includes/head-metadata.php';
    ?>
</head>
<body>
    <nav>
        <?php
            include 'includes/nav.php'
        ?>
    </nav>
    <div class="form-wrapper">
    <div class="form-container">
        <div class = "headtext">
           Create Account
        </div>
        
        <form id = "login" action="" method = "POST">
            <div class="text-box">
                <label for="username">Email Address:</label>
                <input type="email" id="email" name="email"/>
            </div>
            <div class="text-box">
                <label for="username">Enter Username:</label>
                <input type="text" id="username" name="username"/>
            </div>
            <div class="text-box">
                <label for="password">Enter Password:</label>
                <input type="password" id="password" name="password"/>
            </div>
            <div class="text-box">
                <label for="connfirm-password">Repeat Password:</label>
                <input type="password" id="confirm-password" name="confirm-password"/>
            </div>
            <button id="submit" name="submit" class="centered">Create Account</button>
            <img src="images/bg.jpg" alt="" class="loginbg">
        </form>        
    </div>
    </div>
</body>
</html>