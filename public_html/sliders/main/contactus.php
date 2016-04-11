<!DOCTYPE html>
<html>

<?php 
	$pagetitle = "Contact Us";
?>
<body>
	<?php include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php'); ?>
	<div id="content-home" class="span12 content group">
	<div class= "page type-page status-publish hentry group">
	<div class="row">
	<div class="section blog margin-bottom span12">
	<div class="the-content span3">
	<div class="clear space"></div>
	<h3>Get in touch</h3>
		<form class="contact-form row" method="post" action="" enctype="multipart/form-data">
				 <div class="usermessagea"></div>
                            <fieldset>
                                <ul>
                                    <li class="text-field with-icon span3">
                                        <label>
                                            <span class="mainlabel">Name</span>
                                        </label>

                                        <div class="input-prepend">
                                            <span class="add-on">
                                                <img src="/images/footer/author-footer.png" alt="" title=""/></span>
                                            <input type="text" name="yit_contact[name]" class="with-icon required" value=""/>
                                        </div>
                                        <div class="msg-error"></div>
                                        <div class="clear"></div>
                                    </li>

                                    <li class="text-field with-icon span3">
                                        <label>
                                            <span class="mainlabel">Email</span>
                                        </label>

                                        <div class="input-prepend">
                                            <span class="add-on">
                                                <img src="/images/footer/envelope-footer.png" alt="" title=""/>
                                            </span>
                                            <input type="text" name="yit_contact[email]" class="with-icon required email-validate" value=""/>
                                        </div>
                                        <div class="msg-error"></div>
                                        <div class="clear"></div>
                                    </li>

                                    <li class="textarea-field with-icon span6">
                                        <label>
                                            <span class="mainlabel">Message</span>
                                        </label>

                                        <div class="input-prepend">
                                            <span class="add-on">
                                                <img src="/images/footer/pencil-footer.png" alt="" title=""/>
                                            </span>
                                            <textarea name="yit_contact[message]" rows="8" cols="30" class="with-icon required"></textarea>
                                        </div>
                                        <div class="msg-error"></div>
                                        <div class="clear"></div>
                                    </li>

                                    <li class="submit-button span6">
                                        <div style="position:absolute;left:-9999px;">
                                            <input type="text" name="email_check_2" id="email_check_2" value=""/>
                                        </div>
                                        <input type="hidden" name="yit_action" value="sendemail" id="yit_action"/>
                                        <input type="hidden" name="yit_referer" value="index.html"/>
                                        <input type="hidden" name="id_form" value="228"/>
                                        <input type="submit" name="yit_sendemail" value="SEND" class="sendmail alignright"/>
                                        <div class="clear"></div>
                                    </li>
                                </ul>
                            </fieldset>
                        </form>

                        <script type="text/javascript">
                            var messages_form_228 = {
                                name: "Insert the name",
                                email: "Insert a valid email",
                                message: "Insert a message"
                            };
                        </script>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
<?php 	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php'); ?>
</body>
</html>