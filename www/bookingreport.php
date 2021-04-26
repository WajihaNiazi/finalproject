<?php 
   session_start();
   session_regenerate_id();
   if(!isset($_SESSION["login_authority"])){
     header("location:login.php");
   }
    include('include/head.php');
    $title = "Booking Report";
    include_once("title.php");
    ?>
</head>
  <?php  
    include("../lib/crud.php");
    $db = new CRUD();
    $room_booking_details = "";
    // <a href='list_of_users.php?deleteID=$id&url=$photo'>Delete</a>
    // <a href='update_user.php?updateID=$id'>Update</a>
    $row = $db->select("room_booking_details","*","");
    foreach ($row as $re) {
    $id= $re['id'];
    $name= $re['name'];
    $email= $re['email'];
    $phone= $re['phone'];
    $address= $re['address'];
    $city= $re['city'];
    $state= $re['state'];
    $zip= $re['zip'];
    $contry= $re['contry'];
    $room_type=$re['room_type'];
    $check_in_date= $re['check_in_date'];
    $check_in_time= $re['check_in_time'];
    $check_out_date= $re['check_out_date'];
    $Occupancy=$re['Occupancy'];
    $room_booking_details .="<tr>
        <td>$id</td>
        <td>$name</td>
        <td>$email</td>
        <td>$phone</td>
        <td>$address</td>
        <td>$city</td>
        <td>$state</td>
        <td>$zip</td>
        <td>$contry</td>
        <td>$room_type</td>
        <td>$check_in_date</td>
        <td>$check_in_time</td>
        <td>$check_out_date</td>
        <td>$Occupancy</td>
        <td class='datatable-ct'>
          <a href='bookingupdate.php?updateID=$id'><i class='fa fa-edit'></i> / </a>
          <a href='bookingreport.php?deletId=$id'><i class='fa fa-trash-o'></i></a>
        </td>
      </tr>";        
    }
    if(isset($_GET['deletId'])){
      $id_delet = (int) $_GET['deletId'];
      $de = $db->delete("room_booking_details","id='$id_delet'");
      if($de){
        header("location:bookingreport.php?deleted=1");  
      } 
    }  
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
              <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="sparkline13-list">
                        <div class="sparkline13-hd">
                          <div class="main-sparkline13-hd">
                            <h1>Rooms <span class="table-project-n">Data</span> Table</h1>
                          </div>
                        </div>
                        <div class="sparkline13-graph">
                          <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb">
                                    <option value="">Export Basic</option>
                                    <option value="all">Export All</option>
                                    <option value="selected">Export Selected</option>
							    </select>
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Address</th>
                                  <th>City</th>
                                  <th>State</th>
                                  <th>Zip</th>
                                  <th>Country</th>
                                  <th>Room_type</th>
                                  <th>Check_in_date</th>
                                  <th>Check_in_time</th>
                                  <th>Check_out_date</th>
                                  <th>Occupancy</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php echo $room_booking_details;?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
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
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
		============================================ -->
    <script src="js/editable/jquery.mockjax.js"></script>
    <script src="js/editable/mock-active.js"></script>
    <script src="js/editable/select2.js"></script>
    <script src="js/editable/moment.min.js"></script>
    <script src="js/editable/bootstrap-datetimepicker.js"></script>
    <script src="js/editable/bootstrap-editable.js"></script>
    <script src="js/editable/xediable-active.js"></script>
    <!-- Chart JS
		============================================ -->
    <script src="js/chart/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
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