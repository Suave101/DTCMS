<?php 
// Get Auth
date_default_timezone_set("America/Chicago");session_start();if(isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])){if($_SESSION["authenticated"]==true and $_SESSION["userData"]["role"]<2){$authenticated=true;}else{header("Location: login.php");die();}}else{header("Location: login.php");die();}
// Get POST Data
// role, first_name, last_name, pswd, username
$myfile = fopen("pswrds.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("pswrds.json"));
fclose($myfile);
$jsonData = json_decode($jsonFileString, true);
if (isset($_POST["username"])) {
    if ($_SESSION["userData"]["role"] > 0 and $jsonData[$_POST["username"]]["role"] === 0) {
        session_destroy();
        header("Location: login.php");
        die();
    } else {
        if (isset($_POST["first_name"]) and isset($_POST["role"]) and isset($_POST["last_name"])) {
            $jsonData[$_POST["username"]]["first_name"] = $_POST["first_name"];
            $jsonData[$_POST["username"]]["role"] = (int) $_POST["role"];
            $jsonData[$_POST["username"]]["last_name"] = $_POST["last_name"];
            if (isset($_POST["pswd"])) {
                if (strlen($_POST["pswd"]) > 5) {
                    $jsonData[$_POST["username"]]["pswd"] = $_POST["pswd"];
                    $alertMessage = 'Successful Password Change';
                } else {
                    if (strlen($_POST["pswd"] > 0)) {
                        $alertMessage = 'Password Not Changed: Too Short';
                    } else {
                        $alertMessage = 'Successful Data Change';
                    }
                }
            }
        }
    }
} else {
    // new_username, pswd, first_name, last_name, role
    if (isset($_POST["new_username"])) {
        if (isset($_POST["pswd"]) and isset($_POST["first_name"]) and isset($_POST["role"]) and isset($_POST["last_name"]) and (array_key_exists($_POST["new_username"], $jsonData)) === false) {
            if ((int) $_POST["role"] < 1) {session_destroy();header("Location: login.php");die();}
            $jsonData[$_POST["new_username"]]["first_name"] = $_POST["first_name"];
            $jsonData[$_POST["new_username"]]["role"] = (int) $_POST["role"];
            $jsonData[$_POST["new_username"]]["last_name"] = $_POST["last_name"];
            $jsonData[$_POST["new_username"]]["pswd"] = $_POST["pswd"];
        } else {
            header("Location: elevatedCreateAccount.php");
            die();
        }
    } else {
        if (isset($_POST["first_name"]) or isset($_POST["role"]) or isset($_POST["last_name"]) or isset($_POST["pswd"])) {
            $alertMessage = 'ERROR: Contact Web Host';
        }
    }
}
$myfile = fopen("pswrds.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($jsonData));
fclose($myfile)
?>
<!DOCTYPE html>
<head>
    <title>DTC - Scoring System</title>
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>.alert {padding: 20px;background-color: #f44336;color: white;margin-bottom: 15px;opacity: 1;transition: opacity 0.6s;}.closebtn {margin-left: 15px;color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;}.closebtn:hover {color: black;}</style></head>
<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a></div>
        <?php if(isset($alertMessage)) {echo join(array('<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=', "'none'", ';">&times;</span>', $alertMessage, '</div>'));} ?>
        <div class="verticalNav">
        <?php 
        foreach(array_keys($jsonData) as $account) {
            $userData = $jsonData[$account];
            if ($authenticated) {if ($userData["role"] === 0){$role = "Host";}if ($userData["role"] === 1){$role = "Site Manager";}if ($userData["role"] === 2){$role ="Site Technician";}if ($userData["role"] === 3){$role ="Event Manager";}if ($userData["role"] === 4){$role ="Event Technician";}if ($userData["role"] === 5){$role ="Event Judge";}if ($userData["role"] === 6){$role ="Team Leader";}}
            $showProfile = false;
            if ($_SESSION["userData"]["role"] > 0 and $role !== "Host") {$showProfile = true;}
            if ($_SESSION["userData"]["role"] === 0) {$showProfile = true;}
            if ($showProfile) {
                echo '<form action="accountManagment.php" class="account" method="post"><input name="username" type="hidden" value="';
                echo $account;
                echo '"><h2>';
                echo $account;
                echo '</h2><p>Role:<select name="role"><option value="';
                echo $userData["role"];
                echo '">';
                echo $role;
                echo '</option>';
                if ($userData["role"] === 1) {echo '<option value="2">Site Technician</option><option value="3">Event Manager</option><option value="4">Event Technician</option><option value="5">Event Judge</option><option value="6">Team Leader</option>';}
                if ($userData["role"] === 2) {echo '<option value="1">Site Manager</option><option value="3">Event Manager</option><option value="4">Event Technician</option><option value="5">Event Judge</option><option value="6">Team Leader</option>';}
                if ($userData["role"] === 3) {echo '<option value="1">Site Manager</option><option value="2">Site Technician</option><option value="4">Event Technician</option><option value="5">Event Judge</option><option value="6">Team Leader</option>';}
                if ($userData["role"] === 4) {echo '<option value="1">Site Manager</option><option value="2">Site Technician</option><option value="3">Event Manager</option><option value="5">Event Judge</option><option value="6">Team Leader</option>';}
                if ($userData["role"] === 5) {echo '<option value="1">Site Manager</option><option value="2">Site Technician</option><option value="3">Event Manager</option><option value="4">Event Technician</option><option value="6">Team Leader</option>';}
                if ($userData["role"] === 6) {echo '<option value="1">Site Manager</option><option value="2">Site Technician</option><option value="3">Event Manager</option><option value="4">Event Technician</option><option value="5">Event Judge</option>';}
                echo '</select></p><p>First Name: <input name="first_name" type="text" value="';
                echo $userData["first_name"];
                echo '"></p><p>Last Name: <input name="last_name" type="text" value="';
                echo $userData["last_name"];
                echo '"></p><p>New Password (Longer than 5 Charcters): <input name="pswd" type="password"></p><input class="accountSubmitButton" type="submit" value="Submit Changes"></form>';
            }
        }?>
        <a href="elevatedCreateAccount.php" class="account" style="text-align: center;">Create New Account</a>
        </div>
</body>
</html>
