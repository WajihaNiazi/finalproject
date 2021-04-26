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
    <script src="js/jquery-1.11.1.js"></script>
    <style>
      table,td,th{
        width:1000px;
        margin:auto;
        border: 1px solid gray;
        background: white;
        
      }
      td,th{
        text-align: center;
      }
  </style>
    
</head>
  <?php  
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
                          <div class="">
                            <div id="toolbar">
                            <div class="login-btn-inner">
                              <div class="row">
                                  <div class="col-lg-9">

                                      <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                       <input type="text" name="Search_text" id="Search_text">&nbsp&nbsp<i class="fa fa-search"></i>
                                      </div>
                                  </div>
                                </div>
                                <div id="result"></div>
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
    <script>
  jQuery(document).ready(function() {
      $('#Search_text').keyup(function(){
        var txt = $(this) .val();
        if (txt !='') {
          console.log('#Search_text')
          $.ajax({
            url:"fetch.php",
            method:"post",
            data: {search:txt},
            dataType:"text",
            success:function(data) {
              $('#result').html(data);
            }
          }); 
        }
        else {
          $('#result').html('');
          $.ajax({
            url:"fetch.php",
            method:"post",
            data: {search:txt},
            dataType:"text",
            success:function(data) {
              $('#result').html(data);
            }
          }); 
        }
      });
    });
  </script>	
</body>

</html>