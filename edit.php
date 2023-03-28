<?php 

    require("./vendor/steamauth/steamauth/steamauth.php");

    if (!$_SESSION["verified"]) 
    {
        header('Location: /verify.php');
    }

    require("inc/utils.php");
    setupDefaultJSONValues();

    $display = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json"), true);
    $settings = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/settings.json"), true);
?>

<head>
    <title>CxLoad | Config</title>
    <link rel="stylesheet" href="./inc/styles/style.css">
</head>

<div class="container">
    <div class="flex-col align">
        <h1 style="margin-bottom: 2vh">Edit CxLoad</h1>

        <div class="flex-row gap-10">
            <a href="/"><button>Back</button></a>
            <?php logoutbutton() ?>
        </div>

        <ul>
            <li>Leave an input blank if you don't want it visible</li>
            <li>Loading screen updates may take a moment to apply after submission</li>
        </ul>
    </div>
    
    <div class="seperator"></div>

    <div class="sections">
        <form action="update.php" class="flex-col gap-20 align" method="post">
            <h2>General Information</h2>
            <a href="/update.php?disabled=main" class="button" style="max-width: fit-content">
            <?php if ($display["main_info"]) { echo "Disable"; } else { echo "Enable"; } ?>
            </a>
            <div class="flex-col gap-10 align" style="<?php if (!$display["main_info"]) { echo "opacity: 0.5; pointer-events: none;"; } ?>">
                <div class="flex-col gap-10 align">
                    <label>Server Name</label>
                    <input value="<?php echo $settings["server_name"] ?>" type="text" name="server_name">
                </div>
                <div class="flex-col gap-10 align">
                    <label>Short Description</label>
                    <input value="<?php echo $settings["server_desc"] ?>" type="text" name="server_desc">
                </div>
                <div class="flex-col gap-10 align">
                    <label>Server Website</label>
                    <input value="<?php echo $settings["server_site"] ?>" type="text" name="server_site">
                </div>
                <div class="flex-col gap-10 align">
                    <label>Donation Page</label>
                    <input value="<?php echo $settings["server_donation"] ?>" type="text" name="server_donation">
                </div>
                <div style="margin: 0.5vh"></div>
                <button type="submit">Update</button>
            </div>
        </form>

        <div class="flex-col gap-30 align">
            <h2>Look / Feel</h2>
            <div class="flex-row align gap-40">
                <label>Player Info</label>
                <a href="/update.php?disabled=player" class="button">
                    <?php if ($display["player_info"]) { echo "Disable"; } else { echo "Enable"; } ?>
                </a>
            </div>
            <div class="flex-row align gap-40">
                <label>Server Info</label> 
                <a href="/update.php?disabled=server" class="button">
                    <?php if ($display["server_info"]) { echo "Disable"; } else { echo "Enable"; } ?>
                </a>
            </div>
            <div class="flex-col gap-10 align">
                <div class="flex-row align gap-40">
                    <label>Backgrounds</label> 
                    <a href="/update.php?disabled=background" class="button">
                        <?php 
                            if ($display["background"]) { echo "Disable"; } else {
                                echo "Enable"; 
                            } 
                        ?>
                    </a>
                </div>
                (Found in ./resources/backgrounds)    
            </div>
            <div class="flex-row align gap-40">
                <label>Loading Bar</label> 
                <a href="/update.php?disabled=loading" class="button">
                    <?php 
                        if ($display["loading_bar"]) { echo "Disable"; } else {
                            echo "Enable"; 
                        } 
                    ?>
                </a>
            </div>
            <div class="flex-col gap-10 align">
                <div class="flex-row align gap-40">
                    <label>Style</label>
                    <select name="style" id="styleSelector">
                        <option value="default" <?php if ($display["loading_style"] == "default") { echo "selected"; } ?> >Default</option>
                        <option value="simple" <?php if ($display["loading_style"] == "simple") { echo "selected"; } ?>>Simple</option>
                    </select>
                </div>
                <span>(Some styles may ignore preferences above)</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("styleSelector").onchange = (e) => 
    {
        window.location.href = "/update.php?loading_style=" + e.target.value;
    }
</script>