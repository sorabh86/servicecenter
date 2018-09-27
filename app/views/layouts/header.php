<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= SC_URL ?>img/favicon.png">

    <title>Service Center</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= SC_URL ?>css/style.css" rel="stylesheet">
    <script>
      var SC_URL = "<?= SC_URL ?>";
    </script>
  </head>

  <body>
    <nav class="navbar bg-red <?= is_home('index')?"navbar-fixed-top":""?>">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= SC_URL ?>"><img src="<?= SC_URL ?>img/logo-white.png" alt="Hospital Logo"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav pull-left">
            <li><a href="<?= SC_URL ?>">HOME</a></li>
            <li><a href="<?= SC_URL ?>home/about">ABOUT</a></li>
            <li><a href="<?= SC_URL ?>home/contact">CONTACT</a></li>
          </ul>
          <ul class="nav navbar-nav pull-right">
            <?php if(!isset($_SESSION['user'])): ?>
              <li class="dropdown login-dropdown">
                <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                  <span> <b class="glyphicon glyphicon-user"></b></span>
                  <span>ACCOUNT   <b class="caret"></b></span>
                </a>
                <div class="dropdown-menu bg-red header-login">
                  <form name="widget-login" action="" method="POST" role="form">
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" required placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-block btn-primary">Login</button>
                    </div>
                  </form>
                  <center>
                  Not registerd? <a href="<?= SC_URL ?>customer/register">Create an account</a>
                  </center>
                </div>
              </li>
            <?php else: ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?= isset($_SESSION['user']->name)?$_SESSION['user']->name:'Guest' ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?= SC_URL ?>customer">Dashboard</a></li>
                  <li><a href="<?= SC_URL ?>customer/logout">logout</a></li>
                </ul>
              </li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <div class="flash-msg" style="max-width:250px;position:fixed;right:10px;top:10px;z-index:9999;">
      <!-- alerts -->
    </div>
    