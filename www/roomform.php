<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION["login_authority"])){
      header("location:login.php");
    }
    $title = "Create Room";
    include_once("title.php");
    ?>
<?php include('include/head.php');?>
</head>
<?php  
    include("../lib/crud.php");
    $db = new CRUD();
    $room_no = $type= $price= $details="";
    $imageErr = $room_noErr = $typeErr= $priceErr= $detailsErr="";   										
    if(isset($_POST['submit'])){
        if(empty($_POST['room_no'])){
            $room_noErr = "room_no can not be empty";	
        }else{
            $room_no = cleanData($_POST['room_no']);
        }
        if(empty($_POST['type'])){
            $typeErr = "type can not be empty";	
        }else{
            $type = cleanData($_POST['type']);
        }
        if(empty($_POST['price'])){
            $priceErr = "price can not be empty";	
        }else{
            $price = cleanData($_POST['price']);
        }
        if(empty($_POST['details'])){
            $usdetailsErr = "detail can not be empty";	
        }else{
            $details = cleanData($_POST['details']);
        }
        // file name
        $photoName = $_FILES["image"]["name"];
        // directory
        $file_path = "roomimage/";
        // source
        $source = $_FILES["image"]["tmp_name"];
        $allowed_extension = array("png","jpg","JPG","PNG","jpeg");
        $extension = strtolower(PATHINFO($photoName ,PATHINFO_EXTENSION));
        if(!in_array($extension, $allowed_extension)){
            $fileErr = "Unfortunatly the type file is not allowed!";     
        }
        else{
            $fulldate = date("Y_m_d h_i_s");
            $photoName = "pic _ ".$fulldate.".".$extension;
            move_uploaded_file($source,$file_path.$photoName);
        }
        if(empty($imageErr) && empty($room_noErr) && empty($typeErr) && empty($priceErr) && empty($detailsErr)){
            $insert = $db->insert("rooms","`room_no`, `type`, `price`, `details`,image"," '$room_no','$type','$price','$details','$photoName'");
            header("location:roomform.php?save=1");  
        }else{
            echo "Failed";
        }
    }
    function cleanData($data){
        $data = trim($data);
        $data = htmlSpecialChars($data);
        $data = stripslashes($data);
        return $data;
    }
    $file =fopen("Room.json","a+");
    $arr= array(
        "room_no" =>$room_no,
        "type"=>$type,
        "price"=>$price,
        "details"=>$details

    );
    $id_js= json_encode($arr);
    fwrite($file,$id_js);
    fclose($file);
?>
<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <?php include('include/sidebar.php');?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper" >
        
        <?php include('include/header.php');?>
        <div style="width: 40%;margin: auto;">
            <div class="basic-form-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline12-list">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h1>Add New Room</h1>
                                    </div>
                                </div>
                                <div class="sparkline12-graph">
                                    <div class="basic-login-form-ad">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="all-form-element-inner">
                                                    <form action=" <?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="room_no"  class="login2 pull-right pull-right-pro">Room number</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $room_noErr?></label>
                                                                    <input type="number" class="form-control" name="room_no" value="<?php echo $room_no;?>" id="room_no"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="type"  class="login2 pull-right pull-right-pro">Room Type</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $typeErr?></label>
                                                                    <input type="text" class="form-control" name="type" id="type"  value="<?php echo $type?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="price"  class="login2 pull-right pull-right-pro">Price</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $priceErr?></label>
                                                                    <input type="number" class="form-control" name="price" id="price" value="<?php echo $price?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="details"  class="login2 pull-right pull-right-pro">Room Details</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $detailsErr?></label>
                                                                    <textarea class="form-control" name="details" id="details" ><?php echo $details?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="image"  class="login2 pull-right pull-right-pro">Room Image</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <input type="file" class="form-control" name="image" id="image"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-3"></div>
                                                                    <div class="col-lg-9">
                                                                        <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                            <input class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit" value="Submit">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>     
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