<?php 

    session_start();
    $_SESSION["verified"] = FALSE;

?>

<head>
    <link rel="stylesheet" href="./styles/style.css">
    <title>IceLoad | Home</title>
</head>

<div class="container">
    <h1>IceLoad <span class="small-text">Developed by CND Ice</span></h1>
    
    <div class="flex-row gap-30">
        <a class="button" href="/edit.php">Config</a>
        <a class="button" href="/load.php?web=true&maxPlayers=20&map=gm_sandbox&addr=127.0.0.1">Loading Screen</a>
    </div>
</div>