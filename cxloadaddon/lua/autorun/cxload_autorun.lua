if SERVER then
    include("cxload_config.lua")

    hook.Add("PlayerChangedTeam", "PlayerChange", function(ply, old, new)
        if ply:isArrested() == nil then
            -- Gamemode is DarkRP derived
            http.Post(CXLOAD.url .. "/game/updatePlayer.php", {
                steamid = ply:SteamID64(),
                money = tostring(ply:getDarkRPVar("money")),
            }, function()
                if CXLOAD.logs then
                    print("Updated " .. ply:GetName() .. " information on webhost")
                end
            end, function(message)
                if CXLOAD.logs then
                    print("Failed to update on webhost: " .. message)
                end
            end)
        else
            -- Gamemode is not DarkRP derived
            http.Post(CXLOAD.url .. "/game/updatePlayer.php", {
                steamid = ply:SteamID64(),
                removeMoney = true,
            }, function()
                if CXLOAD.logs then
                    print("Updated " .. ply:GetName() .. " information on webhost")
                end
            end, function(message)
                if CXLOAD.logs then
                    print("Failed to update on webhost: " .. message)
                end
            end)
        end
    end)
end