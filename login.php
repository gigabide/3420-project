<?php 

$user = "";
$usererror = false;

if(isset($_POST['submit']))
{
  $user=$_POST['username'] ?? "";
  $pass=$_POST['password'] ?? "";

  require './includes/library.php';
  $pdo = connectDB();

  $query = "select * from `3420project_accounts` where username=?";
  $stmnt = $pdo->prepare($query);
  $stmnt->execute([$user]);
  $result = $stmnt->fetch();

    if (password_verify($pass, $result['password'])) {
      session_start();
      $_SESSION['username'] = $user;
      $_SESSION['userid'] = $result['userID'];
      header("Location:mywishlist.html");
      exit();
    }
    else {
      //flag login error
      $usererror = true;
    }
    echo $usererror;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $TITLE = "Login";
        include "includes/head-metadata.php";
    ?>
</head>
<body>
<div class="pixart">
    <nav>
        <?php
            include "includes/nav.php";
        ?>
    </nav>
</div>
    <div class="form-wrapper">
        <div class="form-container">
            <form action="" method = "POST">
                <div>
                    <h2 class = "">Login</h2>                
                </div>
                <div class="text-box">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" size="25" value="<?php echo $user ?>" />
                </div>
                <div class="text-box">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" size="25" />
                </div>
                <div>
                    <label for="remember">Remember:</label>
                    <input type="checkbox" name="remember" value="remember" />
                </div>
                <div class="button">
                     <button id="submit" name="submit" class="centered">Login</button>
                </div>
            </div>
            <img src="images/bg.jpg" alt="" class="loginbg">
            </form>
        </div>        
    </div>
</body>
</html>