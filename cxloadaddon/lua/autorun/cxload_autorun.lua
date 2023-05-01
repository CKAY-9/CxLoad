if SERVER then
    include("config.lua")

    hook.Add("PlayerChangedTeam", "PlayerChange", function(ply, old, new)
        if type(ply:isArrested()) ~= nil then
            -- Gamemode is DarkRP derived
            http.Post(CXLOAD.url .. "/game/updatePlayer.php", {
                steamid = ply:SteamID64(),
                money = tostring(ply:getDarkRPVar("money"))
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