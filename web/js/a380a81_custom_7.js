$(function(){var f="prod";var h="http://studiotagarin.fr/";var g=null;if(f=="dev"){g=h+"app_dev.php/"}else{if(f=="preprod"){g=h+"app.php/"}else{g=h}}$("#slider").nivoSlider({effect:"random",pauseOnHover:false,prevText:"Précédent",nextText:"Suivant",randomStart:true});$("a.fancy_grouped_elements").fancybox();var j=h+"bundles/jblstudio/images/gmap/sun.png";var c=h+"bundles/jblstudio/images/gmap/city.png";var e=new google.maps.LatLng(48.623509,-2.830755);var b=[{lat:48.622711,lng:-2.822349,icon:j,title:"Plage des Godelins (800m)",description:"La plage la plus proche du Studio. Vous pouvez y être en quelques minutes à pied."},{lat:48.636397,lng:-2.827306,icon:j,title:"Plage des Moulins (2km)",description:"L'autre plage d'Etables-Sur-Mer avec ses restaurants au bord du sable."},{lat:48.601403,lng:-2.824473,icon:c,title:"Binic (3km)",description:"Vous y trouverez de nombreux restaurants."},{lat:48.655147,lng:-2.837214,icon:c,title:"Saint-Quay-Portrieux (3km)",description:"Avec son casino et ses nombreuses plages."},{lat:48.627335,lng:-2.834988,icon:c,title:"Etables-Sur-Mer (700m)",description:"Le centre est à quelques minutes du studio."}];$("#googlemap").gmap3({action:"init",options:{streetViewControl:false,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU}}},{action:"addMarker",latLng:[48.623509,-2.830755],map:{center:true,zoom:13},marker:{options:{icon:h+"bundles/jblstudio/images/gmap/home.png"}},infowindow:{options:{content:"Le Studio Tagarin"}}});$("#googlelist").first("tr").click(function(){$("#googlemap").gmap3({action:"panTo",args:[e]})});$.each(b,function(l,k){d($("#googlemap"),k);i($("#googlemap"),$("#googlelist"),k)});function d(l,k){l.gmap3(({action:"addMarker",latLng:[k.lat,k.lng],marker:{options:{icon:k.icon},events:{click:function(m,n,o){a(this,m.getPosition().lat(),m.getPosition().lng())}}}}))}function a(l,m,k){l.gmap3({action:"clear",name:"directionrenderer"},{action:"getRoute",options:{origin:"48.623509,-2.830755",destination:m+", "+k,travelMode:google.maps.DirectionsTravelMode.DRIVING},callback:function(n){if(!n){return}$(this).gmap3({action:"addDirectionsRenderer",options:{markerOptions:{visible:false},preserveViewport:true,draggable:false,directions:n}})}})}function i(m,l,k){jQuery("<tr>",{html:'<td><img src="'+k.icon+'" alt="'+k.title+'" /></td><td><p class="title">'+k.title+'<p><p class="description">'+k.description+"</p></td>",click:function(){a(m,k.lat,k.lng)}}).appendTo(l)}$("#calendar").fullCalendar({editable:false,height:400,firstDay:6,events:{url:g+"week/jsonlist"}})});