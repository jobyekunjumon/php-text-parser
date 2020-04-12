<?php 
require_once('../autoloader.php');
$controller = new App\Controllers\SaveDataController();
$view = $controller->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Text Processor</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">Text Processor</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h2 class="text-center">TEXT PARSER</h2>
                        </div>
                        <div class="card-body">
                            <?php 
                                if(!empty($view->getErrorMessage())) {
                                    echo "<div class='alert alert-danger'>{$view->getErrorMessage()}</div>";
                                }
                                if(!empty($view->getMessage())) {
                                    echo "<div class='alert alert-success'>{$view->getMessage()}</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
  
  <footer class="bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">***</p>
    </div>
  </footer>
  <script type="text/javascript" src="js/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>