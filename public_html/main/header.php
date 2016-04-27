<?php
	session_start();
	$root = $_SERVER ["DOCUMENT_ROOT"];
	if(empty($_SESSION['exists'])){
		//Handle new sessions here
		$_SESSION["loggedin"] = 0;
		$_SESSION['exists'] = true;
		echo "new session";
	}else{
		echo "old session";
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />

    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

    <title>Red Rock Telecommunications</title>

    <!-- RESET STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css" />
    <!-- BOOTSTRAP STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.css" />
    <!-- MAIN THEME STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <!-- [favicon] end -->

    <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
    <!-- For iPad3 with retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x.png" />
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x.png" />
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x.png">
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-57x.png" />
    <link rel='stylesheet' id='thickbox-css'  href='/js/thickbox/thickbox.css' type='text/css' media='all' />
    <link rel='stylesheet' id='usquare-css-css'  href='/sliders/usquare/css/frontend/usquare_style.css' type='text/css' media='all' />
    <link rel='stylesheet' id='google-fonts-css'  href='http://fonts.googleapis.com/css?family=Playfair+Display%7COpen+Sans+Condensed%3A300%7COpen+Sans%7CShadows+Into+Light%7CMuli%7CDroid+Sans%7CArbutus+Slab%7CAbel&#038;ver=3.5.1' type='text/css' media='all' />
    <link rel='stylesheet' id='responsive-css'  href='/css/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' id='polaroid-slider-css'  href='/sliders/polaroid/css/polaroid.css' type='text/css' media='all' />
    <link rel='stylesheet' id='shortcodes-css'  href='/css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' id='contact-form-css'  href='/css/contact_form.css' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-css'  href='/css/custom.css' type='text/css' media='all' />
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <style type="text/css">
            body { background-color: #ffffff; background-image: url('/assets/images/sandtexture6.png'); background-repeat: repeat; background-position: top left; background-attachment: scroll; }
    </style>

    <script type='text/javascript' src='/js/jquery/jquery.js'></script>
    

</head>
<!-- END HEAD -->
<!-- START BODY -->
<body class="home page no_js responsive stretched">

<!-- START BG SHADOW -->
<div class="bg-shadow">

<!-- START WRAPPER -->
    <div id="wrapper" class="container group">

        <!-- START TOP BAR -->
        <div id="topbar">
            <div class="container">
                <div class="row">
                    <div id="nav" class="span12 light">

                        <!-- START MAIN NAVIGATION -->

                        <ul id="menu-menu" class="level-1">
							<li><a href="/"><font color="#ffffff">Home</font></a></li>
							<li><a href="/main/aboutus.php"><font color="#ffffff">About Us</font></a>
							<li><a href="http://support.redrocktelecom.com"><font color="#ffffff">Customer Service</font></a></li>
							<li><a href="/main/contactus.php"><font color="#ffffff">Contact Us</font></a></li>
                        </ul>
                        <!-- END MAIN NAVIGATION -->
                        </div>
                </div>
            </div>
        </div>
         <!-- END TOP BAR -->

    <!-- START HEADER -->
    <div id="header" class="group margin-bottom">

        <div class="group container">
            <div class="row" id="logo-headersidebar-container">
                <!-- START LOGO -->
                <div id="logo" class="span8 group">
                    <a id="logo-img" href="/" title="Red Rock">
                        <img src="\assets\images\Redrocklogo.jpg" title="Red Rock" alt="Red Rock" />
                    </a>
					<p id='tagline'>The Future is Now- Cloud Based Telephone Services</p>
                </div>
                <!-- END LOGO -->

                <!-- START HEADER SIDEBAR -->
                <div id="header-sidebar" class="span4 group">
                    <div class="widget-first widget header-text-image">
                        <div class="text-image" style="text-align:left">
                            <img src="/images/phone1.png" alt="CUSTOMER SUPPORT" />
                        </div>
                        <div class="text-content">
                            <h3><font color="#ffffff">CUSTOMER SUPPORT</font></h3>
                            <p><a href="tel:602-802-8450"><font color="#ffffff">(602) 802-8450</font></a></p>
                        </div>
                    </div>
                    </div>
                    </div>
                 </div>
            </div>
        </div>
      </div>
