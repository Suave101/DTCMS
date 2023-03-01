<?php date_default_timezone_set("America/Chicago");session_start();if(isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])){if($_SESSION["authenticated"]==true and $_SESSION["userData"]["role"]<2)
  {header("Location: submitLogin.php");die();}}?>

<!DOCTYPE html>
<head>
    <title>DTC - Scoring System</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
        <a href="#about">About</a>
    </div>
    <h1>Login</h1>
    <form action="submitLogin.php" method="post">
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required>
      
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>
          <button type="submit">Login</button>
        </div>
      </form>
</body>
</html>