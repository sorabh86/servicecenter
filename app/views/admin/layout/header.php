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

    <title>Service Center Admin</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= SC_URL ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= SC_URL ?>css/admin-style.css" rel="stylesheet">
    <script>
      var SC_URL = "<?= SC_URL ?>";
    </script>
  </head>
  <body>
    
    <nav class="navbar navbar-inverse" style="padding:20px 0;margin-bottom:0;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?= SC_URL ?>">
          <img height="45" src="<?= SC_URL ?>img/logo-white.png" alt="Service Center Admin Logo">
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav pull-right">
            <?php if(isset($_SESSION['admin'])): ?>
                <li><a href="<?= SC_URL ?>admin/logout">LOGOUT</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    