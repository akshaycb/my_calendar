<!-- <html id='all_data'>
<head>
<style>
.error{
color: red;
}
</style>";
<title>My Calendar</title>";
<script src="/my_calendar/js/jquery.min.js"></script>';
<script src="/my_calendar/js/validate.min.js"></script>';
<script src="/my_calendar/js/moment-with-locales.js"></script>';
<script src="/my_calendar/js/bootstrap.min.js"></script>';
<script src="/my_calendar/js/bootstrap-datetimepicker.js"></script>';
<link href="/my_calendar/css/bootstrap.min.css" rel="stylesheet"/>';
<link href="/my_calendar/css/bootstrap-datetimepicker.css" rel="stylesheet"/></head> -->

<?php
  // ini_set('memory_limit','1116M');
  include($_SERVER['DOCUMENT_ROOT'].'/my_calendar/config.php');//include config.php for db connection
  include ($_SERVER['DOCUMENT_ROOT'].'/my_calendar/php/db_ops.php');//include db_ops.php for db operations
  ini_set('display_errors', 1);//to display all the errors
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL & ~E_NOTICE);
  if($from === NULL || $to === NULL){
    $from = date("Y-m-d");
    $to = date("Y-m-d", strtotime("+2 week"));
  }
  print_data($db, $from, $to);
  //header ('Location: php/calendar.php');//redirecting to calendar.php
?>
