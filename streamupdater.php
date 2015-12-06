<?php
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $con = mysqli_connect($url["host"], $url["user"], $url["pass"], substr($url["path"], 1));
if (mysqli_connect_errno())
  {
  echo "Failed to connect to database";
  }

$query = "SELECT * FROM Streams";

if ($result = mysqli_query($con, $query)) {

  while($row = mysqli_fetch_assoc($result)) {
    $channelName = $row['streamname'];
    $json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName).'?client_id='.$clientId), true);

    if ($json_array['stream'] != NULL) {
        $channelTitle = $json_array['stream']['channel']['display_name'];
        $streamTitle = $json_array['stream']['channel']['status'];
        $currentGame = $json_array['stream']['channel']['game'];

        mysqli_query($con,"UPDATE Streams SET Online=1 WHERE streamname='$channelName'");
    } else {
        mysqli_query($con,"UPDATE Streams SET Online=0 WHERE streamname='$channelName'");
    }
  }
}

?>
