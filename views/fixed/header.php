<?php 
$navigacije = selectAll('navigations');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> WEBIO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/admin.css" />
  </head>
    <body class="sub_page">
        <header class="header_section">
          <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a id="logo" class="navbar-brand" href="#">Webio Blog</a>
              <a  class="navbar-brand" href="dokumentacija-praktikumPHP.pdf">Documentation</a>
<a class="navbar-brand" href="root/sitemap.xml"><i class="fa fa-sitemap" aria-hidden="true"></i></a>

              
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <?php foreach($navigacije as $navigacija): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?page=<?php echo $navigacija['href'];?>"><?php echo $navigacija['title'];?></a>
                    </li>
                  <?php endforeach; ?>
                  <?php if(isset($_SESSION['id'])):?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['username'];?>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if($_SESSION['role']):?>
                          <a class="dropdown-item" href="index.php?page=dashboard">Dashboard</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="index.php?page=survey&u_id=<?php echo $_SESSION['id']; ?>">Survey</a>
                        <a class="dropdown-item" href="index.php?page=logout">Logout</a>
                      </div>
                    </li>
                  <?php else: ?>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?page=login">Login</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?page=register">Register</a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </nav>
    </header>