<?php 

    // Setup default values
    function setupDefaultJSONValues() 
    {
        $display = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json"), true);  

        if ($display == null || count($display) <= 0) 
        {
            $display = array();
        }

        if (!isset($display["server_info"]))
        {
            $display += ["server_info" => true];
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
        }
        if (!isset($display["main_info"]))
        {
            $display += ["main_info" => true];
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
        }   
        if (!isset($display["player_info"]))
        {
            $display += ["player_info" => true];
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
        }
        if (!isset($display["background"]))
        {
            $display += ["background" => true];
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
        }
        if (!isset($display["gamemode_features"]))
        {
            $display += ["gamemode_features" => true];
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
        }
        if (!isset($display["loading_bar"]))
        {
            $display += ["loading_bar" => true];
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
        }
        if (!isset($display["loading_style"]))
        {
            $display += ["loading_style" => "default"];
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
        }

        $settings = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/settings.json"), true);

        if ($settings == null || count($settings) <= 0) 
        {
            $json = "{\"server_name\": \"" . "Garry's Mod" . 
                "\", \"server_desc\": \"" . "We love our community" . 
                "\", \"server_site\": \"" . "garrys.mod" . 
                "\", \"server_donation\": \"" . "garrys.mod/store" .  
                "\"}";
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/settings.json", $json);
        }

        $players = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/players.json"), true);

        if ($players == null || count($players) <= 0) 
        {
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/players.json", "{}");
        }
    }   

?>