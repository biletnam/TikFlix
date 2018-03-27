<?php
   session_start();
   include("config.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $server = $_SERVER['SERVER_NAME'];
      $trimmedEmail = preg_replace("/[^A-Za-z0-9 ]/", '', $email);

      // echo "<p>Username: $username 
      //          Password: $password </p>";
      // echo $_SERVER['SERVER_NAME'];

      try {
          $userConnection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, $trimmedEmail, $password);
          // set the PDO error mode to exception
          $userConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";

          $_SESSION['trimmedEmail'] = $trimmedEmail;
          $_SESSION['password'] = $password;

          header('location: index.html');

      } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
      }
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
                <!-- <span class="help-block"><?php echo $username_err; ?></span> -->  
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>