        <?php
        // Check to ask for dev or prod info
        $hostname = getenv('HTTP_HOST');

        //variables

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";

        // Create connection
        if (!is_null($servername)){
            if (!is_null($username)){
                if (!is_null($password)){
                    if (!is_null($dbname)){
                        $conn = new mysqli($servername, $username, $password, $dbname);
                    } else {
                        die("Connection failed: database not specified");
                    }
                } else {
                    die("Connection failed: password not specified");
                }
            } else {
                die("Connection failed: username not specified");
            }
        } else {
            die("Connection failed: Server/host not specified");
        }

        // Sql to check if table exists
        $sql_sub_check_table = "SELECT * FROM `subscribers`";
        // Sql to check if table exists
        $sql_sub_create_table = "CREATE TABLE `subscribers` (`Personid` int NOT NULL AUTO_INCREMENT, `email` VARCHAR(1000) NOT NULL, PRIMARY KEY (Personid)) ENGINE = InnoDB;";
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed due to: " . $conn->connect_error);
        }
        else {
            //Execute query and save variable
            $checked_sub_table = null;
            try {
                $checked_sub_table = $conn->query($sql_sub_check_table);
            } catch (Exception $execution_error){
                $check_sub_table_creation = null;
                try {
                    $check_sub_table_creation = $conn->query($sql_sub_create_table);
                } catch (Exception $error) {
                    die("Not able to create table in database.\n".$error);
                }
            }
        }

        $subscribe_id = null;
        $type_of_action = "";

        //Code to add a row into the database

        $subscribe_email = "";
        $subscribe_query = null;
        $type_of_action = "";

        if(isset($_POST['SubscribeButton'])){
            $subscribe_email = $_POST["email"];
            $subscribe_sql = "INSERT INTO `subscribers` (email) VALUES ('".$subscribe_email."')";;
            $subscribe_query = $conn->query($subscribe_sql);
            $type_of_action = "Add";
        }

        //Code to erase a row in the database

        if(isset($_POST['DeleteSubscriberButton'])){
            $subscriber_id = $_POST["DeletePersonid"];
            $subscribe_sql = "DELETE FROM `subscribers` WHERE Personid=".$subscriber_id.";";;
            $subscribe_query = $conn->query($subscribe_sql);
            $type_of_action = "Delete";
        }

        ?>
