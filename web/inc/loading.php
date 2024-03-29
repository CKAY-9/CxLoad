<?php 

    require("./config.php");

    if ($api_key === "") 
    {
        echo "<h1 style='margin: 0; padding: 0; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);'>The website admin forgot to put their Steam API key!</h1>";
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
    $players = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/players.json"), true);

    if (!isset($players[$steam_id]))
    {
        $players += [$steam_id => [
            "lastJoin" => floor(microtime(true) * 1000)
        ]];
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/players.json", json_encode($players));
    }
?>

<head>
    <?php 
        if (!isset($_GET["steam_id"]) && !isset($_GET["web"]))
        {
            echo "<style>* { background: #222; display: none; }</style>";
        }
        else 
        {
            echo "<link rel=\"stylesheet\" href=\"./inc/styles/loading/" . $display["loading_style"] . ".css\">";
        }
    ?>
</head>

<body>
    <div class="loading">
        <div id="bg-1" class="bg"></div>
        <div id="bg-2" class="bg"></div>

        <div class="content">
            <section id="userInfo" class="flex-col align side" <?php if (!$display["player_info"]) { echo "style='display: none'"; } ?> >
                <h1 id="info-header">Your Info</h1>
                <div class="flex-col gap-20 justify align">
                    <div class="flex-col gap-10 align">
                        <img src=<?php echo $data["response"]["players"][0]["avatarfull"] ?> alt="userIcon" class="userIcon" id="userIcon">
                        <div class="name" id="displayName"><?php echo $data["response"]["players"][0]["personaname"] ?></div>
                    </div>
                    <div class="lastJoin" id="lastJoin"></div>
                    <?php if (isset($players[$steam_id]["money"]) && $display["gamemode_features"]) { ?>
                        <div class="darkRPMoney" id="darkRPMoney">DarkRP Cash: $<?php echo $players[$steam_id]["money"] ?></div>
                    <?php } ?>
                    <div class="steamID" id="steamID">Steam ID: <?php echo $steam_id ?></div>
                </div>
            </section>
            <section id="mainInfo" class="flex-col align" <?php if (!$display["main_info"]) { echo "style='display: none'"; } ?> style="flex: 1; min-width: 30vw;">
                <h1 id="serverName"><?php echo $settings["server_name"] ?></h1>
                <span id="serverDesc"><?php echo $settings["server_desc"] ?></span>

                <div class="flex-col align justify" style="min-width: 30vw;">
                    <div class="flex-row gap-30" style="margin-top: 20px;">
                        <div class="flex-col gap-10 align" <?php if ($settings["server_site"] === "") { echo "style=\"display: none;\""; } ?> >
                            <img src="./resources/loading/website.svg" alt="website">
                            <div class="website" id="website"><?php echo $settings["server_site"] ?></div>
                        </div>
                        <div class="flex-col gap-10 align" <?php if ($settings["server_donation"] === "") { echo "style=\"display: none;\""; } ?>>
                            <img src="./resources/loading/store.svg" alt="store">
                            <div class="website" id="store"><?php echo $settings["server_donation"] ?></div>
                        </div>
                    </div>

                    <div class="flex-col justify align" <?php if (!$display["loading_bar"]) { echo "style=\"display: none;\""; } ?> style="width: 100%; height: 1vh;" >
                        <div id="loadStatus" style="margin-top: 2vh; text-align: center">Retrieving server info...</div>
                        <div class="loadingBar" id="loadingBar">
                            <div class="file" id="file">Workshop downloading...</div>
                            <div class="finishedBar" id="finishedBar"></div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="serverInfo" class="side flex-col align" <?php if (!$display["server_info"]) { echo "style='display: none'"; } ?>>
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
                    
                    <?php if ($display["gamemode_features"]) { ?>
                        <div class="flex-row gap-10 align">
                            <img src="./resources/loading/game.svg" alt="gamemode">
                            <div class="maxPlayers" id="maxPlayers">Gamemode: <?php echo $gamemode ?></div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </div>
    </div>

    <script src="../vendor/jQuery/jquery.js"></script>
    <script>
        <?php echo "$(\"#lastJoin\").text(\"Last joined: \" + new Date(" . $players[$steam_id]["lastJoin"] . ").toLocaleDateString())"; ?>

        var imageIndex = 1;
        
        var imagesArray = <?php $out = array();
        foreach (glob('./resources/backgrounds/*') as $filename) {
            $p = pathinfo($filename);
            $out[] = $p['filename'] . "." . pathinfo($filename, PATHINFO_EXTENSION);
        }
        echo json_encode($out); ?>;

        function changeBackground(){
            if (imagesArray.length <= 1) return;
            $("#bg-1").fadeOut(1500)
            setTimeout(() => {
                var index = imageIndex++ % imagesArray.length;
                $("#bg-1").css("background","url('resources/backgrounds/"+ imagesArray[index] +"')");
                $("#bg-1").fadeIn(1500);
            }, 1500);
        }

        <?php
            if ($display["background"]) 
            {
                echo "setInterval(changeBackground, 10000); document.getElementById(\"bg-1\").style.backgroundImage = \"url('resources/backgrounds/\"+ imagesArray[0] +\"')\";  "; 
            } 
            $players[$steam_id]["lastJoin"] = floor(microtime(true) * 1000);
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/players.json", json_encode($players));
        ?>
    </script>
</body>