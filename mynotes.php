<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconn.php');
if (strlen($_SESSION['eid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from notes where id=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>";  


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Notes</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap/style.css" rel="stylesheet">
    <style>
        .navbar {
  background-color: #fff;
  padding: 10px 20px;
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  z-index: 1000;
  height:60px;
}

.navbar-container {
  display: flex;
  align-items: center;
  width: 100%; /* Ensures the container takes the full width */
  justify-content: flex-start; /* Aligns items to the left */
}


.nav-links {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}

.nav-links li {
  margin-left: 20px;
  font-weight:40px;
}
.nav-links li:first-child {
  margin-left: 0; 
  font-weight: bold;
  font-size: 1.1rem;
  padding-left:20px;/* Ensures the first item has no extra margin */
}

.nav-links li a {
  color: #000;
  text-decoration: none;
  font-size: 1rem;
}
.nav-links li a i {
  margin-right: 8px; /* Adjust the spacing between the arrow and the text */
}
.nav-links li a:hover {
  color: #00aaff;
}

    </style>
</head>

<body>
<!-- Navigation Bar Start -->
<nav class="navbar">
      <div class="navbar-container">
        
        <ul class="nav-links">
        <li><a href="home.php"><i class="fas fa-arrow-left"></i> Back</a></li>
          
        </ul>
      </div>
    </nav>
    <!-- Navigation Bar End -->
    <div class="container-fluid position-relative bg-white d-flex p-0">
        
        
        <div class="content">


                    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">My Notes</h6>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                   
                                    <th scope="col">Subject</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Creation Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $eid=$_SESSION['eid'];
$sql="SELECT * from notes where UserID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    
                                    <td><?php  echo htmlentities($row->Subject);?></td>
                                    <td><?php echo htmlentities($row->Level ?? ''); ?></td>
                                    <td><?php  echo htmlentities($row->Module);?></td>
                                    <td><?php  echo htmlentities($row->Title);?></td>
                                    <td><?php  echo htmlentities($row->CreationDate);?></td>
                                   
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="editnotes.php?editid=<?php echo htmlentities ($row->id);?>">Edit</a> 
                                    <a class="btn btn-sm btn-primary" href="mynotes.php?delid=<?php echo ($row->id);?>"  onclick="return confirm('Do you really want to Delete ?');">Delete</a>
                                </td>
                                </tr><?php $cnt=$cnt+1;}} ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           

           
        </div>
        <!-- Content End -->

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html><?php }  ?>