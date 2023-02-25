<?php
session_start();
if (isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])) {
    if ($_SESSION["authenticated"] == true) {
        $authenticated = true;
        $userData = $_SESSION["userData"];
    } else {
        $myfile = fopen("pswrds.json", "r") or die("Unable to open file!");
        $jsonFileString = fread($myfile, filesize("pswrds.json"));
        fclose($myfile);
        $jsonData = json_decode($jsonFileString, true);
        if (array_key_exists($_POST["uname"], $jsonData) and $jsonData[$_POST["uname"]]["pswd"] === $_POST["psw"]) {
            $_SESSION["authenticated"] = true;
            $_SESSION["userData"] = $jsonData[$_POST["uname"]];
            $authenticated = true;
            $userData = $jsonData[$_POST["uname"]];
        } else {
            header("Location: login.php");
            die();
        }
            }
} else {
    $myfile = fopen("pswrds.json", "r") or die("Unable to open file!");
    $jsonFileString = fread($myfile, filesize("pswrds.json"));
    fclose($myfile);
    $jsonData = json_decode($jsonFileString, true);
    if (array_key_exists($_POST["uname"], $jsonData) and $jsonData[$_POST["uname"]]["pswd"] === $_POST["psw"]) {
        $_SESSION["authenticated"] = true;
        $_SESSION["userData"] = $jsonData[$_POST["uname"]];
        $authenticated = true;
        $userData = $jsonData[$_POST["uname"]];
    } else {
        header("Location: login.php");
        die();
    }}
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
    <h1>Welcome, <?php if ($authenticated) {if ($userData["role"] === 0){echo "Host";}if ($userData["role"] === 1){echo "Site Manager";}if ($userData["role"] === 2){echo "Site Technician";}if ($userData["role"] === 3){echo "Event Manager";}if ($userData["role"] === 4){echo "Event Technician";}if ($userData["role"] === 5){echo "Event Judge";}if ($userData["role"] === 6){echo "Team Leader";}}?> <?php if ($authenticated) {echo $userData["first_name"];}?></h1>
    <div class="verticalNav">
        <?php if ($authenticated) {if ($userData["role"] < 2){echo '<a href="accountManagment.php">Account Management</a>';}}?>
        <?php if ($authenticated) {if ($userData["role"] < 3){echo '<a href="eventSetup.php">Event Setup</a>';}}?>
        <?php if ($authenticated) {if ($userData["role"] < 4){echo '<a href="eventManager.php">Event Manager</a>';}}?>
        <?php if ($authenticated) {if ($userData["role"] < 5){echo '<a href="scoreManager.php">Score Manager</a>';}}?>
        <?php if ($authenticated) {if ($userData["role"] < 6){echo '<a href="scoreInput.php">Score Input</a>';}}?>
        <a href="accountDetails.php">My Account Details</a>
    </div>
</body>
</html>