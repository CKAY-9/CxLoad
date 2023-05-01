<?php 

    session_start();
    $_SESSION["verified"] = FALSE;

    require("inc/utils.php");
    setupDefaultJSONValues();

?>

<head>
    <link rel="stylesheet" href="./inc/styles/style.css">
    <title>CxLoad | Home</title>
</head>

<div class="container flex-col align">
    <h1>CxLoad</h1>
    <span class="small-text">Developed by <a href="https://github.com/Camerxxn" target="_blank">Camerxn</a></span>
    
    <div style="margin-top: 5vh" class="flex-row gap-30">
        <a class="button" href="/edit.php">Config</a>
        <a class="button" href="/load.php?web=true&maxPlayers=20&map=gm_sandbox&addr=127.0.0.1&gamemode=sandbox">Loading Screen</a>
    </div>
</div>
