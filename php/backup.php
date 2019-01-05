<?php


 ?>







       <head>
         <style>
           .error{
             color: red;
           }
         </style>
         <title>My Calendar</title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
         <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
         <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
       </head>























       <html>
         <head>
           <style>
             .error{
               color: red;
             }
           </style>
           <title>My Calendar</title>
           <script src="/my_calendar/js/jquery.min.js"></script>
           <script src="/my_calendar/js/validate.min.js"></script>
           <script src="/my_calendar/js/moment-with-locales.js"></script>
           <script src="/my_calendar/js/bootstrap.min.js"></script>
           <script src="/my_calendar/js/bootstrap-datetimepicker.js"></script>
           <link href="/my_calendar/css/bootstrap.min.css" rel="stylesheet"/>
           <link href="/my_calendar/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
         </head>
         <body>
           <header>
             <h1>My Calendar</h1>
           </header>
           <main>
             <a href="" id="add_event" data-toggle="modal" data-target="#myModal">Add Event</a>
         <?php
         // session_start();
         include($_SERVER['DOCUMENT_ROOT'].'/my_calendar/config.php');//include config.php for db connection
         include ('db_ops.php');//include db_ops.php for db operations
         ini_set('display_errors', 1);//to display all the errors
         ini_set('display_startup_errors', 1);
         error_reporting(E_ALL & ~E_NOTICE);
         echo '<table>
                <tbody>
                  <tr>
                   <th>Si No.</th><th>Date Of The Event</th><th>Event Name</th><th>Event Description</th><th>Comments</th>
                   </tr>';
         $events_list = fetch_events($db);//codes to display events in db..(sending the connection to function fetch_events in db_ops)
         $i = 1; // to print srial numbers of eveents
         foreach ($events_list as $key => $value) {//to print the events
           $now = strtotime("now");
           if($value['strtime'] < $now){
             $disabled = 'disabled';
           }else{
             $disabled = '';
           }
           $value['event_date'] = date_format(new DateTime($value['event_date']), 'D M j,Y H:i');
           echo "    <tr>";
           echo "     <td> ".$i."</td><td>".$value['event_date']."</td><td>".$value['event_name']."</td><td>".$value['event_description']."</td><td>".$value['comments']."</td><td><button ".$disabled." href='' data-toggle='modal' data-target='#myModal' class='update_event btn btn-default btn-primary' event_date='".$value['event_date']."' event_name='".$value['event_name']."' event_description='".$value['event_description']."' comments='".$value['comments']."' value=".$value['si_no'].">Update</button></td><td><form action='' class='' method='post'><input type='hidden' name='delete_field' value=".$value['si_no']."><input ".$disabled." type='submit' id='' name='delete_submit' class='btn btn-default btn-danger' value='Delete'></form></td>";
           echo "    </tr>";
           $i++;
        }
        echo " </tbody>";
        echo "</table>";
        echo "";
        if($_POST){//condition if the form is submitted by post method
          // print_r($_POST);exit;
          if($_POST['submit'] == 'Add'){
            $message = add_event($db,$_POST);//send the values to add_event function in db_ops
            if($message == true){//if the query successfully executed
              echo "<script>alert('Event Added Successfully');</script>";
              echo("<meta http-equiv='refresh' content='1'>");
            }else if($message == false) {//if there was any problem executing the query
              echo "<script>alert('Event Not Added');</script>";
            }
          }else if($_POST['submit'] == 'Update'){
            $message = update_event($db,$_POST);//send the values to update_event function in db_ops
            if($message == true){//if the query successfully executed
              echo "<script>alert('Event Updated Successfully');</script>";
              echo("<meta http-equiv='refresh' content='1'>");
            }else if($message == false) {//if there was any problem executing the query
              echo "<script>alert('Event Not Updated');</script>";
            }
          }else if($_POST['delete_submit'] == 'Delete'){
            $message = delete_event($db,$_POST['delete_field']);//send the values to update_event function in db_ops
            if($message == true){//if the query successfully executed
              echo "<script>alert('Event Deleted Successfully');</script>";
              echo("<meta http-equiv='refresh' content='1'>");
            }else if($message == false) {//if there was any problem executing the query
              echo "<script>alert('Event Not Deleted');</script>";
            }
          }

        };
        ?>
             <script>
             function formatDate(date) {
               var d = new Date(date),
                   month = '' + (d.getMonth() + 1),
                   day = '' + d.getDate(),
                   year = d.getFullYear();
                   hours = '' + d.getHours();
                   minutes = '' + d.getMinutes();

               if (month.length < 2) {month = '0' + month;}
               if (day.length < 2) {day = '0' + day;}
               if (hours.length < 2) {hours = '0' + hours;}
               if (minutes.length < 2) {minutes = '0' + minutes;}

               var final_date = [year, month, day].join('-')+' '+ [hours, minutes].join(':');
               return final_date;
             }
             $('#Modal').modal('hide');//hide the modal initially
             $('#add_event').on('click', function(){//if add event is clicked
               $("#ModalForm").trigger( "reset" );//reset the form when clicked
               $('#Modal').modal('show');//and then show the modal
               $('#submit').val('Add');//show the submit button
             });
             $('.update_event').on('click', function(){//if add event is clicked
               $('#Modal').modal('show');//and then show the modal
               $('#event_date').val(formatDate($(this).attr("event_date")));//assign respective event date to the inout field
               $('#si_no').val($(this).attr("value"));//assign respective event id to the inout field
               $('#event_name').val($(this).attr("event_name"));//assign respective event name to the inout field
               $('#event_description').val($(this).attr("event_description"));////assign respective event description to the inout field
               $('#comments').val($(this).attr("comments"));////assign respective comments to the inout field
               $('#submit').val('Update');//hide the update button
             });
             // $('#update').on('click', function(e){
             //   e.preventDefault();
             //   $.ajax({
             //     type: "POST",
             //     url: "db_ops.php",
             //     data: $(this).parent().serialize(), // changed
             //     success: function(data) {
             //       alert(data); // show response from the php script.
             //     }
             //   });
             // });

             $(function(){//function to validate the modal
               $('#ModalForm').validate({
                 rules: {
                   event_date: {
                     required: true,//condition for the event_date to be required
                   },
                   event_name: 'required'//condition for the event_name to be required
                 },
                 messages: {
                   event_date: {
                     required: 'Please enter Event Date',
                   },
                   event_name: 'Please enter Event Name'
                 },
                 highlight: function (element) {
                     $(element).parent().addClass('error')//to highlight the the fields if not entered
                 },
                 unhighlight: function (element) {
                     $(element).parent().removeClass('error')
                 }
               });
             });
             </script>

            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Event</h4>
                    <a href="" class="close" data-dismiss="modal">&times;</a>
                  </div>
                  <div class="modal-body">
                    <form action="" id="ModalForm" class="" method="post">
                      <input type="hidden" value="" placeholder="" class="form-control" class="si_no" name="si_no" id="si_no">
                      <div class="form-group">
                        <input type="text" value="" required placeholder="Event Date" class="form-control" class="datetimepicker" name="event_date" id="event_date">
                      </div>
                      <div class="form-group">
                        <input type="text" value="" required placeholder="Event Name" name="event_name" class="form-control" id="event_name">
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" value="" placeholder="Event Description" rows="5" name="event_description" id="event_description"></textarea>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" value="" placeholder="Comments" rows="5" name="comments" id="comments"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" id="cancel" class="btn btn-default btn-danger" data-dismiss="modal">Cancel</button>
                      <input type="submit" id="submit" name="submit" class="btn btn-default btn-primary" value="">
                    </div>
                  </form>
                </div>
              </div>
            </div>
           </main>
         </body>
         <script>
               $("#event_date").datetimepicker({//assigning the datetimepicker function to the event_date field
                 format : 'YYYY-MM-DD HH:mm',
                 minDate: moment()
               });
         </script>
       </html>
