<?php 

    require("./vendor/steamauth/steamauth/steamauth.php");

    if (!$_SESSION["verified"]) 
    {
        header('Location: /verify.php');
    }

    $display = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json"), true);
?>

<head>
    <title>IceLoad | Config</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<div class="container">
    <div class="flex-row gap-50 align">
        <h1>IceLoad | Edit</h1>
        <a class="button" href="/">Back</a>
    </div>

    <?php logoutbutton() ?>

    <ul>
        <li>Leave an input blank if you don't want it visible</li>
        <li>Loading screen updates may take a moment to apply after submition</li>
    </ul>
    
    <div class="seperator"></div>

    <form action="update.php" class="flex-col gap-20" method="post">
    <div class="flex-row align gap-40"><h2>General Information</h2> <a href="/update.php?disabled=main" class="button">
    <?php if ($display["main_info"]) { echo "Disable"; } else { echo "Enable"; } ?>
    </a></div>
        <div class="flex-row gap-10 align">
            <label>Server Name: </label>
            <input type="text" name="server_name">
        </div>
        <div class="flex-row gap-10 align">
            <label>Short Description: </label>
            <input type="text" name="server_desc">
        </div>
        <div class="flex-row gap-10 align">
            <label>Server Website: </label>
            <input type="text" name="server_site">
        </div>
        <div class="flex-row gap-10 align">
            <label>Donation Page: </label>
            <input type="text" name="server_donation">
        </div>

        <button type="submit">Update</button>
    </form>

    <div class="seperator"></div>

    <form action="">
        <h2>Look / Feel</h2>

        <div class="flex-row align gap-40"><h2>Player Info</h2> <a href="/update.php?disabled=player" class="button">
        <?php if ($display["player_info"]) { echo "Disable"; } else { echo "Enable"; } ?>
        </a></div>
        <div class="flex-row align gap-40"><h2>Server Info</h2> <a href="/update.php?disabled=server" class="button">
            <?php if ($display["server_info"]) { echo "Disable"; } else { echo "Enable"; } ?>
        </a></div>
        <div class="flex-row align gap-40"><h2>Backgrounds</h2> <a href="/update.php?disabled=background" class="button">
        <?php 
            if ($display["background"]) { echo "Disable"; } else {
                echo "Enable"; 
            } 
        ?>
        </a>
        (Found in ./resources/custom, files must be .jpg and named bg1-3)    
        </div>
        <div class="flex-row align gap-40"><h2>Loading Bar</h2> <a href="/update.php?disabled=loading" class="button">
        <?php 
            if ($display["loadingBar"]) { echo "Disable"; } else {
                echo "Enable"; 
            } 
        ?>
        </a>
    </form>
</div>