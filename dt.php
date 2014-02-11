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
//$( "#datepicker" ).datepicker();
});

</script>
</head>
<body>
<p>Date: <input type="text" id="datepicker"></p>
<input type="button" value="close" id="me"/>
</body>
</html>


<script type="text/javascript">
// Maintain array of dates
var dates = new Array();
function addDate(date) {if (jQuery.inArray(date, dates) < 0) dates.push(date);}
function removeDate(index) {dates.splice(index, 1);}

// Adds a date if we don't have it yet, else remove it
function addOrRemoveDate(date)
{
  var index = jQuery.inArray(date, dates); 
  if (index >= 0)
    removeDate(index);
  else 
    addDate(date);
}

// Takes a 1-digit number and inserts a zero before it
function padNumber(number)
{
  var ret = new String(number);
  if (ret.length == 1)
    ret = "0" + ret;
  return ret;
}

jQuery(function() {
jQuery("#datepicker").datepicker(
	{onSelect: function(dateText, inst) { addOrRemoveDate(dateText);  $(this).data('datepicker').inline = true; },
                              beforeShowDay: function (date){
                                var year = date.getFullYear();
                                // months and days are inserted into the array in the form, e.g "01/01/2009", but here the format is "1/1/2009"
                                var month = padNumber(date.getMonth() + 1);
                                var day = padNumber(date.getDate());
                                // This depends on the datepicker's date format
                                var dateString = month + "/" + day + "/" + year;
                                console.log(dates);

                                var gotDate = jQuery.inArray(dateString, dates);
                                if (gotDate >= 0) {
                                  // Enable date so it can be deselected. Set style to be highlighted
                                  return [true,"ui-state-highlight"]; 
                                }
                                // Dates not in the array are left enabled, but with no extra style
                                return [true, ""];
                              }
                        });
});
jQuery("#me").click(function(){
	$("#datepicker").data('datepicker').inline = false;

});

</script>