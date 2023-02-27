<?php
session_start();
$myfile = fopen("scores.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("scores.json"));
fclose($myfile);
if (isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])) {
    if ($_SESSION["authenticated"] == true and $_SESSION["userData"]["role"] < 3) {
        $authenticated = true;
    } else {
        header("Location: login.php");
        die();
    }
} else {
    header("Location: login.php");
    die();
}
// Event_ID, Event_Grade, Event_Date, Start_Time, End_Time
if (isset($_POST["Event_ID"]) and isset($_POST["Event_Grade"]) and isset($_POST["Event_Date"]) and isset($_POST["Start_Time"]) and isset($_POST["End_Time"])) {
    //
} else {
    header("Location: eventSetup.php");
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="form.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
    </div>
    <h1></h1>
    <?php if ($authenticated) {echo "hello";}?>
</body>
</html>