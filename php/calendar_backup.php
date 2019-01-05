<?php
// include ('Location: /my_calendar/index.php');//redirecting to calendar.php

function print_data($db, $from, $to){
  echo  "<html id='all_data'>";
  echo  "  <head>";
  echo  "    <style>";
  echo  "      .error{";
  echo  "        color: red;";
  echo  "      }";
  echo  "    </style>";
  echo  "    <title>My Calendar</title>";
  echo  '    <script src="/my_calendar/js/jquery.min.js"></script>';
  echo  '    <script src="/my_calendar/js/validate.min.js"></script>';
  echo  '    <script src="/my_calendar/js/moment-with-locales.js"></script>';
  echo  '    <script src="/my_calendar/js/bootstrap.min.js"></script>';
  echo  '    <script src="/my_calendar/js/bootstrap-datetimepicker.js"></script>';
  echo  '    <link href="/my_calendar/css/bootstrap.min.css" rel="stylesheet"/>';
  echo  '    <link href="/my_calendar/css/bootstrap-datetimepicker.css" rel="stylesheet"/>';
  echo  '  </head>';
  echo  '  <body>';
  echo  '    <header>';
  echo  '      <h1>My Calendar</h1>';
  echo  '    </header>';
  echo  '    <main>';
  echo  '      <div>';

  $events_list = fetch_events($db,$from,$to);//codes to display events in db..(sending the connection to function fetch_events in db_ops)

echo  "<a href='' id='add_event' data-toggle='modal' data-target='#myModal'>Add Event</a>";
echo  "<form action='' id='' class='' method='POST'>";
echo  "<div class='form-group'>";
echo  "From Date: <input type='text' value='".$from."' placeholder='From Date' class='' class='datetimepicker' name='from_date' id='from_date'>";
echo  "To Date: <input type='text' value='".$to."' placeholder='To Date' class='' class='datetimepicker' name='to_date' id='to_date'>";
echo  "<input type='submit' id='go' name='go' class='btn btn-default btn-primary' value='Go'>";
echo  "</div>";
echo  "</form>";
echo  '<table>';
echo  '  <tbody>';
echo  '    <tr>';
echo  '      <th>Si No.</th><th>Date Of The Event</th><th>Event Name</th><th>Event Description</th><th>Comments</th>';
echo  '  </tr>';

// print_r($events_list);exit;
$i = 1; // to print srial numbers of eveents
foreach ($events_list as $key => $value) {//to print the events
  $now = strtotime("now");
  if($value['strtime'] < $now){
    $disabled = 'disabled';
  }else{
    $disabled = '';
  }
  $value['event_date'] = date_format(new DateTime($value['event_date']), 'D M j,Y H:i');
  echo  "    <tr>";
  echo  "     <td> ".$i."</td><td>".$value['event_date']."</td><td>".$value['event_name']."</td><td>".$value['event_description']."</td><td>".$value['comments']."</td>";
  echo  "     <td><button ".$disabled." href='' data-toggle='modal' data-target='#myModal' class='update_event btn btn-default btn-primary' event_date='".$value['event_date']."' event_name='".$value['event_name']."' event_description='".$value['event_description']."' comments='".$value['comments']."' value=".$value['si_no'].">Update</button></td>";
  echo  "      <td><form action='' class='' method='post'><input type='hidden' name='delete_field' value=".$value['si_no']."><input ".$disabled." type='submit' id='' name='delete_submit' class='btn btn-default btn-danger' value='Delete'></form></td>";
  echo  "    </tr>";
  $i++;
}
echo  " </tbody>";
echo  "</table>";
echo  "<div id='myModal' class='modal fade' role='dialog'>";
echo  "<div class='modal-dialog'>";
echo  "<div class='modal-content'>";
echo  "<div class='modal-header'>";
echo  "<h4 class='modal-title'>Add Event</h4>";
echo  "<a href='' class='close' data-dismiss='modal'>&times;</a>";
echo  "</div>";
echo  "<div class='modal-body'>";
echo  "<form action='' id='ModalForm' class='' method='POST'>";
echo  "<input type='hidden' value='' placeholder='' class='form-control' class='si_no' name='si_no' id='si_no'>";
echo  "<div class='form-group'>";
echo  "<input type='text' value='' required placeholder='Event Date' class='form-control' class='datetimepicker' name='event_date' id='event_date'>";
echo  "</div>";
echo  "<div class='form-group'>";
echo  "<input type='text' value='' required placeholder='Event Name' name='event_name' class='form-control' id='event_name'>";
echo  "</div>";
echo  "<div class='form-group'>";
echo  "<textarea class='form-control' value='' placeholder='Event Description' rows='5' name='event_description' id='event_description'></textarea>";
echo  "</div>";
echo  "<div class='form-group'>";
echo  "<textarea class='form-control' value='' placeholder='Comments' rows='5' name='comments' id='comments'></textarea>";
echo  "</div>";
echo  "</div>";
echo  "<div class='modal-footer'>";
echo  "<button type='button' id='cancel' class='btn btn-default btn-danger' data-dismiss='modal'>Cancel</button>";
echo  "<input type='submit' id='submit' name='submit' class='btn btn-default btn-primary' value=''>";
echo  "</div>";
echo  "</form>";
echo  "</div>";
echo  "</div>";
echo  "</div>";
// echo 'check';exit;

echo '<script>';
// echo '  $("#all_data").html("'.$data.'"); ';
echo " function formatDate(date) { ";
echo '   var d = new Date(date),';
echo "       month = '' + (d.getMonth() + 1),";
echo "         day = '' + d.getDate(),";
echo "       year = d.getFullYear();";
echo "       hours = '' + d.getHours();";
echo "       minutes = '' + d.getMinutes();";
echo "   if (month.length < 2) {month = '0' + month;}";
echo "   if (day.length < 2) {day = '0' + day;}";
echo "   if (hours.length < 2) {hours = '0' + hours;}";
echo "   if (minutes.length < 2) {minutes = '0' + minutes;}";

echo "    var final_date = [year, month, day].join('-')+' '+ [hours, minutes].join(':');";
echo "    return final_date;";
echo "  }";
echo " $('#Modal').modal('hide');";//hide the modal initially
echo " $('#add_event').on('click', function(){";//if add event is clicked
echo "   $('#ModalForm').trigger('reset');";//reset the form when clicked
echo "   $('#Modal').modal('show');";//and then show the modal
echo "   $('#submit').val('Add');";//show the submit button
echo " });";
echo " $('.update_event').on('click', function(){";//if add event is clicked

echo "    $('#Modal').modal('show');";//and then show the modal
echo "    $('#event_date').val(formatDate($(this).attr('event_date')));";//assign respective event date to the inout field
echo "    $('#si_no').val($(this).attr('value'));";//assign respective event id to the inout field
echo "    $('#event_name').val($(this).attr('event_name'));";//assign respective event name to the inout field
echo "    $('#event_description').val($(this).attr('event_description'));";////assign respective event description to the inout field
echo "    $('#comments').val($(this).attr('comments'));";////assign respective comments to the inout field
echo "    $('#submit').val('Update');";//hide the update button
echo "  });";

echo "  $(function(){";//function to validate the modal
echo "    $('#ModalForm').validate({";
   // alert();
echo "      rules: {";
echo "        event_date: {";
echo "          required: true,";//condition for the event_date to be required
echo "        },";
echo "        event_name: 'required'";//condition for the event_name to be required
echo "      },";
echo "      messages: {";
echo "        event_date: {";
echo "          required: 'Please enter Event Date',";
echo "        },";
echo "        event_name: 'Please enter Event Name'";
echo "      },";
echo "      highlight: function (element) {";
echo "          $(element).parent().addClass('error')";//to highlight the the fields if not entered
echo "      },";
echo "      unhighlight: function (element) {";
echo "          $(element).parent().removeClass('error')";
echo "      }";
echo "    });";
echo "  });";
echo "  $('#event_date').datetimepicker({";//assigning the datetimepicker function to the event_date field
echo "    format : 'YYYY-MM-DD HH:mm',";
echo "    minDate: moment()";
echo "  });";
echo "  </script>";
// $("#from_date").datetimepicker({//assigning the datetimepicker function to the event_date field
//   format : 'YYYY-MM-DD',
//   minDate: moment()
// });
// $("#to_date").datetimepicker({//assigning the datetimepicker function to the event_date field
//   format : 'YYYY-MM-DD',
//   minDate: moment()
// });
// return true;
echo  "</div>";
echo  " </main>";
echo  "</body>";
echo  "</html>";
}
?>
