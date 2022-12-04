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

<div class="container">
    <h1>CxLoad <span class="small-text">Developed by <a href="https://github.com/Camerxxn" target="_blank">Camerxn</a></span></h1>
    
    <div class="flex-row gap-30">
        <a class="button" href="/edit.php">Config</a>
        <a class="button" href="/load.php?web=true&maxPlayers=20&map=gm_sandbox&addr=127.0.0.1">Loading Screen</a>
    </div>
</div>