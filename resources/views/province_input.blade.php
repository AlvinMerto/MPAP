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
        <title> Province Information Input </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	</head>
	<body>
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

		<select id="header_select" style="margin-top:5px; padding: 10px; font-size: 14px;">
			<option value="background">Background</option>
			<option value="emblem"> Emblem </option>
			<option value="governor"> Governor </option>
			<option value="vicegovernor"> Vice Governor </option>
			<option value="area"> Land Area </option>
			<option value="provname"> Provincial Name </option>
			<!-- <option value="rank"> Rank </option> -->
			
		</select>
		<br/>
		<textarea id="thevalue" style="margin-top: 5px; width:777px;height: 250px;"></textarea>
		<br/>
		<input type='button' id="savenow" value="Save Now" style="margin-top:5px; padding: 10px; font-size: 14px;"/>

		<script>
			$(document).on("click","#savenow", function(){
				var location  = $(document).find("#thelocation").val();
				var loc_text  = $(document).find("#thelocation :selected").text();

				var htmlmap   = $(document).find("#header_select").val();
				var theheader = $(document).find("#header_select :selected").text();

				var thevalue  = $(document).find("#thevalue").val();

				// save_province_info

				$.ajax({
					url 	 : url+"/save_province_info",
					type     : "post",
					data 	 : {
						location	: location,
						loc_text	: loc_text,
						htmlmap		: htmlmap,
						theheader	: theheader,
						thevalue 	: thevalue
					},
					dataType : "json",
					success  : function(data) {
						$(document).find("#thevalue").val("");
					}, error : function(){
						alert("error")
					}
				})
			});
		</script>
	</body>
</html>