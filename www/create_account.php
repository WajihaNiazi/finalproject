<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php
      $title = "Create Account";
      include_once("title.php");
    ?>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
   
</head>
<body>
<?php 
    include("../lib/crud.php");
    $db = new CRUD();
    $name = $email = $gender = $password = $address = $country = $phone = $photo = "";
    $fileErr =$nameErr = $emailErr = $passwordErr = $genderErr = $countryErr = $phoneErr = $photoErr="";																			
    if(isset($_POST['submit'])){
        if(empty($_POST['name'])){
            $nameErr = "first name can not be empty";	
        }else{
            $name =$_POST['name'];
        }
        if(empty($_POST['email'])){
            $emailErr = "email name can not be empty";	
        }else{
            $regex = "^[A-z0-9.]+@[A-z]+\.[A-z]{3}+$^";
            if (preg_match($regex, $email)) 
            {
                $email = $_POST['email'];
            }
        }
        if(empty($_POST['gender'])){
            $genderErr = "";	
        }else{
            $gender = $_POST['gender'];
        }
        if(empty($_POST['password'])){
            $passwordErr = "password can not be empty";	
        }else{
            $password = $_POST['password'];
        }
        if(empty($_POST['phone'])){
            $phoneErr = "";	
        }else{
            $phone = $_POST['phone'];
        }
        if(empty($_POST['country'])){
            $countryErr = "";	
        }else{
            $country = $_POST['country'];
        }
        if(empty($_POST['address'])){
            $addressErr = "";	
        }else{
            $address =$_POST['address'];
        }
        if(empty($_POST['photo'])){
            $photoErr = "";	
        }else{
            $photo = $_POST['photo'];
        } 
        // file name
        $photoName = $_FILES["photo"]["name"];
        // directory
        $file_path = "userPhoto/";
        // source
        $source = $_FILES["photo"]["tmp_name"];
        $photoType = $_FILES["photo"]["type"];
        $allowed_extension =  array("png", "jpg","JPG","PNG","jpeg");
        $extension = strtolower(PATHINFO($photoName ,PATHINFO_EXTENSION)); 
         if(!in_array($extension, $allowed_extension)){
            $fileErr = "Unfortunatly the type file is not allowed!";
        }
        else{
            $fulldate = date("Y_m_d h_i_s");
            $photoName = "img _ ".$fulldate.".".$extension;
            move_uploaded_file($source,$file_path.$photoName);
        }
        if(empty($nameErr) && empty($emailErr) && empty($passwordErr)){
            $insert = $db->insert("create_account","`name`, `email`, `password`, `mobile`, `address`, `gender`, `country`, `pictrure`"," '$name', '$email', '$password', '$phone', '$address', '$gender', '$country', '$photoName'");
            header("location:login.php?save=1");
        }else{
            echo "Failed";
        }
    }
    // that code for json 
        $file =fopen("createUser.json","a+");
        $arr= array(
            "name"=>$name,
            "Email"=>$email,
            "Gender"=>$gender,
            "password"=>$password,
            "address"=>$address,
            "country"=>$country,
            "phone"=>$phone,
            "photo"=>$photo
        );
        $id_js= json_encode($arr);
        fwrite($file,$id_js);
        fclose($file);
?>
    <div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center custom-login">
				<h3>Registration</h3>
				<p>This is the best app ever!</p>
			</div>
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="create_account.php" method="post" enctype="multipart/form-data">
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Name *</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name='name' class="form-control" />
                                        <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $nameErr?></label>
                                    </div>
                                </div>
                            </div>                      
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Email *</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="email" class="form-control" />
                                        <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $emailErr?></label>
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Country</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <select name="country" class="form-control">
                                        <option ></option>
                                        <option >Afghanistan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Address</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name='address' class="form-control" />
                                    </div>
                                </div>
                            </div>   
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Mobil</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name='mobil' class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Gender</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="bt-df-checkbox">
                                            <label for="Twin">Male</label>
                                            <input class="pull-left radio-checked" type="radio" <?php if($gender=="male"){echo  "checked";}?> value="male" id="male" name="gender">
                                            <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $genderErr?></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="bt-df-checkbox">
                                            <label for="dubble">Fmale </label>
                                            <input class="pull-left radio-checked" type="radio" <?php if($gender=="fmale"){echo  "checked";}?> value="fmale" id="fmale" name="gender">
                                            <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $genderErr?></label>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Photo</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="file" name='photo' class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Password *</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="password" name='password' class="form-control" />
                                        <label class="login2 pull-right pull-right-pro" style="color:red;"><?php echo $passwordErr?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="login2 pull-right pull-right-pro">Confirm Password</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="Cpassword" name="Cpassword" class="form-control" />
                                    </div>
                                </div>
                            </div>               
                            <div class="form-group-inner">
                                <div class="login-btn-inner">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <div class="login-horizental cancel-wp pull-left form-bc-ele">                   
                                                <button class="btn btn-sm btn-primary login-submit-cs" name='submit' type="submit">submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
			<div class="text-center login-footer">
				<p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
			</div>
		</div>   
    </div>
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
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
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