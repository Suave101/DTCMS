<?php date_default_timezone_set("America/Chicago");?>
<!DOCTYPE html>
<head>
    <title>DTC - Scoring System</title>
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
    </div>
    <p>Welcome to the DTC Scoring System. If you are a team member, coach, or spectator, you can see the current scores on the current scores page. If you are a judge or administrator, you can access your tools via the login page.</p>
</body>
</html>