<?php
session_start();
error_reporting(E_ALL);
include('../includes/dbconn.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <title>WayaShare</title>
   
    <link rel="manifest" href="site.webmanifest">
   
    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/main-style.css">
</head>

<body>
 <?php include_once('header.php');?>
    <!-- Header End -->
    <main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Industrial Management</h1>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
            <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Level 01</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
              <?php
                      if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        // Formula for pagination
        $no_of_records_per_page =10;
        $offset = ($pageno-1) * $no_of_records_per_page;


$ret = "SELECT COUNT(*) FROM notes WHERE Subject='IMGT' AND Level='level1'";
                  
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);             
$sql="SELECT notes.*,users.* from notes join users on notes.UserID=users.id WHERE notes.Subject='IMGT' AND notes.Level='level1' LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                    <div class="col-lg-6">
                        <div class="properties properties2 mb-30">
                            <div class="properties__card">
                                
                                <div class="properties__caption">
                                    <p><?php  echo htmlentities($row->Module);?></p>
                                    <h3><?php  echo htmlentities($row->Title);?> By (<?php  echo htmlentities($row->UserName);?>)</h3>
                                    <p><?php  echo htmlentities($row->Description);?>.
                                     
                                        
                                    </p>
                                    <div class="properties__footer d-flex justify-content-between align-items-center">
                                        <div class="restaurant-name">
                                          
                                            
                                        </div>
                                       
                                    </div>
                                    <p><table border="1">
                                            <tr>
                                                <td colspan="3" style="text-align: center;">
                                                    <a href="../folder/<?php echo $row->File;?>" width="100" height="100" target="_blank" class="btn bnt-primary">Download File</a>
                                                </td>
                                            </tr>
                                        </table>
</p>
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                   <?php $cnt=$cnt+1;}} ?>
                    
                 
                </div>
              <div align="left">
    <ul class="pagination" >
        <li><a href="?pageno=1"><strong style="color:blue">First></strong></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px;color: blue;">Prev></strong></a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px;color: blue;">Next></strong></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px;color: blue;">Last</strong></a></li>
    </ul>
</div>
            </div>
        </div>
        <!-- Courses area End -->
        
      
    </main>
   <?php include_once('../includes/footer.php');?>

    <!-- JS here -->
    <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="../assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="../assets/js/jquery.barfiller.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    
</body>
</html>