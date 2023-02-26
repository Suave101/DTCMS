<?php 
// Get Auth
session_start();if(isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])){if($_SESSION["authenticated"]==true and $_SESSION["userData"]["role"]<2){$authenticated=true;}else{header("Location: login.php");die();}}else{header("Location: login.php");die();}
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
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
    </div>
        <div class="verticalNav">
            <form action="accountManagment.php" class='account' method="post">
                <h2>Account Creation</h2>
                <p>Username: <input name="new_username" type="text"></p>
                <p>Password: <input name="pswd" type="password"></p>
                <p>First Name: <input name="first_name" type="text" value="#"></p>
                <p>Last Name: <input name="last_name" type="text" value="#"></p>
                <p>Role: 
                    <select name="role">
                        <option value="1">Site Manager</option>
                        <option value="2">Site Technician</option>
                        <option value="3">Event Manager</option>
                        <option value="4">Event Technician</option>
                        <option value="5">Event Judge</option>
                        <option value="6">Team Leader</option>
                    </select>
                </p>
                <input class="accountSubmitButton" type="submit" value="Submit Changes">
            </form>
        </div>
</body>
</html>
