<html>
<head>

   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style>
.wrapper {
   height: 600px;
}

#jrange input {
   width: 200px;
}

#jrange div {
   font-size: 9pt;
}

.date-range-selected > .ui-state-active,
.date-range-selected > .ui-state-default {
   background: none;
   background-color: lightsteelblue;
}
</style>
</head>
<body>

<div class="wrapper">
   <div id="jrange" class="dates">
    <input />
    <div></div>
   </div>
   <div>
      <p class="label"><label for="dates"> Available  Dates </label> </p>
                    <p> <div id="datepicker" style="width: 300px;"></div></p>
                    <?php
                    //$datesAvail = get_post_meta($thispost->ID, 'dates-available', true);
                    //$datesAvail = split(",", $datesAvail);
                    ?>
                    <p> Click on dates to select / deselect </p>
                    <input type="hidden" id="dates-available" name="dates-available" value=""/>
   </div>

</div>



<script>
jQuery(document).ready(function() {


        var dates = new Array();
        jQuery("#dates-available").val(dates);

        function addDate(date) {
            if (jQuery.inArray(date, dates) < 0)
                dates.push(date);
        }
        function removeDate(index) {
            dates.splice(index, 1);
        }

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
                    {dateFormat: "dd-mm-yy", minDate: 0, onSelect: function(dateText, inst) {
                            addOrRemoveDate(dateText);
                            jQuery("#dates-available").val(dates);                            
                        },
                        beforeShowDay: function(date) {
                            var year = date.getFullYear();
                            // months and days are inserted into the array in the form, e.g "01/01/2009", but here the format is "1/1/2009"
                            var month = padNumber(date.getMonth() + 1);
                            var day = padNumber(date.getDate());
                            // This depends on the datepicker's date format
                            var dateString = day + "-" + month + "-" + year;

                            var gotDate = jQuery.inArray(dateString, dates);
                            if (gotDate >= 0) {
                                // Enable date so it can be deselected. Set style to be highlighted
                                return [true, "ui-state-highlight"];
                            }
                            // Dates not in the array are left enabled, but with no extra style
                            return [true, ""];
                        }
                    });
        });
       

       
    });

$.datepicker._defaults.onAfterUpdate = null;

var datepicker__updateDatepicker = $.datepicker._updateDatepicker;
$.datepicker._updateDatepicker = function( inst ) {
   datepicker__updateDatepicker.call( this, inst );

   var onAfterUpdate = this._get(inst, 'onAfterUpdate');
   if (onAfterUpdate)
      onAfterUpdate.apply((inst.input ? inst.input[0] : null),
         [(inst.input ? inst.input.val() : ''), inst]);
}


$(function() {

   var cur = -1, prv = -1;
   $('#jrange div')
      .datepicker({
            //numberOfMonths: 3,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,

            beforeShowDay: function ( date ) {
                  return [true, ( (date.getTime() >= Math.min(prv, cur) && date.getTime() <= Math.max(prv, cur)) ? 'date-range-selected' : '')];
               },

            onSelect: function ( dateText, inst ) {
                  var d1, d2;

                  prv = cur;
                  cur = (new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay)).getTime();
                  if ( prv == -1 || prv == cur ) {
                     prv = cur;
                     $('#jrange input').val( dateText );
                  } else {
                     d1 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.min(prv,cur)), {} );
                     d2 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.max(prv,cur)), {} );
                     $('#jrange input').val( d1+' - '+d2 );
                  }
               },

            onChangeMonthYear: function ( year, month, inst ) {
                  //prv = cur = -1;
               },

            onAfterUpdate: function ( inst ) {
                  console.log("yepiiiiii");
                  $('<button type="button" class="ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all" data-handler="hide" data-event="click">Done</button>')
                     .appendTo($('#jrange div .ui-datepicker-buttonpane'))
                     .on('click', function () { $('#jrange div').hide(); });
               }
         })
      .position({
            my: 'left top',
            at: 'left bottom',
            of: $('#jrange input')
         })
      .hide();

   $('#jrange input').on('focus', function (e) {
         var v = this.value,
             d;

         try {
            if ( v.indexOf(' - ') > -1 ) {
               d = v.split(' - ');

               prv = $.datepicker.parseDate( 'mm/dd/yy', d[0] ).getTime();
               cur = $.datepicker.parseDate( 'mm/dd/yy', d[1] ).getTime();

            } else if ( v.length > 0 ) {
               prv = cur = $.datepicker.parseDate( 'mm/dd/yy', v ).getTime();
            }
         } catch ( e ) {
            cur = prv = -1;
         }

         if ( cur > -1 )
            $('#jrange div').datepicker('setDate', new Date(cur));

         $('#jrange div').datepicker('refresh').show();
      });

});

