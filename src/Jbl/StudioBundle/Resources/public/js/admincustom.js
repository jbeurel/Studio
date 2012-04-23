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
	 * Table
	 * 
	 */
	
	$("table.sorted").tablesorter({ sortList: [[0,0]] });
	
	/**
	 * FullCalendar
	 * 
	 */
	
	$('#calendar').fullCalendar({
		monthNames:['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort:['janv.','févr.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
		editable: false,
		height: 400,
		firstDay: 6,
	    events: {
	    	url: baseUrlApp + 'admin/week/jsonlistadmin'
	    },
	    dayClick: function(date, allDay, jsEvent, view) {
	    	var eventCount = 0;
            $('#calendar').fullCalendar('clientEvents', function(event) {
            	if(event.start <= date && event.end >= date) {
                    eventCount++;
                }
            });
           
            if (eventCount > 0) return;
            
            $('#add-validation').attr("href", $('#add-modal-href').text() + "/" + (date.getTime())/1000);
            
            $('#add-modal').modal({
            	keyboard: true,
            	backdrop: true,
            	show: true
            });
	    },
	    eventClick: function(event, jsEvent, view) {
	    	
	    	$('#reserve-validation').attr("href", $('#reserve-modal-href').text() + "/" + (event.start.getTime())/1000);
	    	$('#edit-validation').attr("href", $('#edit-modal-href').text() + "/" + (event.start.getTime())/1000);
	    	$('#del-validation').attr("href", $('#del-modal-href').text() + "/" + (event.start.getTime())/1000);
	    	
	    	$('#edit-modal').modal({
            	keyboard: true,
            	backdrop: true,
            	show: true
            });
	    }
	});
	
	if ($("#dateTarget").length > 0) {
		$('#calendar').fullCalendar('gotoDate', $("#dateTargetYear").text() , $("#dateTargetMonth").text());
	}
	
	
});