<html>
<head>
<style>
*, *:before, *:after
{
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}

html, body
{
    width: 100%;
    height: 100%;
    
    margin: 0;
    padding: 0;
 
}

body
{
    font-size: 14px;
    /* Helvetica/Arial-based sans serif stack */
    font-family: Frutiger, "Frutiger Linotype", Univers, Calibri, "Gill Sans", "Gill Sans MT", "Myriad Pro", Myriad, "DejaVu Sans Condensed", "Liberation Sans", "Nimbus Sans L", Tahoma, Geneva, "Helvetica Neue", Helvetica, Arial, sans-serif;

}

.flexbox-parent
{
	overflow: hidden;
    width: 100%;
    height: 100%;

    display: flex;
    flex-direction: column;
    
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
}

.flexbox-item
{
    padding: 0px;
}
.flexbox-item-grow
{
    flex: 1; /* same as flex: 1 1 auto; */
}
.fill-area
{
    
    display: flex;
    flex-direction: row;
    
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
    
}
.fill-area-content
{
    padding-top: 0%;
    padding-bottom: 0%;
    /* Needed for when the area gets squished too far and there is content that can't be displayed */
    overflow: hidden; 
}
</style>
</head>
<body>
<div class="flexbox-parent">
        <?php 
$pagetitle = "Portal";
error_reporting(E_ERROR | E_PARSE);
include ($_SERVER ["DOCUMENT_ROOT"] . '/portal/portalheader.php');
	session_start();
	$root = $_SERVER ["DOCUMENT_ROOT"];
?>

    
    <div class="flexbox-item fill-area content flexbox-item-grow">
        <div class="fill-area-content flexbox-item-grow">
            <br /><br />
           <h2>Welcome, <?php echo $_SESSION["First_Name"]; echo " " . $_SESSION["Last_Name"]?> </h2>
            <br /><br />      
        </div>
    </div>
        <!--Footer-->
<div class="flexbox-item footer">        
<div class="footer_wrapper" id="contact">
  <div class="container">
    <div class="service_wrapper">
      <div class="row">
        <div class="col-lg-4">
          <div class="service_block">
          <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp; color: #888888;">About Us</h3>
           <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown; color: #8b0000;"> Red Rock Telecommunications is a built from scratch Cloud solutions company delivering resilient communications networks with the latest generation Avaya and Metaswitch technology. </p>
          </div>
        </div>
        <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp; color: #888888;">Navigation</h3>
            <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;"></p>
            <ul id="menu-widget-footer" class="menu" style="list-style: none; padding-left: 0;">

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/whycloud.php">Why the Cloud?</a>
                                </li>

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/mobileintegration.php">Mobile Integration</a>
                                </li>

                                <li class="menu-item menu-item-type-post_type">
                                    <a href="/main/contactcenter.php">Contact Center</a>
                                </li>

                                
                                <li class="menu-item menu-item-type-custom">
                                    <a href="/main/contactus.php">Get in Touch</a>
                                </li>

                                <li class="menu-item menu-item-type-custom">
                                    <a href="/accounts/login.php">Resources</a>
                                </li>
                            </ul>
            </div>
            </div>
            <div class="col-lg-4 borderLeft">
          <div class="service_block">
            <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp; color: #888888;">Contact Us</h3>
            <p class="animated fadeInDown wow animated" style="visibility:visible; animation:fadeInDown;">
            <a href="https://www.google.com/maps/place/3719+E+La+Salle+St,+Phoenix,+AZ+85040/@33.3965694,-112.0023446,17z/data=
            !4m5!3m4!1s0x872b0fa0817dfa69:0x9e48d73f5106c6fa!8m2!3d33.3965649!4d-112.0001559!6m1!1e1">Address: 3719 E La Salle St. Phoenix, AZ, 85040</a></p>
            <p><a href="tel:6028028400">Front Desk: (602)802-8400 </a></p>
            <p><a href="tel:6028028450">Customer Service: (602)802-8450</a></p>
            <p><a href="mailto:redrock@redrocktelecom.com?Subject=More%20Information" target="_top">
												Email: redrock@redrocktelecom.com</a></p>
            </div>
            </div>
      </div>
	   </div>
      <div class="footer_bottom"><span>Copyright 2016, Template by <a href="http://webthemez.com">WebThemez.com</a>. </span> </div>
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
	</div>
   </body>
   </html>