<!DOCTYPE html>
<html>
<script src="contactform.js"></script>
<?php
	session_start();	
	$pagetitle = "Contact Us";
	$root = $_SERVER ["DOCUMENT_ROOT"];
	if(empty($_SESSION['exists'])){
		//Handle new sessions here
		$_SESSION["loggedin"] = 0;
		$_SESSION['exists'] = true;
	}
?>
<link rel='stylesheet' id='custom-css'  href='/css/contactform.css' type='text/css' media='all' />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1">
<title>Red Rock Telecommunications</title>
<link rel="icon" href="/assets/images/Redrockfavicon.png" type="image/png">
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="/css/style.css" rel="stylesheet" type="text/css">
<link href="/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="/css/animate.css" rel="stylesheet" type="text/css">

</head>
<body>
	<div id ="previewTemp">
		<div class ="dc-banner-ads">

		</div>
		<div id="post-6" class="post-6 page type-page status-publish hentry">
		<div class="entry-content post_content" style="width: 100%; height: auto;"></div>
					<!--Header_section-->
<header id="header_wrapper" class="scroll-to-fixed-fixed" style="z-index: 1000; top: 0px; margin-left: 0px; width: 100%; left: 0px;">
  <div class="container">
    <div class="header_box">
      <div class="logo"><a href="/"><img src="/assets/images/redrocklogo.png" alt="Red Rock"></a></div>
	  <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
	    <div id="main-nav" class="collapse navbar-collapse navStyle" style="background:none;">
			<ul class="nav navbar-nav" id="mainNav">
			  <li class="active"><a href="/" class="scroll-link">Home</a></li>
			  <li><a href="/main/aboutus.php" class="scroll-link">About Us</a></li>
			  <li><a href="http://support.redrocktelecom.com" class="scroll-link">Customer Service</a></li>
			  <li><a href="/main/contactus.php" class="scroll-link">Contact Us</a></li>
			</ul>
      </div>
	 </nav>
    </div>
  </div>
</header>
<div id="contact-form" class="clearfix">
    <h1>Get In Touch!</h1>
    <h2>Want to know more about our products or get in touch with our customer service representatives?  Fill this out and we will get back to you soon.</h2>
  	  <?php
		//init variables
		$cf = array();
		$sr = false;
		if(isset($_SESSION['cf_returndata'])){
  			$cf = $_SESSION['cf_returndata'];
   			$sr = true;
		}
?>

    <ul id="errors" class="<?php echo ($sr === true && $cf['form_ok'] === false) ? 'visible' : ''; ?>">
    	<li id="info">There were some problems with your form submission:</li>
    		<?php
    			if(isset($cf['errors']) && count($cf['errors']) > 0) :
        			foreach($cf['errors'] as $error) :
    		?>
    	<li><?php echo $error ?></li>
    		<?php
        		endforeach;
    			endif;
    		?>
	</ul>

<p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Thanks for your message! We will get back to you ASAP!</p>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name">Name: <span class="required">*</span></label>
			<input type="text" id="name" name="name" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['name'] : '' ?>" placeholder="Jane Doe" required="required" autofocus="autofocus" />

			<label for="email">Email Address: <span class="required">*</span></label>
			<input type="email" id="email" name="email" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['email'] : '' ?>" placeholder="janedoe@example.com" required="required" />

			<label for="telephone">Telephone: </label>
			<input type="tel" id="telephone" name="telephone" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['telephone'] : '' ?>" />

		<label for="inquiry">Enquiry: </label>
			<select id="inquiry" name="inquiry" size="1">
    			<option value="a" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'General') ? "selected='selected'" : '' ?>>General</option>
    			<option value="b" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'Sales') ? "selected='selected'" : '' ?>>Sales</option>
    			<option value="c" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'Support') ? "selected='selected'" : '' ?>>Support</option>
    			<option value="d" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'Technical') ? "selected='selected'" : '' ?>>Technical questions</option>
			</select>

		<label for="message">Message: <span class="required">*</span></label>
			<textarea id="message" name="message" placeholder="Your message must be greater than 20 charcters" required="required" data-minlength="20"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?></textarea>

				<span id="loading"></span>
				<input type="submit" value="Submit" id="submit-button" />
				<p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
    </form>

   <?php unset($_SESSION['cf_returndata']); ?>
</div>
</div>
</div>
<!-- Footer Section -->
<div class="footer_wrapper" id="contact">
  <div class="container">
<section id="service">
<div class="container">
    <div class="service_wrapper">
      <div class="row">
        <div class="col-lg-4">
          <div class="service_block">
          <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">About Us</h3>
           <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;"> Red Rock Telecommunications is a built from scratch Cloud solutions company delivering resilient communications networks with the latest generation Avaya and Metaswitch technology. </p>
          </div>
        </div>
        <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">Navigation</h3>
            <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;">
            <ul id="menu-widget-footer" class="menu">

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/whycloud.php">Why the Cloud?</a>
                                </li>

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/mobileintegration.php">Mobile Integration</a>
                                </li>

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/contactcenter.php">Contact Center</a>
                                </li>

                                <!-- Taking this out until it's important enough to work on/include
                                <li class="menu-item menu-item-type-custom">
                                    <a href="/main/contactus.php">Get in Touch</a>
                                </li-->

                                <li class="menu-item menu-item-type-custom">
                                    <a href="/accounts/login.php">Resources</a>
                                </li>
                            </ul>
            </p>
            </div>
            </div>
            <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">Contact Us</h3>
            <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;">Address: 3719 E La Salle St. Phoenix, AZ, 85040</p>
            <p>Front Desk: (602)802-8400</p>
            <p>Customer Service: (602)802-8450</p>
            <p>Email: redrock@redrocktelecom.com</p>
            </div>
            </div>
      </div>
	   </div>
  </div>
</section>
      <div class="footer_bottom"><span>Copyright 2016, Template by <a href="http://webthemez.com">WebThemez.com</a>. </span> </div>
  </div>
</div>
		<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/jquery-scrolltofixed.js"></script>
        <script type="text/javascript" src="/js/jquery.nav.js"></script>
        <script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="/js/jquery.isotope.js"></script>
        <script type="text/javascript" src="/js/wow.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
<!--        <script src="/contact/jqBootstrapValidation.js"></script>-->
<!--        <script src="/contact/contact_me.js"></script>-->
</body>
</html>
<!--http://code.tutsplus.com/tutorials/build-a-neat-html5-powered-contact-form--net-20426  -->