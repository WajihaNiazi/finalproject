<?php
  session_start();
  session_regenerate_id();
 
  $title = "All Room";
  include_once("title.php");
?>
      
<?php include('include/head.php');?>
</head>
<?php  
    include("../lib/crud.php");
    $db = new CRUD();
?>
<body>
    <!-- Start Left menu area -->
    <?php include('include/sidebar.php');?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <?php include('include/header.php');?>
        <div class="contacts-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <?php
                        $row = $db->select("rooms","*","status=0");
                        foreach ($row as $re) {
                            $type = $re['type'];
                            $img = $re['image'];
                            $detail = $re['details'];
                            $price = $re['price'];
                              echo
                                "<div class='col-lg-3 col-md-6 col-sm-6 col-xs-12'>
                                    <div class='student-inner-std res-mg-b-30'>
                                        <div class='student-img'>
                                            <img src='roomimage/$img'/ style='height:250px'>
                                        </div>
                                        <div class='student-dtl'>
                                            <h2>$type</h2>
                                            <p class='dp-ag'><b>Price:</b>$price</p>
                                            <a href='bookingform.php'><p class='dp-ag' style='text-decoration:;color:red'><b>Booking:</b>Booknow</p></a>
                                        </div>
                                    </div>
                                </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php');?>
    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="js/morrisjs/raphael-min.js"></script>
    <script src="js/morrisjs/morris.js"></script>
    <script src="js/morrisjs/morris-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
    <script src="js/tawk-chat.js"></script>
</body>

</html>