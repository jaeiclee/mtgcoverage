	<?php include 'header.php'; ?>   
   <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <?php if ($SD == '0' OR $SD == '') { echo '<a href ="index.php?SD=0"><img src="logo-sq.png" height="50px" width="50px"></a>'; } else { echo '<a href="index.php?SD=1"><img src="logo-sq.png" height="50px" width="50px"></a>'; } ?>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><?php if ($SD == '0' OR $SD == '') { echo '<a href ="index.php?SD=0">Home</a>'; } else { echo '<a href="index.php?SD=1">Home</a>';  } ?></li>
              <li><a href="#">Calendar</a></li>
              <li class="active"><a href="search.php">Search</a></li>
			  <li class="active">
								<?php 	if ($formattype != '') {
								if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype='. $formattype . '&SD=0">Spoilers</a>'; }
								else { echo '<a href ="index.php?formattype='. $formattype . '&SD=1">Spoilers</a>'; }
								} else {
								if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?SD=0">Spoilers</a>'; }
								else { echo '<a href ="index.php?SD=1">Spoilers</a>'; }
								}
								?>
			  </li>
			    <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formats <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
					<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=standard&SD=1">Standard</a>'; }
					else { echo '<a href="index.php?formattype=standard&SD=0">Standard</a>'; } ?></li>
					<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=modern&SD=1">Modern</a>'; }
					else { echo '<a href="index.php?formattype=modern&SD=0">Modern</a>'; } ?></li>
					<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=legacy&SD=1">Legacy</a>'; }
					else { echo '<a href="index.php?formattype=legacy&SD=0">Legacy</a>'; } ?></li>
					<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=vintage&SD=1">Vintage</a>'; }
					else { echo '<a href="index.php?formattype=vintage&SD=0">Vintage</a>'; } ?></li>
					<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=limited&SD=1">Limited</a>'; }
					else { echo '<a href="index.php?formattype=limited&SD=0">Limited</a>'; } ?></li>
					<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=block&SD=1">Block</a>'; }
					else { echo '<a href="index.php?formattype=block&SD=0">Block</a>'; } ?></li>
					<li><?php if ($SD == '1' OR $SD == '') { echo '<a href ="index.php?formattype=mixed&SD=1">Mixed</a>'; }
					else { echo '<a href="index.php?formattype=mixed&SD=0">Mixed</a>'; } ?></li>
				  
                 </ul>
              </li>
			  
			  
			  
				<li class="dropdown active">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Streams <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
<li><?php 
// Workaround needs to be fixed 

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

$dbstreams = mysqli_connect($server, $username, $password, $database);
$resultscg = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'scglive'");
$datascg = mysqli_fetch_assoc($resultscg);
if ($datascg['online'] == '1') {
     echo "<a href='http://www.twitch.tv/scglive' target='_newtab'/> SCGLive is <img src='images/online.png' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/scglive' target='_newtab'/> SCGLive is <img src='images/offline.png' alt='Offline' /></a>";
}

?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'magic'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/magic' target='_newtab'/> Magic is <img src='images/online.png' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/magic' target='_newtab'/> Magic is <img src='images/offline.png' alt='Offline' /></a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'magic2'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/magic2' target='_newtab'/> Magic2 is <img src='images/online.png' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/magic2' target='_newtab'/> Magic2 is <img src='images/offline.png' alt='Offline' /></a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'channelfireball'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/channelfireball' target='_newtab'/> Channel Fireball is <img src='images/online.png' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/channelfireball' target='_newtab'/> Channel Fireball is <img src='images/offline.png' alt='Offline' /></a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'tcgplayer'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/tcgplayer' target='_newtab'/> TCGplayer is <img src='images/online.png' alt='Online' /></a>";
} else {
    echo "<a href='http://www.twitch.tv/tcgplayer' target='_newtab'/> TCGplayer is <img src='images/offline.png' alt='Offline' /></a>";
}
 
?></li>
	  </ul>
			  
			  
              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Contact <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="mailto:envi@mtgcoverage.com">envi@mtgcoverage.com</a></li>
				  <li><a href="https://www.facebook.com/MTGCoverage" target="_newtab">Facebook</a></li>
                  <li><a href="https://twitter.com/MTGCoverage" target="_newtab">Twitter</a></li>
                  <li><a href="http://www.reddit.com/message/compose/?to=envibeesj" target="_newtab">Reddit</a></li>
				  
                 </ul>
              </li>
			              </ul>
			  <ul class="nav navbar-nav navbar-right">
			<li class="active"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=68HG48VTFBWRU" target="_newtab">Donate</a></li>
			              </ul>

     
		  


		       </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    </div> <!-- /container -->
