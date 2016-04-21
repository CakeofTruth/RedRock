<?php
	$pagetitle = "Avaya Solutions";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
?>
<div class="clear"></div>
        <!-- BEGIN FLEXSLIDER SLIDER -->
        <div id="slider-polaroid-0" class="slider slider-polaroid polaroid no-responsive" style="height:400px;">
            <div class="thumbs  container">
                <div class="thumb">
                    <img src="/assets/images/accessionmanthumbnail.png" alt="/assets/images/accessionmanthumbnail.png" />
                    <div class="slide-content container align-right" style="background-image:url('/assets/images/accessionman.png');">
                        <div class="text">
                            <h2>With Red Rock we go where you go.</h2>
                            <p>
                                Across town or across the globe, we will ensure that you have access to everything you need to run your business smoothly.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="thumb">
                    <img src="/assets/images/phonecustomerthumbnail.png" alt="/assets/images/phonelady.png" />
                </div>

                <div class="thumb">
                    <img src="/assets/images/accessionformatsthumbnail.png" alt="/assets/images/accessionformats.png" />
                    <div class="slide-content container align-right" style="background-image:url('/assets/images/accessionformats.png');">
                        <div class="text">
                            <h2>Nontraditional Business?</h2>
                            <p>
                                Try our nontraditional solutions.  Our mobile apps can be used on your computer, tablet, or smartphone.  So whether you are at a remote site,
                                or simply want all of the amenities of your office at home, we have a solution for you.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="thumb">
                    <img src="/images/slider/flexslider/0043-150x150.jpg" alt="/images/slider/flexslider/0043.jpg" />
                    <div class="slide-content container align-right full" style="background-image:url('/images/slider/flexslider/0043.jpg');">
                        <div class="container">
                            <div class="text">
                                <h2>
                                    <span style="color: #0c243d;">Need a Communications</span>
                                    <span style="color: #009E8E;">solution?</span>
                                </h2>

                                <p>
                                    <span style="color: #434f5b;">Come meet RedRock</span>
                                    <br />
                                    <span style="color: #007e71;">Flexible, versatile, and impeccable customer service</span>
                                </p>

                                <p>
                                    <span style="color: #434f5b;">
                                    A complete solution for your large or small business<br />
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="thumb">
                    <img src="/assets/images/hostedvoicethumbnail.png" alt="/assets/images/hostedvoice.png" />
                    <div class="slide-content container align-right full" style="background-image:url('/assets/images/hostedvoice.png');">
                        <div class="container"></div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#slider-polaroid-0').polaroid({
                    animation: '',
                    pause: 8000,
                    animationSpeed: 800			    });
            });
        </script>

        <div class="mobile-slider">
            <div class="slider fixed-image container">
                <img src="images/slider/flexslider/fixed-polaroid.jpg" alt="" />
            </div>
        </div>
	<div class="clear"></div>
	<div id="primary" class="sidebar-no">
	<div class="container group">
	<div class="row">
	<div id="content-page" class="span 12 content group">
	<div id="post-302" class="post-302 page type-page status-publish hentry group">
	<h2> Why Cloud? </h2>
	<div class="two-third">
		<p>
		Contact Centers increasingly see the benefits of moving their infrastructure into a cloud-based environment. 
		Since contact center equipment is costly to purchase and maintain, our cloud-based model enables you to purchase services in a more efficient manner, 
		buying only what you need.
		</p>
		<p>
			<ul style="list-style=type:circle">
				<li> Interactive Voice Response (IVR) and queueing functions through both Easy Attendant and Premium Auto Attendant </li>
				<li> Call routing algorithms include longest idle, round-robin, and first available </li>
				<li> Agent portal shows performance against KPIs </li>
				<li> Supervisor features include whisper, barge, and listen </li>
				<li> Administrative dashboard and reporting capabilities enable effective management and insight into call center performance </li>
			</ul>
	</div>
	<div class= "two-third">
		<p>
		</p>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
<?php include $root . '/main/footer.php'?>