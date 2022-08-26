function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode, volume, language ) 
{
    var params = `?steam_id=${steamid}&gamemode=${gamemode}&map=${mapname}&maxPlayers=${maxplayers}`;
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + params;
    window.location.href = newurl;
}

