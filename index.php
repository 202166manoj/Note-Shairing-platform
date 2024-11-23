<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WayaShare</title>

  <!-- 
    - favicon
  -->
  

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="assets/css/main-style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body>

  <!-- 
    - HEADER
  -->

  <header>
<a href="#home" class="logo">
        <img src="./assets/images/logo.svg" alt="Landio logo">
      </a>
        <nav>
            <ul>
            <li><a href="#hero">HOME</a></li>
                <li><a href="#about">CATEGORIES</a></li>
                <li><a href="#features">ABOUT</a></li>
                <li><a href="login.php">UPLOAD NOTES</a></li>
                <li><a href="login.php">LOGIN</a></li>
                
            </ul>
        </nav>
    </header>



  <main>
    <article>

      <!--home section-->
      <section class="hero" id="hero">
        <div class="container">
          <div class="hero-content">

            <h1 class="h1 hero-title">Welcome to WayaShare !</h1>
            <p class="hero-text">Boost your grades with shared knowledge!</p>
            <p class="form-text"> The app for Wayamba University Faculty of Applied Science undergraduates to share notes, collaborate and ace their courses.</p>

            <form action="register.php" class="hero-form">
              <button type="submit" class="btn btn-primary">Explore Now</button>
            </form>
            
          </div>

          <figure class="hero-banner">
            <img src="assets/images/hero-banner-2.png" alt="Hero image">
          </figure>

        </div>
      </section>



      <!--categories section-->
      <section class="about" id="about">
        <div class="container">
          <div class="about-content">
            <h2 class="h2 about-title">Categories</h2>
            <p class="about-text">You can view, download, upload notes under following categories</p>
          </div>

          <ul class="about-list">

            <li>
              <div class="about-card">
                <div class="card-icon">
                <ion-icon name="calculator"></ion-icon>
                </div>
                <h3 class="h3 card-title">MMST</h3>
                <p class="card-text">Mathematical Sciences</p>
              </div>
            </li>

            <li>
              <div class="about-card">
                <div class="card-icon">
                <ion-icon name="laptop"></ion-icon>
                </div>
                <h3 class="h3 card-title">CMIS</h3>
                <p class="card-text">Computing & information Sys.</p>
              </div>
            </li>

            <li>
              <div class="about-card">
                <div class="card-icon">
                <ion-icon name="hardware-chip"></ion-icon>
                </div>
                <h3 class="h3 card-title">ELTN</h3>
                <p class="card-text">Electronics</p>
              </div>
            </li>

            <li>
              <div class="about-card">
                <div class="card-icon">
                <ion-icon name="id-card"></ion-icon>
                </div>
                <h3 class="h3 card-title">IMGT</h3>
                <p class="card-text">Industrial Management</p>
              </div>
            </li>
          
          </ul>
        </div>
      </section>


      <!--upload section-->
      <!--<section class="cta" aria-label="call to action" id="cta">
        <div class="container">
          <h2 class="h2 section-title">try uploading your notes try uploading your notes try uploading your notes </h2>
          <a href="" class="btn btn-primary">Try it Now</a>
        </div>
      </section>-->


      <!--about section-->
      <section class="features" id="features">
        <div class="container">
          <h2 class="h2 section-title">About us</h2>
          <p class="section-text">
          WayaShare goes beyond simply sharing notes. It's a platform designed to foster a dynamic online 
          community where you can connect with classmates, share notes and support each other on your academic journey.
          WayaShare is more than just notes. It's about empowering Wayamba FAS undergrads to learn together, support each other 
          and achieve academic success as a community.
          </p>
        </div>
      </section>

    </article>
  </main>

<!--footer section-->
<?php include 'includes/footer.php'; ?>
  <!-- 
    - custom js link
  -->
  <script src="assets/js/main-script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>