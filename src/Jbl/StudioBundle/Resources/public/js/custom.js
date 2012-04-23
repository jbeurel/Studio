$(function() {
	
	/**
	 * Configuration
	 * 
	 */
//	var environnement = 'dev';
	
//	var baseUrl = 'http://localhost/Studio/web/';
	
	var environnement = 'prod';
	
	var baseUrl = 'http://studiotagarin.fr/';
	
	/**fin de Configuration**************/
	
	/**
	 * Url
	 * 
	 */
	
	var baseUrlApp = null;
	
	if (environnement == 'dev') {
		baseUrlApp = baseUrl + 'app_dev.php/';
	} else if (environnement == 'preprod') {
		baseUrlApp = baseUrl + 'app.php/';
	} else {
		baseUrlApp = baseUrl;
	}
	
	/**
	 * Slider
	 * 
	 */
	
	$('#slider').nivoSlider({
		effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
		pauseOnHover: false, // Stop animation while hovering
		prevText: 'Précédent', // Prev directionNav text
        nextText: 'Suivant', // Next directionNav text
        randomStart: true // Start on a random slide
	});
	
	/**
	 * Fancybox
	 * 
	 */
	
	$("a.fancy_grouped_elements").fancybox();
	
	/**
	 * Gmap
	 * 
	 */
	
	var sunIcon = baseUrl + 'bundles/jblstudio/images/gmap/sun.png';
	var cityIcon = baseUrl + 'bundles/jblstudio/images/gmap/city.png';
	var houseLatLng = new google.maps.LatLng(48.623509,-2.830755);
	
	var markers = [
	                  {lat:48.622711, lng:-2.822349,icon:sunIcon,title:'Plage des Godelins (800m)', description: 'La plage la plus proche du Studio. Vous pouvez y être en quelques minutes à pied.'},
	                  {lat:48.636397,lng:-2.827306,icon:sunIcon,title:'Plage des Moulins (2km)', description: 'L\'autre plage d\'Etables-Sur-Mer avec ses restaurants au bord du sable.'},
	                  {lat:48.601403, lng:-2.824473,icon:cityIcon,title:'Binic (3km)', description: 'Vous y trouverez de nombreux restaurants.'},
	                  {lat:48.655147,lng:-2.837214,icon:cityIcon,title:'Saint-Quay-Portrieux (3km)', description:'Avec son casino et ses nombreuses plages.'},
	                  {lat:48.627335,lng:-2.834988,icon:cityIcon,title:'Etables-Sur-Mer (700m)', description:'Le centre est à quelques minutes du studio.'}
	                  ];
	
	$("#googlemap").gmap3(
		{
			action: 'init',
			options:{
			  streetViewControl: false,
			  mapTypeControlOptions: {
				  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
			  }
			}
		},
		{
			action:'addMarker',
			latLng:[48.623509,-2.830755],
			map:{
				center: true,
				zoom: 13
			},
			marker:{
				options:{
					icon: baseUrl + 'bundles/jblstudio/images/gmap/home.png'
				}
			},
			infowindow:{
				options:{
					content: 'Le Studio Tagarin'
				}
			}
		}
	);

	$("#googlelist").first('tr').click(function(){
		$("#googlemap").gmap3(
			{
				action:'panTo',
				args: [houseLatLng]
			}
		);
	})
	
	$.each(markers, function(i, marker) {
		displayMarkerOnMap($("#googlemap"), marker);
		displayMarkerOnList($("#googlemap"), $("#googlelist"), marker);
	});
	
	function displayMarkerOnMap(gmap, marker) {
		gmap.gmap3((
			{
				action:'addMarker',
				latLng:[marker.lat,marker.lng],
				marker:{
					options:{
						icon: marker.icon
					},
					events:{
						click: function(marker, event, data) {
							displayRouteOnMap(this, marker.getPosition().lat(), marker.getPosition().lng());
						}
					}
				}
			}
		));
	}
	
	function displayRouteOnMap(gmap, lat, lng) {
		gmap.gmap3(
			{
				action:'clear',
				name:'directionrenderer'
			},
			{ 
				action:'getRoute',
				options:{
					origin: '48.623509,-2.830755',
					destination: lat+', '+lng,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				},
				callback: function(results){
					
					if (!results) return;
					
					$(this).gmap3({ 
						action:'addDirectionsRenderer',
						options:{
							markerOptions:{
								visible: false
							},
							preserveViewport: true,
							draggable: false,
							directions:results
						}
					});
				}
			}
		);		
	}
	
	function displayMarkerOnList(gmap, list, marker) {
		jQuery('<tr>', {
			html: '<td><img src="'+ marker.icon +'" alt="'+ marker.title+'" /></td>'+
					'<td>'+
					'<p class="title">'+ marker.title+'<p>'+
					'<p class="description">'+ marker.description+'</p>'+
				'</td>', 
		    click: function() {
		    	displayRouteOnMap(gmap, marker.lat, marker.lng);
		    }
		}).appendTo(list);
	}
	
	/**
	 * FullCalendar
	 * 
	 */
	
	$('#calendar').fullCalendar({
		editable: false,
		height: 400,
		firstDay: 6,
	    events: {
	    	url: baseUrlApp + 'week/jsonlist'
	    }
	});
	
	
});