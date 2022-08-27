<?php 

    require("./config.php");

    if ($api_key === "") 
    {
        echo "<h1 style='margin: 0; padding: 0; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);'>Ok, so... The website admin forgot to put their Steam API key!</h1>";
        die();
    }

    $steam_id = "";
    $gamemode = "";

    if (isset($_GET["steam_id"]))
    {
        $steam_id = $_GET["steam_id"];
        $gamemode = $_GET["gamemode"];
        $link = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $api_key . "&steamids=" . $steam_id . "&format=json");
        $data = json_decode($link, true);
    }
    else
    {
        $steam_id = "76561198078073563";
        $gamemode = "sandbox";
        $link = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $api_key . "&steamids=76561198078073563&format=json");
        $data = json_decode($link, true);
    }

    $settings = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/settings.json"), true);
    $display = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json"), true);
?>

<head>
    <?php 
        if (!isset($_GET["steam_id"]) && !isset($_GET["web"]))
        {
            echo "<style>* { background: #222; display: none; }</style>";
        }
    ?>
</head>

<body>
    <div class="loading">
        <div id="bg-1" class="bg"></div>
        <div id="bg-2" class="bg"></div>

        <div class="content">
            <section class="flex-col align side" <?php if (!$display["player_info"]) { echo "style='display: none'"; } ?> >
                <h1 id="info-header">Your Info</h1>
                <div class="flex-col gap-20 justify align">
                    <div class="flex-row gap-10 align">
                        <img src=<?php echo $data["response"]["players"][0]["avatarfull"] ?> alt="userIcon" class="userIcon" id="userIcon">
                        <div class="name" id="displayName"><?php echo $data["response"]["players"][0]["personaname"] ?></div>
                    </div>
                    <div class="steamID" id="steamID">Steam ID: <?php echo $steam_id ?></div>
                </div>
            </section>
            <section class="flex-col align" <?php if (!$display["main_info"]) { echo "style='display: none'"; } ?> style="flex: 1; min-width: 30vw;">
                <h1 id="serverName"><?php echo $settings["server_name"] ?></h1>
                <span id="serverDesc"><?php echo $settings["server_desc"] ?></span>

                <div class="flex-col align justify" style=" min-width: 30vw;">
                    <div class="flex-row gap-30" style="margin-top: 20px;">
                        <div class="flex-col gap-10 align">
                            <img src="./resources/loading/website.svg" alt="website">
                            <div class="website" id="website"><?php echo $settings["server_site"] ?></div>
                        </div>
                        <div class="flex-col gap-10 align">
                            <img src="./resources/loading/store.svg" alt="store">
                            <div class="website" id="store"><?php echo $settings["server_donation"] ?></div>
                        </div>
                    </div>

                    <div id="loadStatus" style="margin-top: 2vh;">Retrieving server info...</div>
                    <div class="loadingBar" id="loadingBar">
                        <div class="file" id="file">Workshop downloading...</div>
                        <div class="finishedBar" id="finishedBar"></div>
                    </div>
                </div>
            </section>
            <section class="side flex-col align" <?php if (!$display["server_info"]) { echo "style='display: none'"; } ?>>
                <h1>Server Info</h1>
                <div class="flex-col gap-30" style="margin-top: 20px;">
                    <div class="flex-row gap-10 align">
                        <img src="./resources/loading/server.svg" alt="address">
                        <div class="mapname" id="mapName">IP: <?php
                         
                         if (isset($data["response"]["players"][0]["gameserverip"]))
                         {
                            echo $data["response"]["players"][0]["gameserverip"];
                         }
                         else
                         {
                            echo "127.0.0.1";
                         }

                         ?></div>
                    </div>
                    <div class="flex-row gap-10 align">
                        <img src="./resources/loading/map.svg" alt="map">
                        <div class="mapname" id="mapName">Map: <?php echo $_GET["map"] ?></div>
                    </div>
                    <div class="flex-row gap-10 align">
                        <img src="./resources/loading/max.svg" alt="maxPlayers">
                        <div class="maxPlayers" id="maxPlayers">Max players: <?php echo $_GET["maxPlayers"] ?></div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="../vendor/jQuery/jquery.js"></script>
    <script>
        var imageIndex = 1;
        var imagesArray = [
            "resources/custom/bg1.jpg",
            "resources/custom/bg2.jpg",
            "resources/custom/bg3.jpg"
        ];

        function changeBackground(){
            $("#bg-1").fadeOut(1500)
            setTimeout(() => {
                var index = imageIndex++ % imagesArray.length;
                $("#bg-1").css("background","url('"+ imagesArray[index] +"')");
                $("#bg-1").fadeIn(1500);
            }, 1500);
        }

        <?php if ($display["background"]) { echo "setInterval(changeBackground, 10000); document.getElementById(\"bg-1\").style.backgroundImage = \"url('\"+ imagesArray[0] +\"')\";  "; } ?>
    </script>
</body>