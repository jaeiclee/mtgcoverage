<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>MTGCoverage - Calendar</title>
      <!-- Bootstrap -->
      <link href="css/bootstrap.css" rel="stylesheet">
      <link rel="stylesheet" href="css/fullcalendar.min.css">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <link href="css/navbar.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
   </head>
   <body>
      <?php
         include 'menu.php';
         ?>
      <style>
         .col-sm-3{
         padding-right: 0px;
         padding-left: 0px;
         }
      </style>
      <div class="container">
         <!-- Main component for a primary marketing message or call to action -->
         <div class="jumbotron">
			
            <div class="row" style="position:relative">
				<a style="position:absolute; top: 0; left: 0; z-index: 5000;" class="btn btn-info" href="#" onclick="prev_month()"><</a>
					  
	  
               <div class="col-sm-3" id="month1">
				
               </div>
               <div class="col-sm-3" id="month2">

               </div>
               <div class="col-sm-3" id="month3">

               </div>
               <div class="col-sm-3" id="month4">
				
               </div>
			  
				<a style="position:absolute; top: 0; right: 0; z-index: 5000;" class="btn btn-info" href="#" onclick="next_month()">></a>
			  
            </div>
         </div>
      </div>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>	
      <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
      <script src="js/fullcalendar.js"></script>	
      <style>
         .fc-vertweek-header {
         overflow: hidden;
         width: 100%;
         }
         .fc-vertweek-day {
         float: right; 
         margin: 10px;
         }	
      </style>
      <script>
	  
		var sOffset = 1;
	  
	  
		//Calculates the Ammount of a specific weekday in any given month, used to find the Number of Sundays
		function getAmountOfWeekDaysInMonth(date, weekday) {
			date.date(1);
			var dif = (7 + (weekday - date.weekday())) % 7 + 1;
			console.log("weekday: " + weekday + ", FirstOfMonth: " + date.weekday() + ", dif: " + dif);
			return Math.floor((date.daysInMonth() - dif) / 7) + 1;
		}
	  
		
		//Basic Calendar initialization, Current Month and 3 Month Future
		function fillMonths(){
					
			//Clear any possible gunk
			$(".col-sm-3").html("")
			//Set Background Color
			$(".col-sm-3").css("background-color","#bdbdbd")
			$(".button").css("background-color","rgb(101, 99, 103)")
			
			var k = 1;
			
			
			for (z = 0; z < 4; z++){
				//Curent Calendar based on today
				var mom = moment().add(z, 'months')
				var id = "#month"+k
				//Create the Calendar
				weekly_month(id,mom.month(),mom.year())
				k++;
			}	
			
			//Fix colum heights
			equalize();
			
		}
		
		
		//Fixes Calendar colum heights to look pretty
		function equalize(){
			//Get all Table Cells
			var m1 = $("#month1").find(".fc-vertWeek-view").children()
			var m2 = $("#month2").find(".fc-vertWeek-view").children()
			var m3 = $("#month3").find(".fc-vertWeek-view").children()
			var m4 = $("#month4").find(".fc-vertWeek-view").children()
	
			//Every Month with less then 5 weeks gets a dummy week
			if (m1.length <= 4) $("#month1").append('<div class="fc fc-ltr fc-unthemed"><div class="fc-view-container"><div class="fc-view fc-vertWeek-view fc-basic-view"><table></table></div></div></div>');
			if (m2.length <= 4) $("#month2").append('<div class="fc fc-ltr fc-unthemed"><div class="fc-view-container"><div class="fc-view fc-vertWeek-view fc-basic-view"><table></table></div></div></div>');
			if (m3.length <= 4) $("#month3").append('<div class="fc fc-ltr fc-unthemed"><div class="fc-view-container"><div class="fc-view fc-vertWeek-view fc-basic-view"><table></table></div></div></div>');
			if (m4.length <= 4) $("#month4").append('<div class="fc fc-ltr fc-unthemed"><div class="fc-view-container"><div class="fc-view fc-vertWeek-view fc-basic-view"><table></table></div></div></div>');
		
			//Include Dummy Week
			m1 = $("#month1").find(".fc-vertWeek-view").children()
			m2 = $("#month2").find(".fc-vertWeek-view").children()
			m3 = $("#month3").find(".fc-vertWeek-view").children()
			m4 = $("#month4").find(".fc-vertWeek-view").children()
			
			
			//Fix Each Cells height to the highest height in a row
			for (u = 0; u < 5; u++){
							
				var max = Math.max(m1[u].offsetHeight,m2[u].offsetHeight,m3[u].offsetHeight,m4[u].offsetHeight)
				
				m1[u].style.height=max;
				m2[u].style.height=max;
				m3[u].style.height=max;
				m4[u].style.height=max;			
			}
			
		}
		
		//Do this every 500ms to prevent any shenanigans
		//setInterval(equalize, 500);
		
		//Advances the Calendar by one month
		function next_month(){
			
			//Increment Current State
			sOffset++;
			
			//Shift every column one to the left
			$('#month1').html("")
			$('#month1').css("background-color",$('#month2').css("background-color"))
			$('#month1').append($('#month2').html())
			$('#month2').html("")
			$('#month2').css("background-color",$('#month3').css("background-color"))
			$('#month2').append($('#month3').html())
			$('#month3').html("")
			$('#month3').css("background-color",$('#month4').css("background-color"))
			$('#month3').append($('#month4').html())
			$('#month4').html("")
			$('#month4').css("background-color","#bdbdbd")
			
			
			var next = moment().add(sOffset+2, 'months')
			//Fill the Empty Column
			weekly_month('#month4', next.month(), next.year())
						
		}		

		//Regress the calendar by a month
		function prev_month(){
			
			//See next_month, just the other way around ^^
			sOffset--;
			
			$('#month4').html("")
			$('#month4').css("background-color",$('#month3').css("background-color"))
			$('#month4').append($('#month3').html())
			$('#month3').html("")
			$('#month3').css("background-color",$('#month2').css("background-color"))
			$('#month3').append($('#month2').html())
			$('#month2').html("")
			$('#month2').css("background-color",$('#month1').css("background-color"))
			$('#month2').append($('#month1').html())
			$('#month1').html("")
			$('#month1').css("background-color","#bdbdbd")
			
			var next = moment().add(sOffset-1, 'months')
			
			weekly_month('#month1', next.month(), next.year())
				
			
		}	

		
		//Load a calendar for each week of a month
		function weekly_month(selector, _month, _year){
			var element = $(selector);
			var start = moment({ month:_month, year:_year });
			
			//Highlight the current month / Week			
			if (moment().month() == _month && moment().year() == _year) {
				element.append('<h3 style="text-align:center; background-color: #fff">'+start.format("MMMM YYYY")+'</h3>')
				element.css("background-color","#fff")
			}
				else element.append('<h3 style="text-align:center;">'+start.format("MMMM YYYY")+'</h3>')
			
			var sundays = getAmountOfWeekDaysInMonth(start.clone(), 0)
			
			//Add a Calendar for each week that has a sunday in the given month
			for (i = 0; i < sundays; i++){
				var sDate = start.clone().startOf('isoWeek').add(i, 'weeks')
				var cName = start.clone().format("MMMM_YYYY")+"_"+i
				//Create a div to hold the calendar
				var calendar = element.append('<div id="'+cName+'"> </div>');
				//Set up the Calendar
				new_calendar($("#"+cName),sDate);
			}
		}
	  
         function new_calendar(elem, mom){
         		
				
         		var currentStartOfWeek = mom.clone().startOf('isoWeek')
								
         		var currentEndOfWeek = mom.clone().endOf('isoWeek')
         		
         		elem.fullCalendar({
         			events: '/api/tournament.php',
					//transfors out json tournaments into calendar Events
         			eventDataTransform: function(event) {
         				
         							//[{"ID":"1","Name":"Grand Prix Dallas \/ Forth Worth","Visible":"1","Finished":"1","Format":"Standard","Organiser":"GP","Location":"Dallas \/ Forth Worth, USA","StartDate":"2013-12-06","EndDate":"2013-12-08","InfoLink":"","ResultLink":"http:\/\/www.wizards.com\/magic\/magazine\/article.aspx?x=mtg\/daily\/eventcoverage\/gpdfw13\/welcome#1","ExtraText":""
         							var eventObject = {}
         							eventObject.id = event.ID
         							eventObject.allDay = true
         							eventObject.start = event.StartDate
         							eventObject.end = event.EndDate
         							eventObject.title = event.Name
         							//eventObject.imageurl = event.Organiser.toLowerCase()+".png"
         							if (event.Calendar == "1")
         								{
         								eventObject.color = "#51C759"
         								}
         							else if (event.Visible == "1") 
         								{
         								var spoiler = '<?php echo $SD ?>';
         								eventObject.url = "index.php?SD="+spoiler+"&id="+event.ID
         								}
         							else if (event.Finished == "1")
         								{
         								eventObject.url = event.ResultLink
         								eventObject.color = "#828282"
         								}	
         							else 
         								{
         								eventObject.url = event.InfoLink
         								eventObject.color = "#821110"
         								}

         							return eventObject;
         						},
								
         			firstDay : 1,
					//Ignore all useless days
         			eventRender: function(event, eventElement) {
         				/*	if (event.imageurl)
         					{
         						eventElement.find("span.fc-title").prepend("<img src='/images/" + event.imageurl +"' style='max-width: 70px; max-height: 25px'>");
         					}
         				*/
         				
         				var jEvent = $(eventElement);
         				var week = jEvent.parent().parent();
         				
         				week.append(jEvent)					
         				
         			},
         			header: false,
         			defaultView: 'vertWeek',
         			dayRender: function( date, cell ) { 
         				// Get the current view     
         				var view = $('#meal_calendar').fullCalendar('getView');
         
         				// Check if the view is the new vertWeek - 
         				// in case you want to use different views you don't want to mess with all of them
         				if (view.name == 'vertWeek') {
         					// Hide the widget header - looks wierd otherwise
         					$('.fc-widget-header').hide();
         
         					// Remove the default day number with an empty space. Keeps the right height according to your font.
         					$('.fc-day-number').html('<div class="fc-vertweek-day">&nbsp;</div>');
         
         					// Create a new date string to put in place  
         					var this_date = date.format('ddd, MMM Do');
         
         					// Place the new date into the cell header. 
         					cell.append('<div class="fc-vertweek-header"><div class="fc-vertweek-day">'+this_date+'</div></div>');
         				}
         			},
					//Hightlight current month/week and set header
         			viewRender: function(view, element) {
         				
         				$(".fc-day-number").remove();
         				var elem = element.find(".fc-day-header")
						elem.html(""+currentStartOfWeek.format('DD/MM')+" - "+ currentEndOfWeek.format('DD/MM'))
						if (currentStartOfWeek.week() == moment().week()) elem.css("background-color", "#FFD700")
         				
         			},
					eventAfterAllRender : function( view ) { 
						equalize();
					},
         			defaultDate: currentStartOfWeek,
         			height: "auto",
         			hiddenDays: [ 1,2,3,4,5,0 ],
         			columnFormat: 'M' 				
         		
         		});	
         	
         }
         
         
         
         	$(document).ready(function() {
         
         		// page is now ready, initialize the calendar...
				fillMonths()
     
         	});
      </script>
	  

	  <?php include 'footer.php'; ?>
   </body>
</html>