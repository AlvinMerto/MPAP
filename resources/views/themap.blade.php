<html>
	<head>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
        <title> Mindanao ODA Map </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
		<style>
			* {
				  font-family: "Open Sans", sans-serif;
				  font-optical-sizing: auto;
				  font-weight: <weight>;
				  font-style: normal;
				  font-variation-settings:
				    "wdth" 100;
			}
			.material-symbols-outlined {
			  font-variation-settings:
			  'FILL' 0,
			  'wght' 400,
			  'GRAD' 0,
			  'opsz' 24
			}

			body {
				padding:0px;
				margin:0px;
			}
			#map { 
				height: 100%; 
			}

			.leftsidediv{
				/*width: 400px;*/
				width:0px;
				background: #fff;
				height: 100%;
				position: fixed;
				top: 0;
				z-index: 1000;
				box-shadow: 2px 0px 15px #908989;
				overflow-y: scroll;
				overflow-x: hidden;
			}

			.topsidediv {
				padding-bottom: 15px;
				width: 100%;
				position: fixed;
				top: 0;
				z-index: 10000;
				margin-top: 10px;
				margin-left:55px;
				overflow-x:hidden;
				scroll-behavior: smooth;
			}

			.topsidediv:hover {
				overflow-x: scroll;
			}

			.topsidediv ul {
				padding-left: 0px;
				width: max-content;
				margin: 0px 0px;
			}

			.topsidediv ul li {
				display: inline-block;
				background: #fff;
				border-radius: 99px;
				padding: 10;
				margin-right: 5px;
				color: #444;
				font-size: 13px;
			}

			.topsidediv ul li:hover {
				cursor: pointer;
				background:#fff;
				box-shadow: 0px 5px 10px #333;

				transition: box-shadow .3s;
			}

			.thetext {
				border-radius: 99px;
			  width: 100%;
			  font-size: 14px;
			  padding: 15px 10px;
			  text-align: center;
			  border: 1px solid #ccc;
			  outline: none;
			}

			.thesearch {
				padding:20px;
			}

			.thecontent {
				padding:0px;
			}

			.content-div {
				padding:0px;
			}

			.thetext:focus {
				box-shadow: 0px 5px 10px #ccc;

				transition: box-shadow .3s;
			}

			.theimage{
				width:auto;
			}

			.theimage img {
				width:100%;
			}

			h2, p {
				margin:0px;
				padding:0px;
			}

			.thenavigation ul {
				padding-left: 0px;
				margin-bottom: 0px;
				border-bottom: 1px solid #ccc;
				display:flex;
				margin-top:0px;
			}

			.thenavigation ul li{
				padding: 10px;
			  font-size: 14px;
			  flex: 1;
			  text-align: center;
			  list-style: none;
			}

			.selected {
				font-weight: bold;
				  color: #0d8e76;
				  border-bottom: 5px solid;
			}

			.thecont_main ul {
				margin-top: 0px;
			    padding-left: 0px;
			}

			.thecont_main ul li {
				list-style: none;
				border-bottom: 1px solid #ccc;
				padding: 0px 0px 0px 9px;
				font-size: 13px;
			}

			.thecont_main ul li:hover > span {
				font-weight: bold;
				cursor: pointer;
			}

			#the_invs li {
				display: flex;
			}

			#the_invs li div {
				display:inline-block;
				padding: 10px;
			}

			#the_invs li span.inv_text {
				position: relative;
  				top: -6px;
  				left: 10px;
			}

			#the_invs li span.the_icon {
				color: #8d8b8b;
				font-size: 19px;
			}

			#right_side {
				  position: fixed;
				  z-index: 100000;
				  right: 5px;
				  top: 10;
				  width: 0px;
				  height: 97%;
				  background: #fff;
				  box-shadow: 0px 0px 20px #9c9c9c;
				  border-radius: 6px;
				  overflow-y: scroll;
			}

			.thegraphs_wrap {
				border-bottom: 1px solid #ccc;
  				padding: 10px 0px 15px;
			}

			.per_commo { 
				display:none;
			}

			.the_div_title{
				font-size: 11px;
				color: #0d8e76;
			}

			.the_desc_txt {
				font-size: 14px;
			}

			.thetopdiv {
				padding: 19px;
			}

			/*.the_pictures img {
				width:100%;
			}*/

			.nav_top {
				display: flex;
			}

			.the_box {
				float: right;
			  width: 300px;
			  background: #fff;
			  padding: 17px;
			  position: fixed;
			  bottom: 0;
			  right: 0;
			  z-index: 100000;
			  margin: 10px;
			  border-radius: 10px;
			  opacity: 0.5;
			}

			.the_box:hover {
				opacity:10;
				box-shadow: 0px 0px 26px #6e6d6d;
			}

			.table_right {
				border-collapse: collapse;
				border:0px;
				width: 100%;
			}

			#the_sectors {
				width: 100%;
				padding: 7px;
			}

			#theslider {
				width: 3000px;
				  padding: 0px;
				  margin: 0px;
			}

			#theslider li{
				width: 400px;
				list-style: none;
				display: inline-block;
			}

			#theslider li img {
				width: 100%;
			}

			.action_btn:hover {
				color:red;
				cursor: pointer;
			}

			.h_p {
				font-size: 13px;
  				margin-bottom: 5px;
			}

			.selected_top {
				background: #15629b !important;
			  color: #fff !important;
			  font-weight: bold !important;
			  box-shadow: 0px 0px 5px #000 !important;
			  border-radius: 0px !important;
			}

			.selected_top:hover > ul{
				display:block;
			}

			.the_sub_ul {
				display: none;
				  position: fixed;
				  left: 10px;
				  margin-top: 8px !important;
				display: none;
				background: #fff;
  				box-shadow: 0px 7px 7px #000;
			}

			.the_sub_ul li{
				display: block !important;
				  border-radius: 0px !important;
				  margin-bottom: 3px;
			}

			#thefilter {
				padding: 7px 14px;
			  margin-top: 3px;
			  background: #1d9feb;
			  border: 1px solid #fff;
			  border-radius: 6px;
			  color: #fff;
			  font-size: 14px;
			}

			#refreshbtn {
				font-size: 12px;
			  text-decoration: underline;
			  cursor: pointer;
			}

			.wrapper_left_top {
				display: flex;
			}
		</style>
	</head>
	<body>
		<div id="map"></div>
		<!-- <div class="wrapper_left_top"> -->
			<div class="leftsidediv" id="leftsidediv">
				<!-- <div class='thesearch'>
					<input type='text' class="thetext"/>
				</div> -->
				<div class="content-div">
					<!-- <div class='theimage'>
						<img src="https://lh5.googleusercontent.com/p/AF1QipOkl7JgGFiTBIrjOb6a4ruRb4I4WnGjpJscTyFL=w426-h240-k-no"/>
					</div> -->
					<div class="thecontent">
						<div class="the_pictures">
							<ul id="theslider">
								<li> <img src='https://lh3.googleusercontent.com/p/AF1QipNKKDIIJlHffUfCMyBM2tm8IYPbUMhyMa8_2StG=s1360-w1360-h1020'/> </li>
								<li> <img src='https://lh3.googleusercontent.com/p/AF1QipNKKDIIJlHffUfCMyBM2tm8IYPbUMhyMa8_2StG=s1360-w1360-h1020'/> </li>
								<li> <img src='https://lh3.googleusercontent.com/p/AF1QipNKKDIIJlHffUfCMyBM2tm8IYPbUMhyMa8_2StG=s1360-w1360-h1020'/> </li>
							</ul>
							<div style="text-align:center;">
								<span class="material-symbols-outlined action_btn" data-btn="prev"> arrow_back_ios </span>
								<span class="material-symbols-outlined action_btn" data-btn="next"> arrow_forward_ios </span>
							</div>
						</div>
						<div class="thetopdiv">
							<h2 style="font-size: 19px;font-weight: normal;" id='the_proj_title'> This is the Title of the Project </h2>
							<p style="font-size: 13px;" id="the_funder"> GIZ Initiated Project </p>
						</div>
						<div class="themaincontent">
							<div class="thenavigation">
								<ul id='the_info_nav'>
									<li class="selected" data-the_tab="the_project"> The Project </li>
									<li data-the_tab="the_donor_div"> The Donor </li>
									<!-- <li> Pictures </li> -->
								</ul>
							</div>
							<div class="thecont_main">
								<div id="the_project">
									<ul id="the_invs">
										<!-- <li>
											<div> <span class="material-symbols-outlined"> title </span>  </div>
											<div> 
												<span class='the_div_title'> Project Title </span> 
												<p class='the_desc_txt'> This is the Title of the project </p>
											</div> 
										</li> -->
										<li>
											<!-- <div> <span class="material-symbols-outlined"> description </span>  </div> -->
											<div> 
												<span class='the_div_title'> Project Description </span> 
												<p class='the_desc_txt' id="the_desc"> This is the project description of the project, lorem ipsum dolor set amit </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> favorite </span>  </div>
											<div>
												<span class='the_div_title'> Donor Agency </span> 
												<p class='the_desc_txt' id='the_donor'> GIZ </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> donut_small </span>  </div>
											<div>
												<span class='the_div_title'> Sector </span> 
												<p class='the_desc_txt' id="the_sector"> Infrastructure </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> location_on </span>  </div>
											<div> 
												<span class='the_div_title'> Exact Location </span> 
												<p class='the_desc_txt' id="the_loc"> XPGF+2R7, Kaputian, Island Garden City of Samal, Davao del Norte, Philippines  </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> payments </span>  </div>
											<div>
												<span class='the_div_title'> Proposed Amount </span> 
												<p class='the_desc_txt' id="prop_amount"> 2,590,305.00 PHP </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> attach_money </span>  </div>
											<div>
												<span class='the_div_title'> Assistance Amount </span> 
												<p class='the_desc_txt' id="asst_amount"> 2,390,305.00 PHP </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> currency_exchange </span>  </div>
											<div>
												<span class='the_div_title'> Currency </span> 
												<p class='the_desc_txt' id="currency"> USD </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> Support </span>  </div>
											<div>
												<span class='the_div_title'> Type of Assistance </span> 
												<p class='the_desc_txt' id="ta_type"> Grant </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> detector_status </span>  </div>
											<div>
												<span class='the_div_title'> Status </span> 
												<p class='the_desc_txt' id="proj_status"> On-Going </p>
											</div> 
										</li>
										<li>
											<div> <span class="material-symbols-outlined"> update </span>  </div>
											<div>
												<span class='the_div_title'> Latest Updates </span> 
												<p class='the_desc_txt' id="the_updates"> This is the latest update of the project hey hey hey hey </p>
											</div> 
										</li>
									</ul>
								</div>
								<div id="the_donor_div">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="topsidediv">
				<!-- <div class=""> <span class="material-symbols-outlined"> menu </span> </div> -->
				<ul id='the_sectors_top'>
					<li class="selected_top"> all </li>
					<?php
						foreach($funders as $f) {
							echo "<li>";
								echo $f;
								// echo "<ul class='the_sub_ul'>";
								// 	foreach($the_return as $tr) {
								// 		echo "<li> {$tr} </li>";
								// 	}
								// echo "</ul>";
							echo "</li>";
						}
					?>
				</ul>		
			</div>
		<!-- </div> -->


				<div class="the_box">
					<table class="table_right">
						<tr>
							<td>
								<p> Filter the Map </p>
								<hr style="border:0px; border-bottom:1px solid #ccc;"/>
							</td>
						</tr>
						<tr>
							<td>
								<p class="h_p"> Sectors </p>
								<select id='the_sectors' style="font-weight: bold;font-family: arial;font-size: 13px; padding:10px;">
										
								</select>
							</td>
						</tr>
						<!-- <tr>
							<td>
								<p class="h_p"> Funder </p>
								<select id='the_funders' style="font-weight: bold;font-family: arial;font-size: 13px; padding:10px;">
										
								</select>
							</td>
						</tr> -->
						<tr> 
							<td style="padding: 8px 0px;"> 
								<!-- <button class="btn btn-primary" id='thefilter'> Filter </button>  -->
								<a id='refreshbtn'> Clear Filter </a>
							</td>
						</tr>
					</table>
				</div>

		<div id="right_side">
			<div style="padding: 0px 20px;" id='general_info'>
				<div class="thegraphs_wrap">
					<h3> All Time Industry Distribution </h3>
					<canvas id="distribution_per_industry"></canvas>
				</div>
				<div class="thegraphs_wrap">
					<h3> Historical Data Per Industry per year</h3>
					<canvas id="historical_per_industry"></canvas>
				</div>
				<!-- <div class="">
					<h3> Historical Data Per Industry per year</h3>
					<canvas id=""></canvas>
				</div> -->
			</div>
			<div class="per_commo" style="padding: 0px 20px;">
				<div class="thegraphs_wrap">
					<h3 id='per_commo_cap'> &nbsp; </h3>
					<canvas id="per_commo_graph"></canvas>
				</div>
				<div class="thegraphs_wrap">
					<h3 id='per_commo_cap'> Places of Operation </h3>
					<ul> 
						<li>  </li>
					</ul>
				</div>
			</div>
		</div>

		<script>
			var big_lat_lng = null;
			var big_lat 	= null;
			var big_lng 	= null;

			// https://api.mapbox.com/tilesets/v1/sources/{username}/{id}
			// https://tile.openstreetmap.org/{z}/{x}/{y}.png
			// mapbox://styles/alvinmerto/clxvo8ecc00w501r22nwz74ob
			// outdoors-v9
			// 

			var adb = L.icon({
				    iconUrl: "{{asset('images/adb.png')}}",
				    shadowUrl: 'leaf-shadow.png',

				    iconSize:     [38, 95], // size of the icon
				    shadowSize:   [50, 64], // size of the shadow
				    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
				    shadowAnchor: [4, 62],  // the same for the shadow
				    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
				});

			var map = L.map('map').setView([7.941825906384453, 124.49841490156703], 8);
				L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWx2aW5tZXJ0byIsImEiOiJjazM3MjBobDEwN3ZvM21wemx6aG5tNHlqIn0.ch2yPYUkeOn1ih6nbfAm1A', {
				    maxZoom: 19,
				    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
				}).addTo(map);

			var marker;

			function get_invs() {
				var ls = $(document).find("#leftsidediv");

				ls.animate({
					width: "400"+"px"
				},300);

				var ts   = $(document).find(".topsidediv");
				
				ts.animate({
					"margin-left":"410"+"px",
					"width":"75"+"%"
				},300);

				// console.log(big_lat+"-"+big_lng);
				
				$.ajax({
					url 	 : url+"/project_details",
					type     : "get",
					data     : { lat : big_lat , lng : big_lng},
					dataType : "json",
					success  : function(data) {
						console.log(big_lat+"_"+big_lng);
						console.log(data);
						$(document).find("#the_proj_title").text( data[0].projecttitle );
						$(document).find("#the_donor").text( data[0].projectdonortext );
						$(document).find("#the_funder").text( data[0].projectdonortext );
						$(document).find("#the_desc").text( data[0].projectdesc );
						$(document).find("#the_sector").text( data[0].sector );
						$(document).find("#the_loc").text( data[0].projectlocationtext );
						$(document).find("#prop_amount").text( data[0].proposedprojectcost );
						$(document).find("#asst_amount").text( data[0].amount );
						$(document).find("#currency").text( data[0].currency );
						$(document).find("#ta_type").text( data[0].typeofamount );
						$(document).find("#proj_status").text( data[0].projectstatus );
						$(document).find("#the_updates").text( data[0].recentupdate );
					}, error : function(data) {
						alert(error);
					}
				});

			}

			function get_points(sector, funder) {
				 // var latlngs = [
				// 	    [45.51, -122.68],
				// 	    [37.77, -122.43],
				// 	    [34.04, -118.2]
				// 	];

				// 	var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

				// 	// zoom the map to the polyline
				// 	map.fitBounds(polyline.getBounds());

				$.ajax({
					url : url+"/theareas",
					type : "post",
					data : { sector : sector , funder : funder },
					dataType: "json",
					success : function(data) {
						var dd = [
								{"type": "Feature",
								 "geometry": {
									"type": "MultiPoint",
									"coordinates":data
								  },
								"properties": {
								    "name": "Mindanao Maps"
								  } 
								}
								];

						marker = L.geoJSON(dd, {
									    style: function (feature) {
									        return {color: feature.properties.color};
									    },
									    icon : adb,
									    onEachFeature : function(feature, layer) {
									    	layer.on("click", function(layer) {
									    		var lat = layer.latlng.lat;
									    		var lng = layer.latlng.lng;

									    		big_lat = lat;
									    		big_lng = lng;

									    		map.setView([lat, lng], 11);

									    		big_lat_lng = lat+"_"+lng;

									    		// get the list of areas with investments here and plot
									    		get_invs();
									    		// create_charts();
									    	});
									    },

									}).addTo(map);

					}, error : function () {
						alert("error")
					}
				})
			}

			$.ajax({
				url 	 : url+"/the_sectors",
				type     : "get",
				data     : {},
				dataType : "json",
				success  : function(data) {
					// the_sectors
					$("<option value='all'>All</option>").appendTo("#the_sectors");
					for(var i = 0; i <= data.length-1; i++) {
						$("<option value='"+data[i]+"'>"+data[i]+"</option>").appendTo("#the_sectors");
					}
				}, error : function(error) {
					alert(error);
				}
			})

			$.ajax({
				url 	 : url+"/the_funder",
				type 	 : "get",
				dataType : "json",
				success  : function(data) {
					$("<option value='all'>All</option>").appendTo("#the_funders");
					for(var i = 0; i <= data.length-1; i++) {
						$("<option value='"+data[i]+"'>"+data[i]+"</option>").appendTo("#the_funders");
					}
				}, error : function(error) {
					alert(error);
				}
			})

			$(document).on("click","#the_invs li", function(){
				// create_chart_per_commo( $(this).data("text") );
			});

			
			// $(document).on("click",'#thefilter', function(){
			$(document).on("change",'#the_sectors', function(){
				var sector = $(document).find("#the_sectors").val();
				// var funder = $(document).find("#the_funders").val();
				var funder = $(document).find(".selected_top").text();

				marker.clearLayers();

				map.setView([7.941825906384453, 124.49841490156703], 8);

				var ls = $(document).find("#leftsidediv");

				ls.animate({
					width: "0"+"px"
				},300);


				if (funder.trim() == "all" || funder.trim().length == 0) {
					funder = "false";
				}
	

				if (sector.trim("") == "all") {
					sector = "false";
				}
				
				get_points(sector, funder);
			});

			$(document).on("click","#the_sectors_top li", function(){
				var funder = $(this).text();
				var sector = $(document).find("#the_sectors").val();

				marker.clearLayers();

				map.setView([7.941825906384453, 124.49841490156703], 8);

				var ls = $(document).find("#leftsidediv");

				ls.animate({
					width: "0"+"px"
				},300);

				if (funder.trim("") == "all") {
					funder = "false";
				}

				if (sector.trim("") == "all") {
					sector = "false";
				}

				var ts   = $(document).find(".topsidediv");
				
				ts.animate({
					"margin-left":"55"+"px",
					"width":"100"+"%"
				},300);

				get_points(sector, funder);

				// selected_top

				$(this).addClass("selected_top").siblings().removeClass("selected_top");

			});

			$(document).on("click","#refreshbtn", function(){
				window.location.reload();
			});
				
			$(document).ready(function(){
				get_points("false", "false");
			});
			
		</script>

		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<script>

			function create_chart_per_commo(e) {
				$(document).find("#general_info").hide("slow");
				$(document).find(".per_commo").show("slow");

				const ctx = document.getElementById('per_commo_graph');

				$(document).find("#per_commo_cap").text( e );

				$.ajax({
					type 	 : "get",
					url  	 : url+"/specific_commo_data",
					data 	 : { },
					dataType : "json",
					success  : function(data) {
						new Chart(ctx, {
						    type: 'line',
						    data: {
						      labels: ['2020','2021','2022','2023','2024'],
						      datasets: [{
						        label: 'Historical Gross income per year',
						        data: data,
						        borderWidth: 1,
						        pointStyle: 'circle',
						        pointRadius: 10,
	      						pointHoverRadius: 15
						      }]
						    },
						    options: {
						      scales: {
						        y: {
						          beginAtZero: true
						        }
						      }
						    }
						});
					}, error : function(error) {
						alert(error);
					}
				})
			}

			function create_charts() {
			  $(document).find("#general_info").show("slow");
			  $(document).find(".per_commo").hide("slow");

			  var rs = $(document).find("#right_side");

			  // rs.animate({
			  // 	width:"430"+"px"
			  // },300);

			  const ctx = document.getElementById('distribution_per_industry');
			  const hpi = document.getElementById('historical_per_industry');

			  $.ajax({
			  	type 	 : "get",
			  	url  	 : url+"/getyields",
			  	dataType : "json",
			  	success  : function(data) {
					  new Chart(ctx, {
					    type: 'bar',
					    data: {
					      labels: data['industrykeys'],
					      datasets: [{
					        label: 'All time gross',
					        data: data['industrydistribution'],
					        borderWidth: 1
					      }]
					    },
					    options: {
					      scales: {
					        y: {
					          beginAtZero: true
					        },
					      }
					    }
					  });

					  new Chart(hpi, {
					    type: 'line',
					    data: {
					      labels: ['2020','2021','2022','2023','2024'],
					      datasets: data['perindustryperyear']
					    },
					    options: {
					      scales: {
						      y: {
						        type: 'linear',
						        display: true,
						        position: 'left',
						      },
					    	}
					    }
					  });
			 	 }, error : function(error) {
			 	 	alert(error);
			 	 }
			  });
			}

			var margin = 0;

			$(document).on("click",".action_btn", function(){
				var btn = $(this).data('btn');

				var slider = $(document).find("#theslider");
				var len    = slider.children().length-1;

				var max_len = (404*len);

				if (btn == "prev") {
					margin = parseInt(margin)+404;
				} else if (btn == "next") {
					margin = parseInt(margin)-404;
				};
		
				if (margin == "-1212") {
					margin = 0;
				} else if (margin >= 404) {
					margin = "-"+max_len;
				}

				slider.animate({
					"margin-left":margin+"px"
				});
			});

			$(document).on("click","#the_info_nav li", function(){
				// the_project
				// the_donor_div

				var the_tab = $(this).data("the_tab");

				$(this).siblings().hide();
				// $(this).
			});


		</script>
	</body>
</html>