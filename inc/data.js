var totalRequired = 0;

function SetStatusChanged( status ) 
{
    document.getElementById("loadStatus").innerText = status;
    if (status.toLowerCase().includes("complete") || status.toLowerCase().includes("client") || status.toLowerCase().includes("started"))
    {
        document.getElementById("file").innerText = "Workshop Finished...";
        document.getElementById("finishedBar").style.width = `100%`;
    }
}

function SetFilesTotal( total ) 
{
    totalRequired = total;
}

function SetFilesNeeded( needed ) 
{
    document.getElementById("finishedBar").style.width = `${((totalRequired - needed) / totalRequired) * 100}%`;
}  