# CxLoad

# Usage
## Web
1. Download web into your php webserver into a folder called `CxLoad`
2. Edit `config.php` and put your Steam API key and allowed SteamIDs (64)
3. Go to `/CxLoad` on your webserver
4. Login and edit the loading screen

## Game
1. Put `cxloadaddon` into `garrysmod/addons`
2. Edit `cxload_config.lua`
3. Set `sv_loadingurl` to your webserver `/CxLoad/load.php`


# Changelog

## Version 1.3 - Gamemode Support (30/4/23)
- Added another loading style
    - Simple Player: only shows player information
- DarkRP Support
    - Lua addon which allows for communication with CxLoad
    - Sends player's DarkRP money upon spawn (Doesn't show up on FIRST join)
- Gamemode Support
    - New config option to toggle gamemode display and features

</br>

## Version 1.2 - Make It Better (28/3/23)
- Style Changes
- Automatic background detecting

</br>

## Version 1.1 (3/12/22)
- Added style selecting
- Fixed spelling/grammar is some places
- Made code more readable
- Changed folder structure
- Changed default loading style
- Added default value checking for settings (seen in `./inc/utils.php`)
- Changed License to AGPL-3.0

</br>

## Version 1.0 (25/8/22)
- Initial Release

</br>
