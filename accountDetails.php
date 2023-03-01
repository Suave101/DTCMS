<?php date_default_timezone_set("America/Chicago");session_start();if(isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])){if($_SESSION["authenticated"]==true){$authenticated=true;}else{header("Location: login.php");die();}}else{header("Location: login.php");die();}?>
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
    <div>
        <h1>Welcome, <?php echo $_SESSION['userData']["first_name"]?></h1>
        <p>First Name: <?php echo $_SESSION['userData']["first_name"]?></p>
        <p>Last Name: <?php echo $_SESSION['userData']["last_name"]?></p>
        <p>Title: <?php if ($_SESSION["userData"]["role"] === 0){echo "Host";}if ($_SESSION["userData"]["role"] === 1){echo "Site Manager";}if ($_SESSION["userData"]["role"] === 2){echo "Site Technician";}if ($_SESSION["userData"]["role"] === 3){echo "Event Manager";}if ($_SESSION["userData"]["role"] === 4){echo "Event Technician";}if ($_SESSION["userData"]["role"] === 5){echo "Event Judge";}if ($_SESSION["userData"]["role"] === 6){echo "Team Leader";}?></p>
        <p>If any details are incorrect, please contact a site manager or host.</p>
    </div>
</body>
</html>