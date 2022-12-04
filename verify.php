<?php
    require("./vendor/steamauth/steamauth/steamauth.php");
    include("./config.php");
?>

<head>
    <link rel="stylesheet" href="./inc/styles/style.css">
    <title>CxLoad | Verification</title>
</head>

<div class="container flex-col align justify">
    <h1>Verify Your Identity</h1>

    <?php

        if (count($allowed_users) <= 0)
        {
            echo "<h2>Website admin hasn't set allowed users...</h2>";
        }

        if (!isset($_SESSION['steamid']) && count($allowed_users) >= 1) 
        {
            loginbutton();
        }
        if (isset($_SESSION['steamid']) && count($allowed_users) >= 1)
        { 
            include("./vendor/steamauth/steamauth/userInfo.php");

            foreach ($allowed_users as $allowed)
            {
                if ($allowed == $steamprofile['steamid'])
                {
                    $_SESSION["verified"] = TRUE;
                    header("Location: /edit.php");
                }
            }
        }
    ?>
</div>