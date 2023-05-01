<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Location: /");
        die();
    }

    $steamid = $_POST["steamid"];
    $money = intval($_POST["money"]);

    $players = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/players.json"), true);
    if (!isset($players[$steamid])) {
        return "Failed to get user from Steam ID";
    }
    $player = $players[$steamid];
    $player["money"] = $money;
    $players[$steamid] = $player;

    file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/players.json", json_encode($players));

    return "success";
?>