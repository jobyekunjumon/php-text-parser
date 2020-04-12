<?php 
require_once('../autoloader.php');
$controller = new App\Controllers\IndexController();
$view = $controller->execute();
$vieData = $view->getData();
$sampleText = "We are looking for a senior PHP Developer who is capable of understanding and working with PHP Frameworks. Strong working experience in AWS, Handling Codecs. Code Quality, Making codes hacker safe. Good team player and lead the teams. Java Script, HTML, API integrations, write APIs.   
jobyekunjumon@gmail.com, +91 9645 280224
Participate in the entire application life cycle, focusing on coding and debugging.
Proficiency in Object oriented programming.
Write clean code to develop functional web applications.
Troubleshoot and debug applications.
Perform UI tests to optimize performance.
Build reusable code and libraries for future use.
Mysql & SQL queries (Sound Knowledge necessary).
Linux experience (Centos, Ubuntu, Amazon EC2) Installation, Configuration, OS Services, Hardening.
Proficient understanding of client-side scripting and JavaScript frameworks, including jQuery.
Proficient understanding of GIT.
https://www.gogle.com
My name is Joby
Proficient understanding of Restful APIs. 
Good Experience in AWS, API, EDA (Event Driven Architecture).
Must have the experience to handle production servers.
Should have a good analytical and logical approach towards problem solving. 
http://localhost//textprocessor/public/
";
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
                            <?php if(empty($vieData['showParsedDataForm'])) : ?>
                                <form name="frmText" method="post" action="" >
                                    <h2 for="text">Enter Description</h2>
                                    <div class="row">
                                        <div class="form-group col-lg-12 mx-auto">
                                            <textarea class="form-control" style="height:250px;"  name="text" id="text"><?php echo $sampleText; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 mx-auto">
                                            <button type="submit"  class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            <?php 
                            else :
                                echo '<form name="frmText" method="post" action="save-data.php" >';
                                    echo '<div class="row">';
                                        echo '<h2>Your Data</h2>';
                                        if(!empty($vieData['fields']) && is_array($vieData['fields'])) {
                                            foreach($vieData['fields'] as $field => $fieldType) {
                                                echo '<div class="form-group col-lg-12 mx-auto">';
                                                    echo '<label for="text">'.ucwords($field).'</label>';
                                                    switch ($fieldType) {
                                                        case 'textarea' :
                                                            echo '<textarea class="form-control" name="'.$field.'" >';
                                                                echo $vieData['formData'][$field] ?? '';
                                                            echo '</textarea>';
                                                            break;
                                                        case 'text' :
                                                        default     :
                                                            echo '<input class="form-control" type="text" name="'.$field.'" value="';
                                                                echo $vieData['formData'][$field] ?? '';
                                                            echo '" />';
                                                            break;
                                                    } // end: switch
                                                echo '</div>';
                                            } // end: foreach
                                        } // end: if
                                    echo '</div>';

                                    echo '<div class="row">
                                                <div class="col-lg-3 mx-auto">
                                                    <button type="submit"  class="btn btn-primary">Confirm and Save</button>
                                                </div>
                                          </div>';

                                echo '</form>';
                            endif;
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