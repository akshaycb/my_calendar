<html id='all_data'>
  <head>
    <style>
    .error{
      color: red;
    }
    .row-striped:nth-of-type(odd){
      background-color: #efefef;
      border-left: 4px #000000 solid;
    }
    .row-striped:nth-of-type(even){
      background-color: #ffffff;
      border-left: 4px #efefef solid;
    }
    .row-striped {
        padding: 15px 0;
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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
  		<div class="row row-striped">
  			<div class="col-4 text-right">
  				<h1 class="display-4"><span class="badge badge-secondary"><i class="fa fa-calendar-o" aria-hidden="true"></i> 27 OCT, 2018</span></h1>
  				<h2></h2>
  			</div>
  			<div class="col-8">
  				<h3 class="text-uppercase"><strong>Event Name</strong></h3>
  				<ul class="list-inline">
  				  <!-- <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> Friday</li> -->
  					<li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> 2:30 PM - 4:00 PM</li>
  					<!-- <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> Room 4019</li> -->
  				</ul>
  				<p>Lorem ipsum dolsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Lorem ipsum dolsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
  			</div>
  		</div>
  	</div>
  </body>
</html>

<?php
  // // ini_set('memory_limit','1116M');
  // include($_SERVER['DOCUMENT_ROOT'].'/my_calendar/config.php');//include config.php for db connection
  // include ($_SERVER['DOCUMENT_ROOT'].'/my_calendar/php/db_ops.php');//include db_ops.php for db operations
  // ini_set('display_errors', 1);//to display all the errors
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL & ~E_NOTICE);
  // if($from === NULL || $to === NULL){
  //   $from = date("Y-m-d");
  //   $to = date("Y-m-d", strtotime("+2 week"));
  // }
  // print_data($db, $from, $to);
  // //header ('Location: php/calendar.php');//redirecting to calendar.php
?>
