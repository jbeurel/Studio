$(function(){var a="prod";var b="http://studiotagarin.fr/";var c=null;if(a=="dev"){c=b+"app_dev.php/"}else{if(a=="preprod"){c=b+"app.php/"}else{c=b}}$("table.sorted").tablesorter({sortList:[[0,0]]});$("#calendar").fullCalendar({monthNames:["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],monthNamesShort:["janv.","févr.","mars","avr.","mai","juin","juil.","août","sept.","oct.","nov.","déc."],dayNames:["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],dayNamesShort:["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],editable:false,height:400,firstDay:6,events:{url:c+"admin/week/jsonlistadmin"},dayClick:function(f,g,e,d){var h=0;$("#calendar").fullCalendar("clientEvents",function(i){if(i.start<=f&&i.end>=f){h++}});if(h>0){return}$("#add-validation").attr("href",$("#add-modal-href").text()+"/"+(f.getTime())/1000);$("#add-modal").modal({keyboard:true,backdrop:true,show:true})},eventClick:function(f,e,d){$("#reserve-validation").attr("href",$("#reserve-modal-href").text()+"/"+(f.start.getTime())/1000);$("#edit-validation").attr("href",$("#edit-modal-href").text()+"/"+(f.start.getTime())/1000);$("#del-validation").attr("href",$("#del-modal-href").text()+"/"+(f.start.getTime())/1000);$("#edit-modal").modal({keyboard:true,backdrop:true,show:true})}});if($("#dateTarget").length>0){$("#calendar").fullCalendar("gotoDate",$("#dateTargetYear").text(),$("#dateTargetMonth").text())}});