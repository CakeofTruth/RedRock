<?php
	$pagetitle = "About Us";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
?>

	<div class="clear"></div>
        <!-- BEGIN FLEXSLIDER SLIDER -->
        <div id="slider-polaroid-0" class="slider slider-polaroid polaroid no-responsive" style="height:400px;">
            <div class="thumbs  container">
                <div class="thumb">
                    <img src="/assets/images/accessionphonethumbnail.png" alt="/assets/images/accessionphonethumbnail.png" />
                    <div class="slide-content container align-right" style="background-image:url('/assets/images/accessionphone1.png');">
                        <div class="text">
                            <h2>We Go Where You Go.</h2>
                            <p>
                                Across town or across the globe, we will ensure that you have access to everything you need to run your business smoothly.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="thumb">
                    <img src="/assets/images/phonecustomerthumbnail.png" alt="/assets/images/phonecustomer.png" />
                    <div class="slide-content container align-right" style="background-image:url('/assets/images/phonecustomer.png');">
                    	 <div class="container">
                    	 <div class="text">
                    	 <h2>Hosted Voice</h2>
                         <h4><span style="color: #434f5b;">The phone system you need. <br> A price you can afford. </span></h4>
                         	<p>The phone system you need <br> A price you can afford </p>
                        </div>
                    </div>
                </div>
                    	 
                </div>

                <div class="thumb">
                    <img src="/assets/images/accessionformatsthumbnail.png" alt="/assets/images/accessionformats.png" />
                    <div class="slide-content container align-right" style="background-image:url('/assets/images/accessionformats.png');">
                        <div class="text">
                            <h2>Nontraditional Business?</h2>
                            <p>
                                Try our nontraditional solutions.  Our mobile apps can be used on your computer, tablet, or smartphone.  So whether you are 
                                at a remote site, or simply want all of the amenities of your office at home, we have a solution for you.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="thumb">
                    <img src="/assets/images/contactcenterthumbnail.png" alt="/assets/images/contactcenter.png" />
                    <div class="slide-content container align-right full" style="background-image:url('/assets/images/contactcenter.png');">
                        <div class="container">
                            <div class="text">
                                <h2>
                                    <span style="color: #0c243d;">Need a Communications</span>
                                    <span style="color: #009E8E;">Solution?</span>
                                </h2>

                                <p>
                                    <span style="color: #434f5b;">Come meet Red Rock,</span>
                                    <br />
                                    <span style="color: #009E8E;">The last phone system you will ever need.</span>
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
                    <img src="/assets/images/teamworkthumbnail.png" alt="/assets/images/teamwork.png" />
                    <div class="slide-content container align-right" style="background-image:url('/assets/images/teamwork.png');">
                        <div class="text">
                            <h2>Move Your Business Into the Future</h2>
                            <p>
                               No matter the size of your business, you should have access to the same features and professional functionality of a big
                               company.
                            </p>
                        </div>
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
	<div class="two-third">
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
	<div class= "one-third last">
		<img src="/assets/images/accessionman.png">
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
<?php include $root . '/main/footer.php'?>