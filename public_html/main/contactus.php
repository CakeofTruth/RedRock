<!DOCTYPE html>
<html>
<script src="contactform.js"></script>
<?php
	$pagetitle = "Contact Us";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
?>
<link rel='stylesheet' id='custom-css'  href='/css/contactform.css' type='text/css' media='all' />
<body>
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
<?php include $root . '/main/footer.php'?>
</body>
</html>
<!--http://code.tutsplus.com/tutorials/build-a-neat-html5-powered-contact-form--net-20426  -->