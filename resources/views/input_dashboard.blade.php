<html>
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		<script>
            var url = "{{url('')}}";

            $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
        </script>
        <title> Dashboard Input </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	</head>
	<body>
		<select style="width: 100%; padding: 10px; font-size: 14px;" id="theproject">
			<option value="none"> Select </option>
			<?php
				foreach($collection as $c) {
					echo "<option value='{$c['masterid']}'>";
						echo $c['title'];
					echo "</option>";
				}
			?>
		</select>

		<table>
			<tbody id="location"> </tbody>
		</table>

		<div style="border:1px solid #ccc;padding: 10px;margin-top: 8px;">
			<h3> Input data </h3>
			<select style="margin-top:5px; padding: 10px; font-size: 14px;" id="thelocation">
				<option value="zamboanga_del_norte"> Zamboanga Del Norte </option>
				<option value="zamboanga_del_sur"> Zamboanga Del Sur </option>
				<option value="zamboanga_sibugay"> Zamboanga Sibugay </option>
				<option value="bukidnon"> Bukidnon </option>
				<option value="camiguin"> Camiguin </option>
				<option value="lanao_del_norte"> Lanao Del Norte </option>
				<option value="lanao_del_sur"> Lanao Del Sur</option>
				<option value="misamis_occidental"> Misamis Occidental </option>
				<option value="misamis_oriental"> Misamis Oriental </option>
				<option value="davao_de_oro"> Davao De Oro</option>
				<option value="davao_del_norte"> Davao Del Norte </option>
				<option value="davao_del_sur"> Davao Del Sur </option>
				<option value="davao_occidental"> Davao Occidental </option>
				<option value="davao_oriental"> Davao Oriental </option>
				<option value="north_cotabato"> North Cotabato </option>
				<option value="sarangani"> Sarangani </option>
				<option value="south_cotabato"> South Cotabato </option>
				<option value="sultan_kudarat"> Sultan Kudarat </option>
				<option value="agusan_del_norte"> Agusan Del Norte </option>
				<option value="agusan_del_sur"> Agusan Del Sur </option>
				<option value="dinagat_islands"> Dinagat Islands </option>
				<option value="surigao_del_sur"> Surigao Del Sur </option>
				<option value="surigao_del_norte"> Surigao Del Norte </option>
				<option value="basilan"> Basilan </option>
				<option value="maguindanao_del_norte"> Maguindanao Del Norte </option>
				<option value="maguindanao_del_sur"> Maguindanao Del Sur </option>
				<option value="sulu"> Sulu </option>
				<option value="tawi_tawi"> Tawi-tawi </option>
			</select>
			<input type='text' placeholder ='Latitude' id='lat' style="margin-top:5px; padding: 10px; font-size: 14px;"/>
			<input type='text' placeholder ='Longitude' id='lng' style="margin-top:5px; padding: 10px; font-size: 14px;"/>
			<input type='submit' value="Save" id="savebtn" style="margin-top:5px; padding: 10px; font-size: 14px;"/>
		</div>

		<div style="border:1px solid #ccc;padding: 10px;margin-top: 8px;">
			<h3> Map to SDG </h3>
			<select id='thesdg' style="margin-top:5px; padding: 10px; font-size: 14px;">
				<?php
					foreach($sdg as $s) {
						echo "<option value='{$s->sdgid}'>SDG {$s->sdg_num}: {$s->thesdg}</option>";
					}
				?>
			</select>
			<input type='submit' value="Update SDG" id="updatesdg" style="margin-top:5px; padding: 10px; font-size: 14px;"/>
		</div>

		<script>	
				$(document).on("click","#updatesdg", function(){
					var theproject  = $(document).find("#theproject").val();
					var thesdg 		= $(document).find("#thesdg").val();

					$.ajax({
						url 	 : url+"/save_sdg",
						type 	 : "post",
						data 	 : { activityid : theproject,
									sdgid 	   : thesdg
								   },
						dataType : "json",
						success  : function(data) {
							alert(data);
						}, error : function() {
							alert("error");
						}
					});
				});

				$(document).on("click","#savebtn", function(){
					var theproject  = $(document).find("#theproject").val();
					var thelocation = $(document).find("#thelocation").val();

					var lat 		= $(document).find("#lat").val();
					var lng 		= $(document).find("#lng").val();

					$.ajax({
						url 	: url+"/save_location",
						type    : "post",
						data    : { masterid 	: theproject,
									columnplace : thelocation,
									lat 		: lat,
									lng 		: lng
								  },
						dataType : "json",
						success : function(data) {
							alert("Saved");
							$(document).find("#lat").val("");
							$(document).find("#lng").val("");
						}, error : function() {
							alert("error saving");
						}
					});
				});
	

			$(document).on("change","#theproject", function(){
				var masterid = $(this).val();

				if (masterid == "none") {
					return;
				}

				$(document).find("#location").children().remove();

				$.ajax({
					url 	 : url+"/get_location",
					type 	 : "get",
					data 	 : { masterid : masterid },
					dataType : "json",
					success  : function(data) {
						$("<tr><td colspan='2'>"+data[0][0].target_location+"</td></tr>").appendTo("#location");

						for(var i=0; i<=data[0].length-1; i++) {
							$("<tr><td>Lat:"+data[1][i].lat+"</td><td>Lng:"+data[1][i].lng+"</td></tr>").appendTo("#location");
						}

					}, error : function() {
						alert("error");
					}
				});
			});
		</script>
	</body>
</html>