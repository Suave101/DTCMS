<?php
date_default_timezone_set("America/Chicago");
session_start();
$myfile = fopen("scores.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("scores.json"));
fclose($myfile);
$jsonData = json_decode($jsonFileString, true);
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
    if (strtotime(join(array($_POST["Event_Date"], " ", $_POST["Start_Time"]))) < strtotime(join(array($_POST["Event_Date"], " ", $_POST["End_Time"])))) {
        if (array_key_exists(join(array($_POST["Event_Grade"], "#", $_POST["Event_ID"])), $jsonData)) {
            header("Location: eventSetup.php?invalid=2");
            die();
        } else {
            $jsonData[join(array($_POST["Event_Grade"], "#", $_POST["Event_ID"]))] = array("Grade"=>$_POST["Event_Grade"], "teamScores"=>false, "pointValuesAndTollerances"=>false, "startTime"=>strtotime(join(array($_POST["Event_Date"], " ", $_POST["Start_Time"]))), "endTime"=>strtotime(join(array($_POST["Event_Date"], " ", $_POST["End_Time"]))));
            $myfile = fopen("scores.json", "w") or die("Unable to open file!");
            fwrite($myfile, json_encode($jsonData));
            fclose($myfile);
            $successful = true;
        }
    } else {
        header("Location: eventSetup.php?invalid=1");
        die();
    }
} else {
    header("Location: eventSetup.php?invalid=0");
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
    <h1><?php if ($authenticated and isset($successful)) {echo "Event Created Successfully";}?></h1>
    <p>Timestamp(Day-Month-Year - Hour:Minute:Second (Ante meridiem or Post meridiem)): <?php if ($authenticated and isset($successful)) {echo date("m/d/Y - h:i:s A");}?></p>
</body>
</html>