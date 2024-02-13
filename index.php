<?php

session_start();



include 'app/database/connect.php';

include_once "models/db.php";

include "models/usersType.php";

 include "views/fixed/header.php";


$logFile = "data/login.log";

if (!file_exists($logFile)) {

  fopen($logFile, 'w');
}

function logAccess($page) {

  $accessLog = "data/access.log";

  $logMessage = date("Y-m-d H:i:s") . " - Page accessed: " . $page . "\n";

  file_put_contents($accessLog, $logMessage, FILE_APPEND);

}





if (isset($_GET['id'])) {

    $userId = $_GET['id'];

  }

  



if (isset($_GET['page'])) {

  $currentPage = $_GET['page'];

  

  logAccess($currentPage);



  switch ($currentPage) {

    case 'dashboard':

    

      include "views/fixed/adminSidebar.php";

      include "views/pages/dashboard.php";

      break;

    case 'login':

   

      include "views/pages/login.php";

      break;

    case 'logout':

    

      include "views/pages/logout.php";

      break;

    case 'register':

    

      include "views/pages/register.php";

      break;

    case 'upload-slike':

    

      include "views/pages/upload-slike.php";

      break;

    case 'contact':

     

      include "views/pages/contact.php";

      break;

    case 'index-post':

     

      include "views/pages/index-post.php";

      break;

    case 'edit-post':

      include "views/pages/edit-post.php";

      break;

    case 'create-post':

     

      include "views/pages/create-post.php";

      break;

    case 'index-topic':

     

      include "views/pages/index-topic.php";

      break;

    case 'edit-topic':

      include "views/pages/edit-topic.php";

      break;

    case 'create-topic':

     

      include "views/pages/create-topic.php";

      break;

    case 'create-user':

     

      include "views/pages/create-user.php";

      break;

    case 'edit-user':

      include "views/pages/edit-user.php";

      break;

    case 'index-user':

      include "views/pages/index-user.php";

      break;

    case 'more':

      include "views/pages/more.php";

      break;

    case 'gallery':

      include "views/pages/gallery.php";

      break;

    case 'author':

      include "views/pages/author.php";

      break;

    case 'survey':

      include "views/pages/survey.php";

      break;

    default:

      include "views/pages/index.php";

  }

} else {
  logAccess('index');
  include "views/pages/index.php";
}
include "views/fixed/footer.php";

?>



