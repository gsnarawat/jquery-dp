<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>

$(function() {
	    
        var datelist = [];
       var result = "10-01-2014,11-01-2014,15-01-2014,14-01-2014,17-01-2014,05-01-2014,06-01-2014,07-01-2014,08-01-2014,20-01-2014,21-01-2014,22-01-2014,23-01-2014,24-01-2014,25-01-2014,26-01-2014"; // dummy result
       datelist = result.split(",");
       $("#datepicker").datepicker({

       beforeShowDay: function(d) {
        // normalize the date for searching in array

        var dmy = "";
        dmy += ("00" + d.getDate()).slice(-2) + "-";
        dmy += ("00" + (d.getMonth() + 1)).slice(-2) + "-";
        dmy += d.getFullYear();
        if ($.inArray(dmy, datelist) >= 0) {
            return [true, ""];
        }
        else {
            return [false, ""];
        }
      },

       dateFormat:  "D M d yy"
    
  });
$("#alternate").click(function() {
            	$('#dates').slideUp();
            	$('#datepicker').slideDown();
	            $("#datepicker").focus();
	        });


    	$("#datepicker").change(function() {
    		$("#second").val($("#datepicker").val());
    		var date1 = $('#datepicker').datepicker('getDate', '+1d'); 
            for (var i=0;i<datelist.length;i++)
	        {
	    	date1.setDate(date1.getDate()+1);
	    	var dmy = "";
            dmy += ("00" + date1.getDate()).slice(-2) + "-";
            dmy += ("00" + (date1.getMonth() + 1)).slice(-2) + "-";
            dmy += date1.getFullYear();
            if ($.inArray(dmy, datelist) >= 0)
            break;
	    	
	        }
            
            var date2 = $('#datepicker').datepicker('getDate', '-1d'); 
            
            for (var i=0;i<datelist.length;i++)
	        {
	    	date2.setDate(date2.getDate()-1);
	    	var dmy = "";
            dmy += ("00" + date2.getDate()).slice(-2) + "-";
            dmy += ("00" + (date2.getMonth() + 1)).slice(-2) + "-";
            dmy += date2.getFullYear();
            if ($.inArray(dmy, datelist) >= 0)
            break;
	    	
	        }
            $("#third").val(date1.toDateString());
            $("#first").val(date2.toDateString());
            $('#dates').slideDown();
            $('#datepicker').slideUp();

    	});
    });
</script>


<script>
function myFun1()

{       var result = "10-01-2014,11-01-2014,15-01-2014,14-01-2014,17-01-2014,05-01-2014,06-01-2014,07-01-2014,08-01-2014,20-01-2014,21-01-2014,22-01-2014,23-01-2014,24-01-2014,25-01-2014,26-01-2014"; // dummy result 
	    var datelist = [];
	    datelist = result.split(",");
	    myval = document.getElementById("first").value;
	    var d2 = new Date(myval);
	    var d1 = new Date(myval);
	    var d3 = new Date(myval);
	    for (var i=0;i<datelist.length;i++)
	    {
	    	d1.setDate(d1.getDate()-1);
	    	var dmy = "";
            dmy += ("00" + d1.getDate()).slice(-2) + "-";
            dmy += ("00" + (d1.getMonth() + 1)).slice(-2) + "-";
            dmy += d1.getFullYear();
            if ($.inArray(dmy, datelist) >= 0)
            break;
	    	
	    }
        for (var i=0;i<datelist.length;i++)
	    {
	    	d3.setDate(d3.getDate()+1);
	    	var dmy = "";
            dmy += ("00" + d3.getDate()).slice(-2) + "-";
            dmy += ("00" + (d3.getMonth() + 1)).slice(-2) + "-";
            dmy += d3.getFullYear();
            if ($.inArray(dmy, datelist) >= 0)
            break;
	    	
	    }
	    
	    
	    $("#third").val(d3.toDateString());
	    $("#second").val(d2.toDateString());
        $("#first").val(d1.toDateString());

}
/*
function myFun2()
{       
	   myval = document.getElementById("second").value;
	    var d2 = new Date(myval);
	    var d1 = new Date(myval);
	    var d3 = new Date(myval);	    	    
	    d1.setDate(d1.getDate()-1);
	    d3.setDate(d3.getDate()+1);
	    $("#third").val(d3.toDateString());
	    $("#second").val(d2.toDateString());
        $("#first").val(d1.toDateString());

} */
function myFun3()
{       
	   var result = "10-01-2014,11-01-2014,15-01-2014,14-01-2014,17-01-2014,05-01-2014,06-01-2014,07-01-2014,08-01-2014,20-01-2014,21-01-2014,22-01-2014,23-01-2014,24-01-2014,25-01-2014,26-01-2014"; // dummy result 
	    var datelist = [];
	    datelist = result.split(",");
	   myval = document.getElementById("third").value;
	    var d2 = new Date(myval);
	    var d1 = new Date(myval);
	    var d3 = new Date(myval);	    	    
	    for (var i=0;i<datelist.length;i++)
	    {
	    	d1.setDate(d1.getDate()-1);
	    	var dmy = "";
            dmy += ("00" + d1.getDate()).slice(-2) + "-";
            dmy += ("00" + (d1.getMonth() + 1)).slice(-2) + "-";
            dmy += d1.getFullYear();
            if ($.inArray(dmy, datelist) >= 0)
            break;
	    	
	    }
        for (var i=0;i<datelist.length;i++)
	    {
	    	d3.setDate(d3.getDate()+1);
	    	var dmy = "";
            dmy += ("00" + d3.getDate()).slice(-2) + "-";
            dmy += ("00" + (d3.getMonth() + 1)).slice(-2) + "-";
            dmy += d3.getFullYear();
            if ($.inArray(dmy, datelist) >= 0)
            break;
	    	
	    }
	    $("#third").val(d3.toDateString());
	    $("#second").val(d2.toDateString());
        $("#first").val(d1.toDateString());

}
</script>

<script>
 jQuery(document).ready(function() {
  var a = new Date();
  var dd = a.toDateString();
  $("#second").val(dd);
  $("#first").val(dd);
  $("#third").val(dd);
  })

</script>
</head>
<body>
<div id="dates" style="margin: 150px 6px 0 200px;width: 300px;">
<input type="button" id="first" onClick="myFun1();" style="width: 220px;"/> <br/>
<input type="button"  id="second"  style="width: 220px; margin-top:25px;"/>   <br/>
<input type="button"  id="third" onClick="myFun3();" style="width: 220px; margin-top:25px;"/>   <br/>
</div>
<p> <div id="datepicker" style="margin: 150px 6px 0 200px;width: 300px;display:none;"></div></p>
<input type="button" id="alternate" value="See All Dates" style="margin: 16px 0 0 220px;width: 130px;"/>
</body>
</html>