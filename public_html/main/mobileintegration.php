<?php
	$pagetitle = "Mobile Integration";
	session_start();
	$root = $_SERVER ["DOCUMENT_ROOT"];
	if(empty($_SESSION['exists'])){
		//Handle new sessions here
		$_SESSION["loggedin"] = 0;
		$_SESSION['exists'] = true;
	}
	?>
<!doctype html>
		<html class="csstransforms csstransforms3d csstransitions">
<head>
<style type="text/css">
html{overflow: scroll!important;}
body{margin:0px;}
.remove{float:right;}
.previewBar{
background: #232323;
border-bottom: #ef4612 solid 1px;
padding: 8px 10px;
height: 30px;
}
.brand{
float: left;
}
.brand > img{width:150px;}
.entry-header{display:none;}
.entry-content > p{margin:0px; padding:0px;}
#removeFrame{
float:right;
height: 16px;
margin: 0;
padding:6px 10px;
font-family: arial;
color:#fff;
text-decoration:none;
}
#downloadTemp{
padding: 6px 15px;
color: #fff;
font-size: 14px;
font-weight: bold;
text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.23);
text-align: center;
border-radius: 2px;
background: none repeat scroll 0% 0% #64850A;
transition: all 0.5s ease-in 0s;
float: right;
text-decoration: none;
font-family: arial;
}
#devices {
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
-ms-border-radius: 4px;
-o-border-radius: 4px;
border-radius: 4px;
-webkit-transition: all 200ms ease;
-moz-transition: all 200ms ease;
-ms-transition: all 200ms ease;
-o-transition: all 200ms ease;
transition: all 200ms ease;
position: absolute;
z-index: 1;
bottom: 8px;
left: 50%;
margin-left: -104px;
border: 1px solid #363738;
}
#devices a:first-of-type {
-webkit-border-radius: 4px 0 0 4px;
-moz-border-radius: 4px 0 0 4px;
-ms-border-radius: 4px 0 0 4px;
-o-border-radius: 4px 0 0 4px;
border-radius: 4px 0 0 4px;
}
#devices a {
background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #313131), color-stop(100%, #242424));
background: -webkit-linear-gradient(#313131,#242424);
background: -moz-linear-gradient(#313131,#242424);
background: -o-linear-gradient(#313131,#242424);
background: -ms-linear-gradient(#313131,#242424);
background: linear-gradient(#313131,#242424);
-webkit-box-shadow: inset 0 1px 0 #3c3c3c;
-moz-box-shadow: inset 0 1px 0 #3c3c3c;
box-shadow: inset 0 1px 0 #3c3c3c;
text-decoration: none;
border: 1px solid #040404;
border-right-width: 0;
float: left;
display: block;
width: 40px;
height: 30px;
outline: none;
}
#devices .tablet-portrait span, #devices .smartphone-landscape span {
-webkit-transform: rotate(90deg);
-moz-transform: rotate(90deg);
-ms-transform: rotate(90deg);
-o-transform: rotate(90deg);
transform: rotate(90deg);
}
#devices span {
text-align: center;
display: block;
width: 40px;
height: 30px;
text-indent: -9999px;
opacity: .75;
}
#devices a:last-of-type {
-webkit-border-radius: 0 4px 4px 0;
-moz-border-radius: 0 4px 4px 0;
-ms-border-radius: 0 4px 4px 0;
-o-border-radius: 0 4px 4px 0;
border-radius: 0 4px 4px 0;
border-right-width: 1px;
}
#devices .tablet-portrait span, #devices .tablet-landscape span {
background:transparent url(../wp-includes/images/tablet-landscape.png) 50% 50% no-repeat;
}
#devices .tablet-portrait span, #devices .tablet-landscape span {
background:transparent url(../wp-includes/images/tablet-portrait.png) 50% 50% no-repeat;
}
#devices .smartphone-portrait span, #devices .smartphone-landscape span {
background:transparent url(../wp-includes/images/iphone-landscape.png) 50% 50% no-repeat;
}
#devices .smartphone-portrait span, #devices .smartphone-landscape span {
background:transparent url(../wp-includes/images/iphone-portrait.png) 50% 50% no-repeat;
}
#devices .auto span {
text-indent: 0;
line-height: 30px;
text-transform: uppercase;
font-size: 10px;
}
.resizeDevice{
transition: all 0.5s ease-in-out;
margin: 2% auto;
-moz-box-shadow: 0 0 12px 1px #000;
-webkit-transform: translate3d(0, 0, 0);
background: #333;
margin: 10px auto;
-webkit-border-radius: 3em;
-moz-border-radius: 3em;
border-radius: .5em;
padding: 1em;
text-align: center;
}
#devices  > a{
color:#fff;
}
.devActive{
background:#4b4b4b !important;
}
.dc-banner-ads {
    display: block;
    margin: 10px auto 10px;
    background: #fff;
    border: 0;
    width: 728px;
    height: 90px;
text-align:center;
display:none;
}
@media(max-width:650px){
	#devices{
		display:none;
	}
}
</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.js"></script>
<script>
$(function(){
	var myString = window.location.href;
	var mySplitResult = myString.split("?");
	var thisUrl = mySplitResult.slice(1);
	$('#previewFrame').attr('src','/main/newindex.php'+ thisUrl);
	$('#removeFrame').attr('href', '/main/newindex.php'+ thisUrl);
	$('#downloadTemp').attr('href', '/main/newindex.php'+ thisUrl);
	$('#mainHome').attr('href', '/main/newindex.php');
$('#devices').on('click', '> a', function(){
$('#devices').find('a').removeClass('devActive');
$(this).addClass('devActive');
		var deviceVal = $(this).attr('data-role');
		$('#previewTemp .entry-content').addClass('resizeDevice');
			if(deviceVal == 'tl'){
				$('#previewTemp .entry-content').css({'width': '1024px', 'height':'768px'});
			} else if(deviceVal == 'tp'){
				$('#previewTemp .entry-content').css({'width': '768px', 'height':'1024px'});
			} else if(deviceVal == 'sl'){
				$('#previewTemp .entry-content').css({'width': '480px', 'height':'340px'});
			} else if(deviceVal == 'sp'){
				$('#previewTemp .entry-content').css({'width': '320px', 'height':'480px'});
			} else if(deviceVal == 'auto'){
				$('#previewTemp .entry-content').css({'width': '100%', 'height':'auto'});
				$('#previewTemp .entry-content').removeClass('resizeDevice');
			}
	});
});
</script>
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
		<header class="entry-header">
			<h1 class="entry-title">Preview</h1>
		</header>
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
<!--Aboutus-->
<section id="aboutUs">
<div class="inner_wrapper">
  <div class="container">
    <h2>How Can I Unify My Communications</h2>
    <div class="inner_section">
	<div class="row">
      <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right"><img src="/assets/images/accessionmeeting2.png" class="img-circle delay-03s animated wow zoomIn" style="visibility: visible; animation-name: zoomIn;"></div>
      	<div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
        	<div class=" delay-01s animated fadeInDown wow animated animated" style="visibility:visible; animation-name: fadeInDown;">
			<h3> Red Rock's app for mobile and desktop enables you to integrate voice, instant messaging, video, and email into a single 
			cross platform user experience.</h3><br>
			<h3>Accession will become the primary means by which your employees communicate.</h3>
			<h4>Save Time, Do More</h4>
            <p>It can be the difference
				between winning or losing business. So no matter how small your business, you should have access
				to the same features and professional functionality of a big company. With Hosted Voice, Red Rock
				delivers a best-in-class phone system with all the bells and whistles of a big company phone system
				- all at an incredibly attractive price.</p> <br>
			<ul style="list-style-type:square">
				<li> <strong>Call from anywhere.</strong> Make and receive calls on your mobile as though you were at your desk. With single number convenience, the person you call will see your desk phone number. 
					 Now you can choose who sees your mobile number.  </li>
				<li> <strong>Receive calls on any device.</strong>When someone calls your primary number, the call will appear on one or more of the devices that you&rsquo;ve set up. 
					 This can include your desk phone, your mobile phone, your PC or Mac and tablet devices. You answer the call on whichever device is most convenient for you.</li>
				<li> <strong>Seamlessly transfer calls.</strong> Start a call on Wi-Fi, switch it to cellular if you move out of Wi-Fi coverage. Move a call to your fixed line when you arrive at the office. 
					 Take a call with you by switching it from your desk phone to your mobile, or even to your tablet. Save your mobile minutes for when you&rsquo;re actually mobile </li>
				<li> <strong>Call Manager.</strong>The call manager helps you with all these features. It also makes it easy to mute calls, transfer calls, make three-way calls, place calls on hold, record calls 
					 (where local laws permit) and adjust the microphone or headset volume.  </li>
				<li> <strong>Upgrade your calls</strong> to video If the person you&rsquo;re calling has a compatible service, you can choose to uplift the call to a video call.</li>
			</ul>
		<h4>Powerful Features, Easy to Use</h4>
		<ul style="list-style-type:square">
			<li><strong>Integrate your contacts.</strong> See and access all your contacts &ndash; including the corporate directory &ndash; in any device. Search, call and edit any of your contacts effortlessly 
				and keep them synchronized. Accession Communicator presents you with a consolidated list of contacts from several sources.</li>
			<li><strong>Visual Voicemail.</strong>Easily check your voice, video and fax messages. Your voice messages can even be translated into text so you can read them without dialing in to retrieve them. 
				Listen, delete or respond at the touch of a button. And now there&rsquo;s only one message center to check. Save time, respond faster.</li>
			<li><strong>Conference calls. </strong>It&rsquo;s simple to set up and manage audio conferences from your desktop.</li>
			<li><strong>Chat.</strong>You can use Accession Communicator to send instant messages to other people in your corporate directory who are using the same service, no matter what device they are using.</li>
			<li><strong>Softphone for your PC.</strong>Add a headset to your desktop or laptop then make and receive audio and video calls from your PC just like you would on your desk phone - 
				the person you&rsquo;re calling sees your usual desk phone number, as though you were calling from your desk.
			<li><strong>Security</strong> Accession Communicator is fully integrated into our advanced IP voice services network and provides reliable performance and great support. Your sensitive information is safeguarded with our industry 
				standard security and privacy measures.</li>
		</ul>
</div>
<div class="work_bottom"> <span>Want to know more?</span> <a href="/main/contactus.php" class="contact_btn">Contact Us</a> </div>
	   </div>

      </div>


    </div>
  </div>
  </div>
</section>
<!--Aboutus-->       
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