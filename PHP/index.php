<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <?php
        session_start();
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>SmartHome :: IoT </title>
    <!--REQUIRED STYLE SHEETS-->
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--ANIMATED FONTAWESOME STYLE CSS -->
    <link href="assets/css/font-awesome-animation.css" rel="stylesheet" />
    <!-- VEGAS STYLE CSS -->
    <link href="assets/scripts/vegas/jquery.vegas.min.css" rel="stylesheet" />
    <!-- SIDE MENU STYLE CSS -->
    <link href="assets/css/component.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
<!--
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="cbp-spmenu-push">

    <!-- MAIN HEADING-->
    <div class="for-full-back color-bg-one" id="main-sec">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8 col-md-offset-2 ">
                    <h1 class="pad-adjust"><i class="fa fa-plus faa-pulse animated"></i>SmartHome</h1>
                </div>
            </div>
        </div>
    </div>
    <!--END MAIN HEADING-->

    <!--LEFT SLIDE MENU-->
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        <?php
            // Menu dinâmico "logado" e "não logado"
            include("menuLeft.php");

        ?>
    </nav>

    <div class="row" id="icon-left">
        <div class="col-md-12">
            <i id="showLeftPush" class="fa fa-lightbulb-o fa-4x faa-horizontal animated "></i>
        </div>
    </div>
    <!--END LEFT SLIDE MENU-->

    <!--RIGHT SLIDE MENU-->
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
        <h3>SOCIAL</h3>
        <a href="#">MY SOCIAL PRESENCE</a>
        <a href="#"><i class="fa fa-facebook fa-3x"></i>Facebook</a>
        <a href="#"><i class="fa fa-twitter fa-3x"></i>Twitter</a>
        <a href="#"><i class="fa fa-linkedin fa-3x"></i>Linked In</a>
        <a href="#"><i class="fa fa-google-plus fa-3x"></i>Google Plus</a>
    </nav>

    <div class="row" id="icon-right">
        <div class="col-md-12">
            <i id="showRightPush" class="fa fa-paperclip fa-4x "></i>
        </div>
    </div>
    <!--END RIGHT SLIDE MENU-->

    <!--CONTENT SECTION-->
    <section class="for-full-back color-light" id="content-sec">
        <div class="container">
            <div class="row text-center">
                <h1>Principal</h1>
                <div class="col-md-12 ">
                    <?php
                        /*
                            Verifica se o arquivo passado como parâmetro existe no sistema.
                            Caso contrário mostra o formulário de login.
                        */
                        if (is_file($_REQUEST['arquivo']))
                            include($_REQUEST['arquivo']);
                        else
                            include("formLogin.php");
                    
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTENT SECTION-->

    <!--ABOUT SECTION-->
    <section class="for-full-back color-bg-one" id="about-sec">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8 col-md-offset-2 ">
                    <h1><i class="fa fa-microphone faa-pulse animated  "></i>Sobre</h1>
                </div>
                <div class="row text-center">
                    <div class="col-md-8 col-md-offset-2 ">
                        <h4>
                            <strong>
                                SmartHome é um sistema destinado a automação residencial.<br>
                                Local onde você pode controlar sua casa com apenas alguns clicks.
                            </strong>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="for-full-back color-white" id="partners">
        <div class="container">
            <div class="row text-center g-pad-bottom">
                <div class="col-md-8 col-md-offset-2 ">
                    <h1>Nossos parceiros</h1>
                </div>

            </div>
            <div class="row text-center g-pad-bottom">
                <div class="col-md-12 ">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="team-member">
                            <img src="assets/img/partners/ifmaker.png" alt="">
                            <h3><strong>Espaço IFMaker</h3></strong>                            
                            <a href="https://www.youtube.com/@ifmaker.riopomba" target="_blank">Clique aqui</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="team-member">
                            <img src="assets/img/partners/ifgnu.png" alt="">
                            <h3><strong>Laboratório IFGnu</strong></h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="team-member">
                            <img src="assets/img/partners/dacc.png" alt="">
                            <h3><strong>DACC</strong></h3>
                            <a href="https://sistemas.riopomba.ifsudestemg.edu.br" target="_blank">Clique aqui</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="team-member">
                            <img src="assets/img/partners/if.png" alt="">
                            <h3><strong>DACC</strong></h3>
                            <a href="https://ifsudestemg.edu.br" target="_blank">Clique aqui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END ABOUT SECTION-->

    <!--CONTACT SECTION-->
    <section class="for-full-back color-bg-one" id="contact-sec">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8 col-md-offset-2 ">
                    <h1><i class="fa fa-globe faa-pulse animated  "></i>Contato</h1>
                </div>
                <div class="row text-center">
                    <div class="col-md-8 col-md-offset-2 ">
                        <h4>
                            <strong>
                            <i class="fa fa-mail-forward "></i> gustavo.reis@ifsudestemg.edu.br<br>
                                <i class="fa fa-phone  "></i> 0123456789
                            </strong>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- SOCIAL STATS SECTION-->
    <section>
        <div class="container">
            <div class="row g-pad-bottom">
                <div class="col-md-3 ">
                    <div class="social-stats-div">
                        <i class="fa fa-facebook fa-5x "></i>
                        <h3>2000+ Followers </h3>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="social-stats-div">
                        <i class="fa fa-twitter fa-5x "></i>
                        <h3>1900+ Tweets </h3>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="social-stats-div">
                        <i class="fa fa-google-plus fa-5x "></i>
                        <h3>1530+ Followers </h3>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="social-stats-div">
                        <i class="fa fa-linkedin fa-5x "></i>
                        <h3>3000+ Connections </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SOCIAL STATS SECTION-->

    <!--FOOTER SECTION -->
    <div class="for-full-back color-bg-one" id="footer">
        2022 www.smarthouse.com.br | All Right Reserved | Terms | Policies | Licenses 
         
    </div>
    <!-- END FOOTER SECTION -->

    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP CORE SCRIPT   -->
    <script src="assets/plugins/bootstrap.js"></script>
    <!-- SIDE MENU SCRIPTS -->
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="assets/js/classie.js"></script>
    <!-- VEGAS SLIDESHOW SCRIPTS -->
    <script src="assets/plugins/vegas/jquery.vegas.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
