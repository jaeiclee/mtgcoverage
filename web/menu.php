	<?php include 'header.php'; ?>  
	<?php if ($SD == '') { $SD = 3; } ?>
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
            <?php echo '<a href ="index.php?SD='.$SD.'"><img src="logo-sq.png" height="50px" width="50px"></a>'; ?>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><?php echo '<a href ="index.php?SD='.$SD.'">Home</a>'; ?></li>
              <li class="active">
                <?php echo '<a href ="calendar.php?SD='.$SD.'">Calendar</a>'; ?>
              <li class="active"><?php echo '<a href="search.php?SD='.$SD.'">Search</a></li>'; ?>
			  <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                	<?php if ($SD == '0') { echo 'Spoilers OFF'; } ?>
                	<?php if ($SD == '1') { echo 'Spoilers ON*'; } ?>
                	<?php if ($SD == '2') { echo 'Spoilers ON*'; } ?>
                	<?php if ($SD == '3') { echo 'Spoilers ON'; } ?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
					<li><?php if ($SD == '0') { echo '<a href ="index.php?SD=0">No Spoilers - Chosen</a>'; } else { echo '<a href ="index.php?SD=0">No Spoilers</a>'; } ?></li>
					<li><?php if ($SD == '1') { echo '<a href ="index.php?SD=1">Deck Names Only - Chosen</a>'; } else { echo '<a href ="index.php?SD=1">Deck Names Only</a>'; } ?></li>
					<li><?php if ($SD == '2') { echo '<a href ="index.php?SD=2">Player Names Only - Chosen</a>'; } else { echo '<a href ="index.php?SD=2">Player Names Only</a>'; } ?></li>
					<li><?php if ($SD == '3') { echo '<a href ="index.php?SD=3">All Spoilers - Chosen</a>'; } else { echo '<a href ="index.php?SD=3">All Spilers</a>'; } ?></li>
				</ul>
              </li>
			    <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formats <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
					<li><?php echo '<a href ="index.php?formattype=standard&SD='.$SD.'">Standard</a>'; ?></li>
					<li><?php echo '<a href ="index.php?formattype=modern&SD='.$SD.'">Modern</a>'; ?></li>
					<li><?php echo '<a href ="index.php?formattype=legacy&SD='.$SD.'">Legacy</a>'; ?></li>
					<li><?php echo '<a href="index.php?formattype=vintage&SD='.$SD.'">Vintage</a>'; ?></li>
					<li><?php echo '<a href ="index.php?formattype=limited&SD='.$SD.'">Limited</a>'; ?></li>
					<li><?php echo '<a href ="index.php?formattype=block&SD='.$SD.'">Block</a>'; ?></li>
					<li><?php echo '<a href ="index.php?formattype=mixed&SD='.$SD.'">Mixed</a>'; ?></li>
				  
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
    //echo "<a href='http://www.twitch.tv/scglive' target='_newtab'/> SCGLive is <img src='images/offline.png' alt='Offline' /></a>";
    echo "<a href='http://www.twitch.tv/scglive' target='_newtab'/> SCGLive</a>";
}

?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'magic'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/magic' target='_newtab'/> Magic is <img src='images/online.png' alt='Online' /></a>";
} else {
    //echo "<a href='http://www.twitch.tv/magic' target='_newtab'/> Magic is <img src='images/offline.png' alt='Offline' /></a>";
    echo "<a href='http://www.twitch.tv/magic' target='_newtab'/> Magic</a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'magic2'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/magic2' target='_newtab'/> Magic2 is <img src='images/online.png' alt='Online' /></a>";
} else {
    //echo "<a href='http://www.twitch.tv/magic2' target='_newtab'/> Magic2 is <img src='images/offline.png' alt='Offline' /></a>";
    echo "<a href='http://www.twitch.tv/magic2' target='_newtab'/> Magic2</a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'channelfireball'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/channelfireball' target='_newtab'/> Channel Fireball is <img src='images/online.png' alt='Online' /></a>";
} else {
    //echo "<a href='http://www.twitch.tv/channelfireball' target='_newtab'/> Channel Fireball is <img src='images/offline.png' alt='Offline' /></a>";
    echo "<a href='http://www.twitch.tv/channelfireball' target='_newtab'/> Channel Fireball</a>";
}
 
?></li>

<li><?php
 
$resultmagic = mysqli_query($dbstreams, "SELECT * FROM Streams WHERE streamname = 'tcgplayer'");
$datamagic = mysqli_fetch_assoc($resultmagic);
if ($datamagic['online'] == '1') {
     echo "<a href='http://www.twitch.tv/tcgplayer' target='_newtab'/> TCGplayer is <img src='images/online.png' alt='Online' /></a>";
} else {
    //echo "<a href='http://www.twitch.tv/tcgplayer' target='_newtab'/> TCGplayer is <img src='images/offline.png' alt='Offline' /></a>";
    echo "<a href='http://www.twitch.tv/tcgplayer' target='_newtab'/> TCGplayer</a>";
}
 
?></li>
	  </ul>
			  
			  
              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Contact <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <!-- <li><a href="mailto:envi@mtgcoverage.com">envi@mtgcoverage.com</a></li> -->
				          <li><a href="https://www.facebook.com/MTGCoverage" target="_newtab">Facebook</a></li>
                  <li><a href="https://twitter.com/MTGCoverage" target="_newtab">Twitter</a></li>
                  <li><a href="http://www.reddit.com/message/compose/?to=ideocl4st_" target="_newtab">Reddit</a></li>
                  <li><a href="https://github.com/ideocl4st/mtgcoverage-v2-heroku" target="_newtab">Github</a></li>
				  
                 </ul>
              </li>
			              </ul>
			  <!--<ul class="nav navbar-nav navbar-right">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="F2267LQ2XS2JC">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="Donation">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			              </ul>-->

     
		  


		       </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    </div> <!-- /container -->
