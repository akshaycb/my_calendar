<?php
// include ('Location: /my_calendar/index.php');//redirecting to calendar.php

function print_data($db, $from, $to){
  echo  "<html id='all_data'>";
  echo  "  <head>";
  echo  "    <style>";
  echo  "      .error{";
  echo  "        color: red;";
  echo  "      }";
  echo  "       header{";
  echo  "         text-align: center;";
  echo  "         min-height: 100px;";
  echo  "         background-color: gray;";
  echo  "       }";
  echo  "       .heading{";
  // echo  "         margin-top: 10%; ";
  echo  "         vertical-align: middle;";
  echo  "       }";
  echo  "       .add_event_button{";
  echo  "         min-height: 50px; margin:1%;";
  echo  "       }";
  echo  "       .row-striped:nth-of-type(odd){";
  echo  "         background-color: #efefef;";
  echo  "         border: 2px #000000 solid;";
  echo  "       }";
  echo  "       .row-striped:nth-of-type(even){";
  echo  "         background-color: #ffffff;";
  echo  "         border-left: 4px #efefef solid;";
  echo  "       }";
  echo  "       .row-striped {";
  echo  "           padding: 15px 0;";
  echo  "       }";
  echo  "    </style>";
  echo  "    <title>My Calendar</title>";
  echo  '    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">';
  echo  '    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>';
  echo  '    <script src="/my_calendar/js/jquery.min.js"></script>';
  echo  '    <script src="/my_calendar/js/validate.min.js"></script>';
  echo  '    <script src="/my_calendar/js/moment-with-locales.js"></script>';
  echo  '    <script src="/my_calendar/js/bootstrap.min.js"></script>';
  echo  '    <script src="/my_calendar/js/bootstrap-datetimepicker.js"></script>';
  echo  '    <link href="/my_calendar/css/bootstrap.min.css" rel="stylesheet"/>';
  echo  '    <link href="/my_calendar/css/bootstrap-datetimepicker.css" rel="stylesheet"/>';
  echo  '    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">';
  echo  '  </head>';
  echo  '  <body>';
  echo  '    <header>';
  echo  '      <h1><div class="heading"><b>My Calendar</b></div></h1>';
  echo  '    </header>';
  echo  '    <main>';
  echo  '      <div class="container">';

  $events_list = fetch_events($db,$from,$to);//codes to display events in db..(sending the connection to function fetch_events in db_ops)

echo  "<div class='add_event_button'><a href='' id='add_event' data-toggle='modal' data-target='#myModal'><button class='btn btn-default btn-primary'>Add Event</button></a></div>";
echo  "<form action='' id='' class='' method='POST'>";
echo  " <div class='form-group col-md-3' style='position: relative'>";
echo  "   <b>From Date: </b><input type='text' value='".$from."' placeholder='From Date' class='' class='datetimepicker' name='from_date' id='from_date'>";
echo  " </div>";
echo  " <div class='form-group col-md-3' style='position: relative'>";
echo  "   <b>To Date: </b><input type='text' value='".$to."' placeholder='To Date' class='' class='datetimepicker' name='to_date' id='to_date'>";
echo  " </div>";
echo  " <div class='form-group col-md-2' style='position: relative'>";
echo  "   <input type='submit' id='go' name='go' class='btn btn-default btn-primary' value='Go'>";
echo  " </div>";
echo  "</form>";
echo  " </div>";
echo '  <script>';
echo "  $('#from_date').datetimepicker({";//assigning the datetimepicker function to the event_date field
echo "  format : 'YYYY-MM-DD'";
echo "  });";
echo "  $('#to_date').datetimepicker({";//assigning the datetimepicker function to the event_date field
echo "    format : 'YYYY-MM-DD'";
echo "  });";
echo '  </script>';


// echo '<div class="container">';
// echo '  <div class="row row-striped">';
// echo '    <div class="col-4 text-right">';
// echo '      <h1 class="display-4"><span class="badge badge-secondary"><i class="fa fa-calendar-o" aria-hidden="true"></i> date</span></h1>';
// echo '      <h2></h2>';
// echo '    </div>';
// echo '    <div class="col-8">';
// echo '      <h3 class="text-uppercase"><strong>name</strong></h3>';
// echo '      <ul class="list-inline">';
// echo '      </ul>';
// echo '      <p>description.</p>';
// echo '      <p>comments.</p>';
// echo "      <p><button  href='' data-toggle='modal' data-target='#myModal' class='update_event btn btn-default btn-primary'>Update</button></p>";
// echo "      <p><form action='' class='' method='post'><input type='hidden' name='delete_field' type='submit' id='' name='delete_submit' class='btn btn-default btn-danger' value='Delete'></form></p>";
// echo '    </div>';
// echo '  </div>';
// echo '</div>';

$i = 1; // to print srial numbers of eveents
// print_r($events_list);
if($events_list == false){
  echo '<div class="container">';
  echo '  <div class="row row-striped" >';
  echo '    <div style="text-align:center; vertical-align: middle; line-height: 90px; vertical-align: middle; margin: auto;">';
  echo '      No events in this date range';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';
}else{
  foreach ($events_list as $key => $value) {//to print the events
    $now = strtotime("now");
    if($value['strtime'] < $now){
      $disabled = 'disabled';
    }else{
      $disabled = '';
    }
    $value['event_date'] = date_format(new DateTime($value['event_date']), 'D M j , Y H:i');
    echo '<div class="container">';
    echo '  <div class="row row-striped">';
    echo '    <div class="col-3 text-right">';
    echo '      <h1 class="display-4"><span class="badge badge-secondary"><i class="fa fa-calendar-o" aria-hidden="true"></i> '.$value["event_date"].'</span></h1>';
    echo '      <h2></h2>';
    echo '    </div>';
    echo '    <div class="col-8">';
    echo '      <h4 class="text-uppercase"><strong>'.$value["event_name"].'</strong></h4>';
    // echo '      <ul class="list-inline">';
    // echo '      </ul>';
    echo '      <p>'.$value["event_description"].'.</p>';
    echo '      <p>'.$value["comments"].'.</p>';
    echo "      <p><button ".$disabled." href='' data-toggle='modal' data-target='#myModal' class='update_event btn btn-default btn-primary' event_date='".$value['event_date']."' event_name='".$value['event_name']."' event_description='".$value['event_description']."' comments='".$value['comments']."' value=".$value['si_no'].">Update</button></p>";
    echo "      <p><form action='' class='' method='post'><input type='hidden' name='delete_field' value=".$value['si_no']."><input ".$disabled." type='submit' id='' name='delete_submit' class='btn btn-default btn-danger' value='Delete'></form></p>";
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
    $i++;
  }
  // echo  "    <tr>";
  // echo  "     <td> ".$i."</td><td>".$value['event_date']."</td><td>".$value['event_name']."</td><td>".$value['event_description']."</td><td>".$value['comments']."</td>";
  // echo  "     <td><button ".$disabled." href='' data-toggle='modal' data-target='#myModal' class='update_event btn btn-default btn-primary' event_date='".$value['event_date']."' event_name='".$value['event_name']."' event_description='".$value['event_description']."' comments='".$value['comments']."' value=".$value['si_no'].">Update</button></td>";
  // echo  "      <td><form action='' class='' method='post'><input type='hidden' name='delete_field' value=".$value['si_no']."><input ".$disabled." type='submit' id='' name='delete_submit' class='btn btn-default btn-danger' value='Delete'></form></td>";
  // echo  "    </tr>";
}

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
echo "  $('#event_date').datetimepicker({";//assigning the datetimepicker function to the event_date field
echo "    format : 'YYYY-MM-DD HH:mm',";
echo "    minDate: moment()";
echo "  });";
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
echo "  </script>";
echo  '</div>';
echo  " </main>";
echo  "</body>";
echo  "</html>";
}
?>
