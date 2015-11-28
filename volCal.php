<script>
	$(document).ready(function() {
		// page is now ready, initialize the calendar...
		$('#calendar').fullCalendar({
			editable: true,
			weekmode: 'variable',
			eventClick: function(event) {
				if (event.url){
					$.confirm({
						'title'		: event.title,
						'message'	: "<p>Starts: " + event.start.format('LLLL')
										+ "<br>Ends: " + event.end.format('LLLL')
										+ "<br><br>" + event.description,
						'buttons'	: {
							'OK'	: {
										'class'	: 'blue',
									}
								},
					});
					return false;
				}
				
			},
			eventSources: [
			// your event source
				{
					events:  [
						<?php 
						// Create connection
						$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
						$query = mysqli_query($connection, "SELECT * FROM events");
						while ($event = mysqli_fetch_assoc($query)) {
							$eventID = $event["eventId"];
							$title = $event["title"];
							$start = $event["startDateTime"];
							$end = $event["endDateTime"];
							$MinVols = $event["MinVols"];
							$MaxVols = $event["MaxVols"];
							$MinStud = $event["MinStud"];
							$MaxStud = $event["MaxStud"];
							$Desc = $event["Desc"];
							
							if ($event["removed"] == 1) {
								$color = red;
								$textColor = white;
							} else if ($event["removed"] == 0 && $MaxVols > 0) {
									$color = green;
									$textColor = white;
							} else {
								$color = blue;
								$textColor = white;
							}
							
							if (!$Desc){
								$Desc = '';
							}
							
							echo "{";
							echo "title : '$title',";
							echo "start : '$start',";
							echo "end : '$end',";
							echo "url : 'viewEvent.php?eventID=$eventID',";
							echo "color : '$color',";
							echo "textColor : '$textColor',";
							echo "minVols: '$MinVols',";
							echo "maxVols: '$MaxVols',";
							echo "minStud: '$MinStud',";
							echo "maxStud: '$MaxStud',";
							echo "description : '$Desc',";
							echo "},";
						}
						mysqli_close($connection);
						?>
					],
				}
				// any other event sources...
			]
		})
	});
</script>