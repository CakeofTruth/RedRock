<?php
	$pagetitle = "About Us";
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
	<div id="primary" class="sidebar-no">
	<div class="container group">
	<div class="row">
	<div id="content-page" class="span 12 content group">
	<div id="post-302" class="post-302 page type-page status-publish hentry group">
	<h2> What makes Red Rock different? </h2>
	<div class="three-fourth">
		<p>
			Red Rock Telecommunications is a built from scratch Cloud solutions company delivering resilient communications networks with the latest generation
			Avaya and Metaswitch technology.  We provide businesses with Hosted Service for the deployment of voice and multimedia Sessions over Internet Protocol.
		</p>
		<p>
			Our collaboration and engagement with our clients enhances productivity, increases profitability, and improves brand image.
			Our executive and engineering teams created the second largest telecommunications company in Arizona with 99.9% client satisfaction and zero churn
			over a ten year period.
		</p>
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