</script>
<!--
  <script type="text/javascript">


    jQuery.datepicker._defaults.onAfterUpdate = null;

    var datepicker__updateDatepicker = jQuery.datepicker._updateDatepicker;
    jQuery.datepicker._updateDatepicker = function(inst) {
        datepicker__updateDatepicker.call(this, inst);

        var onAfterUpdate = this._get(inst, 'onAfterUpdate');
        if (onAfterUpdate)
            onAfterUpdate.apply((inst.input ? inst.input[0] : null),
                    [(inst.input ? inst.input.val() : ''), inst]);
    }


    jQuery(function() {

        var cur = -1, prv = -1;
        jQuery('#jrange div')
                .datepicker({
            //numberOfMonths: 3,
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            minDate: 0,
            beforeShowDay: function(date) {
                return [true, ((date.getTime() >= Math.min(prv, cur) && date.getTime() <= Math.max(prv, cur)) ? 'date-range-selected' : '')];
            },
            onSelect: function(dateText, inst) {
                var d1, d2;

                prv = cur;
                cur = (new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay)).getTime();
                if (prv == -1 || prv == cur) {
                    prv = cur;
                    jQuery('#jrange input').val(dateText);
                } else {
                    d1 = jQuery.datepicker.formatDate('mm/dd/yy', new Date(Math.min(prv, cur)), {});
                    d2 = jQuery.datepicker.formatDate('mm/dd/yy', new Date(Math.max(prv, cur)), {});
                    jQuery('#jrange input').val(d1 + ' - ' + d2);
                    jQuery("#done").show();
                    var mdate1 = new Date(d1);
                    var mdate2 = new Date(d2);
                    var mday;
                    var mm = mdate1.getMonth() + 1;
                    var dd = mdate1.getDate();
                    var yy = mdate1.getFullYear();
                    var tp = dd + "-" + mm + "-" + yy;
                     dates = [tp];

                    while(mdate2 > mdate1) {
                        mday = mdate1.getDate()
                        mdate1 = new Date(mdate1.setDate(++mday));                         
                        var mm = mdate1.getMonth() + 1;
                        var dd = mdate1.getDate();
                        var yy = mdate1.getFullYear();
                        var mdate3 = dd + "-" + mm + "-" + yy;
                        dates.push(mdate3);
                    }
                    jQuery("#dates-available").val(dates);
                }
                
                
            },
            onChangeMonthYear: function(year, month, inst) {
                //prv = cur = -1;
            },
            onAfterUpdate: function(inst) {

                //jQuery('<button type="button" class="ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all" data-handler="hide" data-event="click">Done</button>')
                // .appendTo(jQuery('#jrange div .ui-datepicker-buttonpane'))
                //.on('click', function () { jQuery('#jrange div').hide(); });
            }
        })
                .position({
            my: 'left top',
            at: 'left bottom',
            of: jQuery('#jrange input')
        })
                .hide();

        jQuery('#jrange input').on('focus', function(e) {
            var v = this.value,
                    d;

            try {
                if (v.indexOf(' - ') > -1) {
                    d = v.split(' - ');

                    prv = jQuery.datepicker.parseDate('mm/dd/yy', d[0]).getTime();
                    cur = jQuery.datepicker.parseDate('mm/dd/yy', d[1]).getTime();

                } else if (v.length > 0) {
                    prv = cur = jQuery.datepicker.parseDate('mm/dd/yy', v).getTime();
                }
            } catch (e) {
                cur = prv = -1;
            }

            if (cur > -1)
                jQuery('#jrange div').datepicker('setDate', new Date(cur));

            jQuery('#jrange div').datepicker('refresh').show();
        });

    });
</script>
-->
</body>
</html>