<html lang="es">
    <head>
        
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>PHP CRUD</title>

        <!-- Favicons -->
        <link href="docs/img/phpicon.png" rel="icon">
        <link href="docs/img/phpicon.png" rel="apple-touch-icon">

        <!-- CSS assets -->
        <link href="assets/css/main.css" rel="stylesheet" type="text/css">
        
        <!-- CSS bootstrap icons - CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    </head>
    <body class="index-page">
        <header id="header" class="header d-flex align-items-center sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center">
                <h1 class="sitename">PHP CRUD</h1>
            </a>
            </div>
        </header>
        <main class="main">
            <!-- About 2 Section -->
            <section id="about-2" class="about-2 section light-background">
                <div class="container">
                    <div class="content">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4">
                                <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                                    <div class="img">
                                    <img src="assets/img/CRUD.jpg" alt="circle image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="offset-md-0 offset-lg-1 col-sm-12 col-md-5 col-lg-5 col-xl-4" data-aos="fade-up">
                                <div class="px-3">
                                    <span class="content-subtitle">Tips para cuando prácticas yoga en casa</span>
                                    <h2 class="content-title text-start">
                                    La mejor forma de regalar bienestar. Ofrece momentos de calma, energía y conexión con nuestras tarjetas regalo
                                    </h2>
                                    <p class="lead">
                                    Designa una hora del día y se constante.
                                    </p>
                                    <br/>
                                </div>
                                <br/>
                                <div class="row">
                                    <!-- Form for subscribers -->
                                    <form action="" method="post">
                                        <div class="row container">
                                            <div class="col-md-12 form-group">
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required />
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button name="SubscribeButton" class="btn btn-primary" type="submit">Add data</button>
                                        </div>
                                    </form>
                                    <!-- End of Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /About 2 Section -->
            <section id="information" class="section">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <p>Information from the database</p>
                    <h2>Information from the database</h2>
                </div>
                <div class="container">
                    <hr/>
                </div>
                <!-- End Section Title -->
                <div class="container">
                    <div class="row">
                        <?php
                        if(isset($_POST['EditSubscriber'])){
                            $subscribe_id = $_POST["EditPersonid"];
                            $type_of_action = "Edit";
                        } 

                        if ($type_of_action == "Edit"){
                            if ($subscribe_id != null){
                                echo '
                                    <form action="" method="post">
                                        <div class="row container">
                                            <div class="form-group">
                                                <input type="email" name="editemail" class="form-control" id="editemail" placeholder="Your Email" required />
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row container">
                                            <div class="form-group">
                                                <button name="FinalEdit" class="btn btn-primary" type="submit">Finish Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                ';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <br/>
                    </div>
                </div>
                <div class="container">
                    <div class="my-3">
                        <?php
                            if(!is_null($subscribe_query)){
                                if ($type_of_action == "Add"){
                                    echo "
                                    <div class='alert alert-success' role='alert'>
                                        We just saved your email in the database: $subscribe_email !
                                    </div>";
                                }
                                if ($type_of_action == "Delete"){
                                    echo "
                                    <div class='alert alert-success' role='alert'>
                                        We have deleted that comment from the database!
                                    </div>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="container">
                    <?php
                    $res = $conn->query($sql_sub_check_table);
                    if ($res) { 
                        if ($res->num_rows > 0) { 
                            echo "<div class='row'>";
                            while ($row = $res->fetch_array())  
                            { 
                                echo '
                                <div class="col-lg-4 p-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Person on file / ID: '.$row['Personid'].'</h5>
                                            <p class="card-text">The email we have on file for this item is: &#32; &#32; '.$row['email'].'.</p>
                                            <form action="" method="post">
                                                <input type="hidden" name="EditPersonid" value="'.$row['Personid'].'">
                                                <button name="EditSubscriber" class="btn btn-primary" type="submit"> Edit </button>
                                            </form>
                                            <form action="" method="post">
                                                <input type="hidden" name="DeletePersonid" value="'.$row['Personid'].'">
                                                <button name="DeleteSubscriberButton" class="btn btn-danger" type="submit"> Delete </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                ';
                            } 
                            echo '</div>'; 
                            //$res->free(); 
                        } 
                        else { 
                            echo "No matching records are found."; 
                        } 
                    } 
                    else { 
                        die("ERROR: Could not able to execute $sql. " .$mysqli->error); 
                    }
                    //Code to edit a row in the database
                    ?>
                </div>
            </section>
        </main>
        <footer id="footer" class="footer light-background">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4 col-lg-4 mb-3 mb-md-0">
                    <div class="widget">
                        <h3 class="widget-heading">Sobre nosotros</h3>
                        <p class="mb-4">
                            Somos un centro de crecimiento personal, un espacio para encontrar la paz interior, desarrollar flexibilidad, fuerza, tono muscular y autoconfianza.
                        </p>
                        <p class="mb-0">
                        <a href="contact.php" class="btn-learn-more">Saber más</a>
                        </p>
                    </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pl-lg-5">
                        <div class="widget">
                            <h3 class="widget-heading">Recent Posts</h3>
                            <ul class="list-unstyled footer-blog-entry">
                            <li>
                                <span class="d-block date">Comienzos del año 2018</span>
                                <a href="#">Abrimos nuestra primera sucursal en la ciudad de Ambato, en el sector de Miraflores. Donde se daban clases de distintos estilos.</a>
                            </li>
                            <li>
                                <span class="d-block date">Finales del año 2022</span>
                                <a href="#">Mudamos nuestros servicios a Costa Rica.</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pl-lg-5">
                        <div class="widget">
                            <h3 class="widget-heading">Conócenos</h3>
                            <ul class="list-unstyled social-icons light mb-3">
                            <li>
                                <a href="#"><span class="bi bi-facebook"></span></a>
                            </li>
                            <li>
                                <a href=""><span class="bi bi-instagram"></span></a>
                            </li>
                            <li>
                                <a href="mailto:adrianadanza@gmail.com"><span class="bi bi-google"></span></a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

<?php 
$conn->close();
?>