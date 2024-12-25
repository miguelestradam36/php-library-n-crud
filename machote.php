        <?php
        // Check to ask for dev or prod info
        $hostname = getenv('HTTP_HOST');

        //variables
        $servername = "";
        $username = "";
        $password = "";
        $dbname = "";
        if ($hostname != 'localhost' && $hostname != ''){
            $servername = "sql113.infinityfree.com";
            $username = "epiz_31086154";
            $password = "J8VVRquVikbFW";
            $dbname = "epiz_31086154_balance_db";
        } else {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test";
        }

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
        $sql_sub_create_table = "CREATE TABLE `subscribers` (`email` VARCHAR(1000) NOT NULL ) ENGINE = InnoDB;";

        // Sql to check if table exists
        $sql_check_table = "SELECT * FROM `comments`";
        // Sql to check if table exists
        $sql_create_table = "CREATE TABLE `comments` ( `name` VARCHAR(10000) NOT NULL , `comment` VARCHAR(10000) NOT NULL , `time` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = MyISAM;";
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed due to: " . $conn->connect_error);
        }
        else {
            //Execute query and save variable
            $checked_table = null;
            try {
                $checked_table = $conn->query($sql_check_table);
            } catch (Exception $execution_error){
                $checked_tables_creation = null;
                try {
                    $checked_tables_creation = $conn->query($sql_create_table);
                } catch (Exception $error) {
                    die("Not able to create table in database.\n".$error);
                }
            }
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

        $subscribe_email = "";
        $subscribe_query = null;

        $name = "";
        $message = "";
        $time = "";
        $query = null;

        if(isset($_POST['SubmitButton'])){
            $name = $_POST["name"];
            $message = $_POST["message"];
            $time = time();
            $sql = "INSERT INTO `comments` (name, comment, time) VALUES ('".$name."', '".$message."', '".$time."')";;
            $query = $conn->query($sql);
        }

        if(isset($_POST['SubscribeButton'])){
            $subscribe_email = $_POST["subemail"];
            $subscribe_sql = "INSERT INTO `subscribers` (email) VALUES ('".$subscribe_email."')";;
            $subscribe_query = $conn->query($subscribe_sql);
        }

        ?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Balance Wellness Center - Costa Rica</title>

        <!-- Favicons -->
        <link href="assets/img/favicon.jpg" rel="icon">
        <link href="assets/img/apple-touch-icon.jpg" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">

        <!-- =======================================================
        * Template Name: Active
        * Template URL: https://bootstrapmade.com/active-bootstrap-website-template/
        * Updated: Aug 07 2024 with Bootstrap v5.3.3
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>
    <body class="index-page">
        <header id="header" class="header d-flex align-items-center sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center">
                <h1 class="sitename">Balance Wellness Center</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            </div>
        </header>
        <main class="main">

            <!-- About Section -->
            <section id="about" class="about section">

            <div class="container">
                <div class="row align-items-center justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2" data-aos="fade-up" data-aos-delay="400">
                    <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                            "slidesPerView": 1,
                            "spaceBetween": 40
                            },
                            "1200": {
                            "slidesPerView": 1,
                            "spaceBetween": 1
                            }
                        }
                        }
                    </script>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                        <img src="assets/img/balance.jpg" alt="Image" class="img-fluid">
                        </div>
                        <div class="swiper-slide">
                        <img src="assets/img/past.jpg" alt="Image" class="img-fluid">
                        </div>
                        <div class="swiper-slide">
                        <img src="assets/img/interview.jpg" alt="Image" class="img-fluid">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-1">
                    <span class="section-subtitle" data-aos="fade-up">Bienvenido</span>
                    <h1 class="mb-4" data-aos="fade-up">
                    Ubicados en Costa Rica, San José
                    </h1>
                    <p data-aos="fade-up">
                    Contáctanos y agenda tu rutina de clases exclusivas de Balance Wellness Center, empieza hoy mismo.
                    </p>
                    <p class="mt-5" data-aos="fade-up">
                    <a href="contact.php" class="btn btn-get-started">Saber más</a>
                    </p>
                </div>
                </div>
            </div>
            </section><!-- /About Section -->

            <!-- About 2 Section -->
            <section id="about-2" class="about-2 section light-background">

            <div class="container">
                <div class="content">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4">
                    <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                        <div class="img">
                        <img src="assets/img/index.jpg" alt="circle image" class="img-fluid">
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
                        <p class="mb-5">
                        Tu cuerpo es tú maestro, escucha tu cuerpo. Respeta tús límites y poco a poco lograrás expandirlos sin lesiones.
                        </p>
                        <p>
                        <a href="contact.php" class="btn-get-started">Saber más</a>
                        </p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </section>
            <!-- /About 2 Section -->
            <!-- Seccion de comentarios -->
            <section id="contact" class="contact section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <p>Recent comments</p>
                <h2>Recent comments</h2>
            </div>
            <div class="container">
                <?php
                $res = $conn->query($sql_check_table);
                if ($res) { 
                    if ($res->num_rows > 0) { 
                        echo "<div class='list-group'>";
                        while ($row = $res->fetch_array())  
                        { 
                            echo '
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">'.$row['name'].'.</h5>
                                    <small>'.$row['time'].'</small>
                                </div>
                                <p class="mb-1">'.$row['comment'].'</p>
                                <small>We see your comments!</small>
                            </a>
                            ';
                        } 
                        echo '</div>'; 
                        $res->free(); 
                    } 
                    else { 
                        "No matching records are found."; 
                    } 
                } 
                else { 
                    die("ERROR: Could not able to execute $sql. " .$mysqli->error); 
                } 
                ?>
            </div>
            <!-- End Section Title -->
            <div class="container" data-aos="fade">
            <br/>
            <span class="content-subtitle">Add comment</span>
            <h2 class="content-title">Add your comment in our website!</h2>
            <p class="lead">
              Leave your comment regarding our classes or website
            </p>
            <div class="col-lg-8">
                <form action="" method="post">

                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                    </div>
                </div>

                <div class="form-group mt-3">
                    <textarea class="form-control" name="message" id="message" placeholder="Message" required=""></textarea>
                </div>

                <div class="my-3">

                    <div id="error-message" class="error-message"></div>

                    <div id="sent-message" class="sent-message">
                    <?php
                        if(!is_null($query)){
                            echo "
                            <div class='alert alert-success' role='alert'>
                                Guardamos tu comentario $name !
                            </div>";
                        }
                    ?>
                    </div>

                </div>

                
                <div class="text-center">
                    <button name="SubmitButton" class="btn btn-primary" type="submit">Comment</button>
                </div>

                </form>

            </div><!-- End Contact Form -->
            </div>
            </section>
            <!-- Seccion de comentarios final -->
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

                <div class="widget">
                    <div class="footer-subscribe">
                    <h3 class="widget-heading">Suscribete</h3>
                    <form action="" method="post">
                        <div class="mb-2">
                            <input type="email" class="form-control" name="subemail" placeholder="Tu correo">

                            <button name="SubscribeButton" type="submit" class="btn btn-link">
                                <span class="bi bi-arrow-right"></span>
                            </button>

                            <div id="error-message" class="error-message"></div>

                            <div id="sent-message" class="sent-message">
                            <?php
                                if(!is_null($subscribe_query)){
                                    echo "
                                    <div class='alert alert-success' role='alert'>
                                        Guardamos tu correo $subscribe_email te contactaremos prontamente !
                                    </div>";
                                }
                            ?>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>

            <div class="copyright d-flex flex-column flex-md-row align-items-center justify-content-md-between">
                <div class="row">
                    <div class="container">
                        <div class="credits">
                            <!-- All the links in the footer should remain intact. -->
                            <!-- You can delete the links only if you've purchased the pro version. -->
                            <!-- Licensing information: https://bootstrapmade.com/license/ -->
                            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                        <a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="admin.php"><i class="bi bi-database-lock"></i> &nbsp; Log-in to managers section</a>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </footer>
        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

        <!-- Main JS File -->
        <script src="assets/js/main.js"></script>
    </body>
</html>

<?php 
$conn->close();
?>