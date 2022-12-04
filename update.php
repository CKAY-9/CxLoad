<?php 

    session_start();

    // User must be verified to update loading screen
    if (!$_SESSION["verified"])
    {
        headers("Location: /");
        die();
    }

    require("inc/utils.php");
    setupDefaultJSONValues();

    // Ensure that no get requests are processed
    if ($_SERVER["REQUEST_METHOD"] === "GET")
    {
        $disable = explode("=", $_SERVER["QUERY_STRING"])[1];
        $display = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json"), true);

        switch ($disable) 
        {
            case "server":
                $display["server_info"] = !$display["server_info"];
                break;
            case "main":
                $display["main_info"] = !$display["main_info"];
                break;
            case "player":
                $display["player_info"] = !$display["player_info"];
                break;
            case "background":
                $display["background"] = !$display["background"];
                break;
            case "loading":
                $display["loading_bar"] = !$display["loading_bar"];
                break;
            default:
                break;
        }

        if (isset($_GET["loading_style"])) 
        {
            $display["loading_style"] = htmlspecialchars($_GET["loading_style"]); 
        }

        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/data/visuals.json", json_encode($display));
    }
    else
    {
        $json = "{\"server_name\": \"" . $_POST["server_name"] . 
            "\", \"server_desc\": \"" . $_POST["server_desc"] . 
            "\", \"server_site\": \"" . $_POST["server_site"] . 
            "\", \"server_donation\": \"" . $_POST["server_donation"] .  
            "\"}";
        file_put_contents("./data/settings.json", $json);
    }

    echo "<script text=\"javascript\">window.location.href = \"/edit.php\"</script>"

?>