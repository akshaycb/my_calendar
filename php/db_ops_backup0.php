<?php
include($_SERVER['DOCUMENT_ROOT'].'/my_calendar/config.php');//include config.php for db connection
include ('calendar.php');//include db_ops.php for db operations
if($_POST){//condition if the form is submitted by post method
  if ($_POST['go']) {
    echo "<script>$('#all_data').html('');</script>";
    print_data($db, $_POST['from_date'], $_POST['to_date']);
    exit;
  }elseif($_POST['submit'] == 'Add'){
    $message = add_event($db,$_POST);//send the values to add_event function in db_ops
    if($message == true){//if the query successfully executed
      echo "<script>alert('Event Added');</script>";
      echo "<script>$('#all_data').html('');</script>";
      header ('Location: /my_calendar/');//redirecting to calendar.php
    }elseif($message == false) {//if there was any problem executing the query
      echo "<script>alert('Event Not Added');</script>";
      echo "<script>$('#all_data').html('');</script>";
      header ('Location: /my_calendar/');//redirecting to calendar.php
    }
  }elseif($_POST['submit'] == 'Update'){
    $message = update_event($db,$_POST);//send the values to update_event function in db_ops
    if($message === true){//if the query successfully executed
      // echo $message;exit;
      echo "<script>alert('Event Updated');</script>";
      echo "<script>$('#all_data').html('');</script>";
      header ('Location: /my_calendar/');//redirecting to calendar.php
    }elseif($message === false) {//if there was any problem executing the query
      echo "<script>alert('Event Not Updated');</script>";
      echo "<script>$('#all_data').html('');</script>";
      header ('Location: /my_calendar/');//redirecting to calendar.php
    }
  }elseif($_POST['delete_submit'] == 'Delete'){
    $message = delete_event($db,$_POST['delete_field']);//send the values to update_event function in db_ops
    if($message === true){//if the query successfully executed
      echo "<script>alert('Event Deleted Successfully');</script>";
      echo "<script>$('#all_data').html('');</script>";
      header ('Location: /my_calendar/');//redirecting to calendar.php
    }elseif($message === false) {//if there was any problem executing the query
      echo "<script>alert('Event Not Deleted');</script>";
      echo "<script>$('#all_data').html('');</script>";
      header ('Location: /my_calendar/');//redirecting to calendar.php
    }
  }
};

  function fetch_events($db, $from, $to){//function to fetch the events from the db
    // if($from !== date("Y-m-d") || $to !== date("Y-m-d", strtotime("+2 week"))){

    // }
    $events_list = mysqli_query($db, "SELECT *, UNIX_TIMESTAMP(event_date) as strtime FROM testdb.my_calendar WHERE (event_date BETWEEN '$from' AND '$to') ORDER BY event_date ASC") or die();
    return $events_list;
  }


  function add_event($db,$data){// function add event to db
    $data['event_name'] = mysqli_real_escape_string($db,$data['event_name']);
    $data['event_description'] = mysqli_real_escape_string($db,$data['event_description']);
    $data['comments'] = mysqli_real_escape_string($db,$data['comments']);
    $query = "INSERT INTO testdb.my_calendar (event_date, event_name, event_description, comments, event_assigned)
		VALUES (DATE_FORMAT('$data[event_date]', '%Y-%m-%d %k:%i:00'), '$data[event_name]', '$data[event_description]', '$data[comments]', NOW())";
    mysqli_query($db, $query);
    return db_update_check($db);
  }


  function update_event($db,$data){
    $data['event_name'] = mysqli_real_escape_string($db,$data['event_name']);
    $data['event_description'] = mysqli_real_escape_string($db,$data['event_description']);
    $data['comments'] = mysqli_real_escape_string($db,$data['comments']);
    $query = "UPDATE testdb.my_calendar set event_date=DATE_FORMAT('$data[event_date]', '%Y-%m-%d %k:%i:00'), event_name='$data[event_name]', event_description='$data[event_description]', comments='$data[comments]', event_assigned=NOW() where si_no='$data[si_no]'";
    mysqli_query($db, $query);
    return db_update_check($db);
  }


  function delete_event($db,$data){
    mysqli_query($db,"delete from testdb.my_calendar where si_no='$data'");
    return db_update_check($db);
  }


  function db_update_check($db){
    if(mysqli_affected_rows($db) > 0 ){//if the db is changed
      return true;
    }else{
      return false;
    }
  }

?>
