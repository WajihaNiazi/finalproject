<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION["login_authority"])){
      header("location:login.php");
    }
    include('include/head.php');
    $title = "Booking form";
    include_once("title.php");
?>
</head>
<?php  
    include("../lib/crud.php");
    $db = new CRUD();
    // id,name,email,phone,address,city,state,zip,contry,room_type,check_in_date,check_in_time,check_out_date,Occupancy
    $name= $email= $phone= $address= $city= $state= $zip= $contry= $room_type= $check_in_date= $check_in_time= $check_out_date= $Occupancy="";
    $name_Err= $email_Err= $phone_Err= $address_Err= $city_Err= $state_Err= $zip_Err= $contry_Err= $room_type_Err= $check_in_date_Err= $check_in_time_Err= $check_out_date_Err= $Occupancy_Err="";  										
    if(isset($_POST['submit'])){
        if(empty($_POST['name'])){
            $name_Err = "name can not be empty";	
        }else{
            $name = cleanData($_POST['name']);
        }
        if(empty($_POST['email'])){
            $email_Err = "email can not be empty";	
        }else{
            // regular experssion
            $regex = "^[A-z0-9.]+@[A-z]+\.[A-z]{3}+$^";
            if (preg_match($regex, $email)) 
            {
                $email= cleanData($_POST['email']);
            }
        }
        if(empty($_POST['phone'])){
            $phone_Err = "phone can not be empty";	
        }else{
            $phone= cleanData($_POST['phone']);
        }
        if(empty($_POST['address'])){
            $address_Err = "address can not be empty";	
        }else{
            $address= cleanData($_POST['address']);
        }
        if(empty($_POST['city'])){
            $city_Err = "city can not be empty";	
        }else{
            $city= cleanData($_POST['city']);
        }if(empty($_POST['state'])){
            $state_Err = "state can not be empty";	
        }else{
            $state= cleanData($_POST['state']);
        }
        if(empty($_POST['zip'])){
            $zip_Err = "zip can not be empty";	
        }else{
            $zip= cleanData($_POST['zip']);
        }
        if(empty($_POST['contry'])){
            $contry_Err = "contry can not be empty";	
        }else{
            $contry= cleanData($_POST['contry']);
        }
        if(empty($_POST['room_type'])){
            $room_type_Err = "room_type can not be empty";	
        }else{
            $room_type= cleanData($_POST['room_type']);
        }
        if(empty($_POST['check_in_date'])){
            $check_in_date_Err = "check_in_date can not be empty";	
        }else{
            $check_in_date= cleanData($_POST['check_in_date']);
        }
        if(empty($_POST['check_in_time'])){
            $check_in_time_Err = "check_in_time can not be empty";	
        }else{
            $check_in_time= cleanData($_POST['check_in_time']);
        }
        if(empty($_POST['check_out_date'])){
            $check_out_date_Err = "check_out_date can not be empty";	
        }else{
            $check_out_date= cleanData($_POST['check_out_date']);
        }
        if(empty($_POST['Occupancy'])){
            $Occupancy_Err = "check_in_time can not be empty";	
        }else{
            $Occupancy= cleanData($_POST['Occupancy']);
        }
        if(empty($name_Err) && empty($email_Err) && empty($phone_Err) && empty($address_Err) && empty($city_Err)&& empty($state_Err) && empty($zip_Err) && empty($contry_Err)&& empty($room_type_Err) && empty($check_in_date_Err)&& empty($check_out_date_Err) && empty($Occupancy_Err)){
            $insert = $db->insert("room_booking_details","`name`,`email`,`phone`,`address`,`city`,`state`,`zip`,`contry`,`room_type`,`check_in_date`,`check_in_time`,`check_out_date`,`Occupancy`","'$name','$email','$phone','$address','$city','$state','$zip','$contry','$room_type','$check_in_date','$check_in_time','$check_out_date','$Occupancy'");
            header("location:bookingform.php?save=1");  
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


    // that code for json 
    $file =fopen("bookingRoom.json","a+");
    $arr= array(
        "name"=>$name,
        "Email"=>$email,
        "phone"=> $phone,
        "address"=>$address,
        "city"=>$city,
        "state"=>$state ,
        "zip"=>$zip,
        "contry"=>$contry,
        "room_type"=>$room_type,
        "check_in_date"=>$check_in_date,
        "check_in_time"=>$check_in_time ,
        "check_out_date"=>$check_out_date,
        "Occupancy"=>$Occupancy 
    );
    $id_js= json_encode($arr);
    fwrite($file,$id_js);
    fclose($file);
?>
<body>
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
                                        <h1>Book Now</h1>
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
                                                                    <label for="name"  class="login2 pull-right pull-right-pro">Name :</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $name_Err?></label>
                                                                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>" id="name"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="email"  class="login2 pull-right pull-right-pro">email :</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $email_Err?></label>
                                                                    <input type="email" class="form-control" name="email" value="<?php echo $email;?>" id="email"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="phone"  class="login2 pull-right pull-right-pro">phone:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $phone_Err?></label>
                                                                    <input type="phone" class="form-control" name="phone" value="<?php echo $phone;?>" id="phone"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="address"  class="login2 pull-right pull-right-pro">Adress:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $address_Err?></label>
                                                                    <textarea class="form-control" name="address" id="address" ><?php echo $address?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="city"  class="login2 pull-right pull-right-pro">city:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $city_Err?></label>
                                                                    <input type="text" class="form-control" name="city" value="<?php echo $city;?>" id="city"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="state"  class="login2 pull-right pull-right-pro">state:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $state_Err?></label>
                                                                    <input type="text" class="form-control" name="state" value="<?php echo $state;?>" id="state"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="zip"  class="login2 pull-right pull-right-pro">zip:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $zip_Err?></label>
                                                                    <input type="number" class="form-control" name="zip" value="<?php echo $zip;?>" id="zip"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="contry"  class="login2 pull-right pull-right-pro">country:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $contry_Err?></label>
                                                                    <input type="text" class="form-control" name="contry" value="<?php echo $contry;?>" id="contry"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="room_type"  class="login2 pull-right pull-right-pro">Room Type:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $room_type_Err?></label>
                                                                    <select class="form-control" id="room_type" name="room_type">
                                                                        <option>Deluxe Room</option>
                                                                        <option>Luxurious Suite</option>
                                                                        <option>Standard Room</option>
                                                                        <option>Suite Room</option>
                                                                        <option>Twin Deluxe Room</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="check_in_date"  class="login2 pull-right pull-right-pro">check_in_date:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $check_in_date_Err?></label>
                                                                    <input type="date" class="form-control" name="check_in_date" value="<?php echo $check_in_date;?>" id="check_in_date"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="check_in_time"  class="login2 pull-right pull-right-pro">check_in_time:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $check_in_time_Err?></label>
                                                                    <input type="time" class="form-control" name="check_in_time" value="<?php echo $check_in_time;?>" id="check_in_time"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="check_out_date"  class="login2 pull-right pull-right-pro">check_out_date:</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
																    <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $check_out_date_Err?></label>
                                                                    <input type="date" class="form-control" name="check_out_date" value="<?php echo $check_out_date;?>" id="check_out_date"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label for="Occupancy"  class="login2 pull-right pull-right-pro">Occupancy:</label>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <div class="bt-df-checkbox">
                                                                        <label for="single">single </label>
                                                                        <input class="pull-left radio-checked" type="radio" <?php if($Occupancy=="single"){echo  "checked";}?> value="single" id="single" name="Occupancy">
                                                                        <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $Occupancy_Err?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <div class="bt-df-checkbox">
                                                                        <label for="Twin">Twin </label>
                                                                        <input class="pull-left radio-checked" type="radio" <?php if($Occupancy=="Twin"){echo  "checked";}?> value="Twin" id="Twin" name="Occupancy">
                                                                        <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $Occupancy_Err?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <div class="bt-df-checkbox">
                                                                        <label for="dubble">Dubble </label>
                                                                        <input class="pull-left radio-checked" type="radio" <?php if($Occupancy=="dubble"){echo  "checked";}?> value="dubble" id="dubble" name="Occupancy">
                                                                        <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $Occupancy_Err?></label>
                                                                    </div>
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
                                                                            <a  class="btn btn-sm btn-primary login-submit-cs" href="roomreport.php">cancel</a>
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