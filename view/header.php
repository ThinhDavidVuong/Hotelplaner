<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | Bbc MVC</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="back">
      <div class="jumbotron"></div>
          <div class="container">
              <nav class="navbar navbar-fixed-center">
                      <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand">Hotelplaner</a>
                      </div>
                      <div id="navbar" class="collapse navbar-collapse">
                          <ul class="nav nav-tabs">
                              <li><a href="/">Hotel</a></li>
                              <?php
                              if(isset($_SESSION['Userid']))
                              {
<<<<<<< HEAD
                                echo "<li><a href=\"/user\">Buchungen</a></li>";
                                echo "<li><a href=\"/comment/showhotels\">Bewerten</a></li>";
=======
                                echo "<li><a href=\"/reservation/reservation\">Buchungen</a></li>";
                                echo "<li><a href=\"/user/comment\">Bewerten</a></li>";
>>>>>>> origin/master
                                echo "<li><a href=\"/login/logout\">Logout</a></li>";
                              } else {
                                echo "<li><a href=\"/login/login\">Login</a></li>";
                              }
                              ?>
                          </ul>
                      </div><!--/.nav-collapse -->
                  </div>
              </nav>
      <div class="container">
<!--          <h1>--><?//= $heading ?><!--</h1>-->
