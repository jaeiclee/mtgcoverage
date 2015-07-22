MTGCoverage Readme

Package:
- Readme.txt
- V1 (The current live website)
- V2 (The work in progress website)
- Databases (Both for V1 and V2)



Word of warning:

Trying to read the source code (especially on V1) and figuring out how it works 
might give you cancer. The project wasn't made to be public and the core of the 
page was originally made for something else, from there features got added and 
workarounds on bugs got made. V2 was supposed to be a complete rebuild of the 
website based on Bootstrap v3 but was never finished. 

Instead of using the source code I supplied I would advice to just use the 
database and make a script to extract the information. Coverage goes back to 
October 2013 and contains around 2500 videos.

I will focus on explaining how the V1 website works, as V2 is not yet finished.


About the page:

The page was written in PHP / MySQL based on a old project I had around, on 
which I continue to expand and add. I've tried to expand and build around my
own bad code for a while, till I started working on V2. V1 is held together by
duct tape and tie-wraps.

To install it you'll have to get the V1 database up on a SQL server and the
rest of the files on webserver that supports PHP. You'll need to change the
login details of the SQL server in the following files:

- asearch.php
- common.php
- config.php
- header.php
- streamupdater.php

To make sure to get the buttons next to the streams to update you'll need to 
make a script or other way to run streamupdater every once in a while. I used
to do this by having the following crontab entry:

*/5 * * * *     lynx -dump http://www.mtgcoverage.com/streamupdater.php >/dev/null 2>&1

It would just open a webbrowser on the server every 5 minutes and update the 
values in the database.

If you don't want the streams to have buttons you can just remove the code in 
menu/horizontal.php and replace it with static links. 

To update the page I would just use phpMyAdmin ( https://www.phpmyadmin.net ) as
it was good enough and didn't require me to make my own admin tools.

A last manual thing that has to be done every once in a while is to run the script that
updates all the playernames and decknames to be added for the dropdown menus of the 
search page. The SQL query for this is located in the sqldeckupdate-sql.txt file. I never
got around to automate this, as I tend to only run the query once a month.



Database V1:

4 Tables:
- decks
	List of all decks used by the dropdown menu in search page
- players
	List of all players used by the dropdown menu in search page
- streams
	Used to check if streams are online/offline, values are updated by 
	streamupdater.php which runs every 5 minutes (1 for online 0 for offline).
- events
	Main data, each event is one row.
	
		- id (automaticly adds id to new event)
		- visible (Make an event visible on the website ( 1 visible / 0 not visible)
		- name (Name of the event)
		- startdate (Start date of event)
		- enddate (End date of event)
		- formattype (Format of the event, for multiple formats use: Mixed)
		- location (Location of event)
		- results (link to results page) 
		- finished (Is current event done or not, used for sorting of calender, 
			upcoming and past events)
		- added (automaticly adds time the event was created)
		- organiser (who organises the event, this decides which image to show 
			next to the event options are: GP, PT, WORLDS, SCG, CFB, TCG, CT (Card Titan), 
			SCV (Scandinavian Open) or leave blank for no logo)
		- infolink (Info link that shows up on the calender)
			
		- extratext (Used to leave a message at the bottom of the event in case something
			is wrong with coverage for example)
		
		- extraX (to post links to for example deck techs)
		- extraXinfo (Text to go with the link example: "Deck Tech: DeckX by PlayerY")
		
		- standard
		- modern
		- legacy
		- vintage
		- limited
		- block
			Used to sorting events, set 1 for each value that is true, 0 for false
		
		- roundX (Link to coverage Twitch or YouTube)
		- quarterX / semiX (In case there are multiple quarter/semifinals use the numbered
			ones (for example ProTours show all quarter finals)
		
		- roundXplayer1 (Player on the left side of the screen, linked to RoundX)
		- roundXplayer2
		- roundXdeck1 (Deck of the left player, I tend to follow SCG decknaming)
		- roundXdeck2
		
		
		
Sources: 

Video sources I used:
	- http://www.twitch.tv/magic/profile/past_broadcasts (Wizards)
	- http://www.twitch.tv/magic2/profile/past_broadcasts (Wizards)
	- http://www.twitch.tv/scglive/profile/past_broadcasts (StarCity Games)
	- http://www.twitch.tv/channelfireball/profile/past_broadcasts (Channel Fireball)
	- http://www.twitch.tv/svmtv/profile/past_broadcasts (Scandinavian Open)
	
	- https://www.youtube.com/user/starcitygamesvideo/playlists (SCG Youtube)
	- https://www.youtube.com/user/ggslive/playlists (USA based Tournaments)
	- https://www.youtube.com/user/wizardsmtg/playlists (Wizards big events and top 8s)
	- https://www.youtube.com/channel/UCM--VW1tkcrez4fLsdC9CAA/playlists (Scandinavian Open YouTube channel)
	- https://www.youtube.com/user/ChannelFireball/playlists (ChannelFireball YouTube channel)
	- https://www.youtube.com/channel/UCPCNEKq4EPN6tcl6zopb1ww/playlists (Card Titan Youtube channel)
	
Coverage archives (text results)
	- http://magic.wizards.com/en/events/coverage
	- http://www.starcitygames.com/pages/scgop/archive
	

When using Twitch sources make sure to replace them with YouTube links when they get released,
with the recent Twitch changes they are no longer storing past broadcasts indefinitely. So they
will get removed after a certain time breaking the videos.
	
	
	
V2:

A test version can be found on http://www.mtgcoverage.com/v2/ 

V2 was meant to replace the current website, being build from the ground up it would give me
more flexibility and allowed me to add features that would be impossible on the old website.

Things V2 was able to do that I wasn't able to do on the old page are for example having 
individual player pages and being able to sort decks and having multiple decks with the same
name. 

Example: http://www.mtgcoverage.com/v2/search.php?deck=uw+control
Example: http://www.mtgcoverage.com/v2/player.php?id=1711



Note: 

Logo's and player photos used on the website is done with permission. If you plan to use these,
make sure to ask permission from their rightful owner.



Final thoughts:

If you managed to get this far give yourself a treat :) I do hope someone continues my work
as there seems to be quite a big demand for it. I had fun doing it and got to meet a bunch
of interesting because of it. 


