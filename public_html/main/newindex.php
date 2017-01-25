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
<link rel="icon" href="favicon.png" type="image/png">
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
<!--Header_section-->
	<!--Hero_Section-->
<section id="hero_section" class="top_cont_outer">
  <div class="hero_wrapper">
    <div class="container">
      <div class="hero_section">
        <div class="row">
          <div class="col-lg-5 col-sm-7">
            <div class="top_left_cont zoomIn wow animated animated" style="visibility: visible; animation-name: zoomIn;">
              <h2>Need a <strong>Communications</strong> Solution?</h2>
              <p>Come meet Red Rock, the last phone system you will ever need.</p>
              <a href="/main/aboutus.php" class="read_more2">Read more</a> </div>
          </div>
          <div>
			<img src="/assets/images/contactcenterthumbnail.png" alt = "/assets/images/contactcenter.png" class="bannerImg zoomIn wow animated animated" style="visibility: visible; animation-name: zoomIn;" />
		  </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Hero_Section-->
<section id="aboutUs"><!--Aboutus-->
<div class="inner_wrapper">
  <div class="container">
    <h2>Why Cloud?</h2>
    <div class="inner_section">
	<div class="row">
      <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right"><img src="/assets/images/teamwork.png" class="img-circle delay-03s animated wow zoomIn" style="visibility: visible; animation-name: zoomIn;"></div>
      	<div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
        	<div class=" delay-01s animated fadeInDown wow animated animated" style="visibility:visible; animation-name: fadeInDown;">
			<h3> Providing a professional experience when your customers call is critical.</h3><br>
            <p>It can be the difference
				between winning or losing business. So no matter how small your business, you should have access
				to the same features and professional functionality of a big company. With Hosted Voice, Red Rock
				delivers a best-in-class phone system with all the bells and whistles of a big company phone system
				- all at an incredibly attractive price.</p> <br>
</div>
<div class="work_bottom"> <span>Want to know more?</span> <a href="/main/contactus.php" class="contact_btn">Contact Us</a> </div>
	   </div>

      </div>


    </div>
  </div>
  </div>
</section>
<!--Aboutus-->
<!--Service-->
<section  id="service">
  <div class="container">
    <h2>Services</h2>
    <div class="service_wrapper">
      <div class="row">
        <div class="col-lg-4">
          <div class="service_block">
            <div class="service_icon delay-03s animated wow  zoomIn animated" style="visibility:visible; animation-name:zoomIn;"> <span><i class="fa fa-mobile-phone"></i></span> </div>
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">Mobile Integration</h3>
            <p class="animated fadeInDown wow animated" style="visibility: visible; animation-name: fadeInDown;">Your working life moves constantly from desk to laptop to smartphone to iPad.
            Now you can use all the features of Red Rock phone services whether at your desk, at home or on the move. Look up your contacts,
            make and receive voice or video calls or chat with colleagues, no matter which device you are using or where you are. You can
            seamlessly move from device to device, or from cellular to Wi-Fi, even in the middle of a call.</p>
          </div>
        </div>
        <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <div class="service_icon icon2  delay-03s animated wow zoomIn animated" style="visibility:visible; animation-name: zoomIn;"> <span><i class="fa fa-cloud"></i></span> </div>
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name:fadeInUp;">Contact Center</h3>
            <p class="animated fadeInDown wow animated" style="visibility: visible; animation-name: fadeInDown;">Cloud Contact Center offers more functionality than traditional hardware at a fraction of the cost.
            Our Cloud Contact Center delivers a customizeable and easy to use call center solution so you can enhance your customer experience and
            deliver world class support.Cloud Contact Center can provide the reliability and security you require for mission-critical business applications.</p>
          </div>
        </div>
        <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <div class="service_icon icon3  delay-03s animated wow zoomIn animated" style="visibility: visible; animation-name: zoomIn;"> <span><i class="fa fa-html5"></i></span> </div>
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">Communications Solutions</h3>
            <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;">At Red Rock, we want to provide you with more than just a phone solution. We have many tools available
            to you so that you can ensure your business is run as efficiently as possible. Whether you cannot commit to the expense of purchasing and
            maintaining a phone system, but want all the perks that come with a traditional phone system, or you want to be able to collaborate on a
            project in real time with a colleague on the other side of the world, we have a solution that will fit your needs. </p>
          </div>
        </div>
      </div>
	   </div>
  </div>
</section>
<!--Service-->
<section class="page_section" id="clients"><!--page_section-->
  <h2>Partners</h2>
<!--page_section-->
<div class="client_logos"><!--client_logos-->
  <div class="container">
    <ul class="fadeInRight animated wow animated" style="visibility: visible; animation-name: fadeInRight;">
      <li><a href="javascript:void(0)"><img src="/assets/images/avayalogo.png" alt="Avaya"></a></li>
      <li><a href="javascript:void(0)"><img src="/assets/images/metaswitchlogo.png" alt="Metaswitch"></a></li>
<!--      <li><a href="javascript:void(0)"><img src="/assets/images/limelightlogo.png" alt="Limelight"></a></li>-->
<!--      <li><a href="javascript:void(0)"><img src="/assets/images/polycomlogo.png" alt="Polycom"></a></li>-->
<!--      <li><a href="javascript:void(0)"><img src="/assets/images/mitellogo.png" alt="Mitel"></a></li>-->
<!--      <li><a href="javascript:void(0)"><img src="/assets/images/adtranlogo.png" alt="Adtran"></a></li>-->
<!--      <li><a href="javascript:void(0)"><img src="/assets/images/simplewanlogo.png" alt="Simplewan"></a></li>-->
    </ul>
  </div>
</div>
</section>
<!--client_logos-->
<!--Footer-->
<div class="footer_wrapper" id="contact">
  <div class="container">
    <div class="footer_bottom"><span>Copyright � 2016, Template by <a href="http://webthemez.com">WebThemez.com</a>. </span> </div>
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
				
