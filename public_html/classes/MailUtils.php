<?php
class MailUtils
{
    function send($from, $fromname, $to, $subject, $message) {
        $this->sendWithAttachments($from, $fromname, $to, $subject, $message, null, null);
    }
    function sendWithAttachments($from, $fromname, $to, $subject, $message, $attachmentDir, $attachmentString) {
        $mail = $this->getMailer();
        $mail->SetFrom($from, $fromname);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        //$to can be given as a comma delimited list
        $array = explode(",", $to);
        foreach ($array as $singleAddress) {
            $mail->AddAddress($singleAddress);
        }
        if(empty($attachmentString) || is_null($attachmentString) ){
            //echo "sending without attachments<br>";
        }
        else{
            //echo "sending with attachments<br>";
            $this->addOrderAttachments($mail, $attachmentDir, $attachmentString);
        }
        if ($mail->Send()) {
            //echo "Message sent!";
        } else {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }
        if(!(empty($attachmentString) || is_null($attachmentString))){
            $this->cleanOrderAttachments($attachmentDir);
        }
    }
    /**
     * Returns a defualt mailer capable of sending emails.
     *
     * @return PHPMailer
     */
    function getMailer() {
        include_once($_SERVER ["DOCUMENT_ROOT"] . '/mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "email.hostaccount.com";
        $mail->Port = 587;
        $mail->Username = "noreply@redrocktelecom.com";
        $mail->Password = "Telco123!";
        return $mail;
    }
    /**
     * This method adds attachments to the given mail object. Attachments are taken from
     * the uniquely named folder for the current order, defined by the $attachmentDir.
     *
     * @param $mail - mail object to attach the attachments
     * @param $attachmentDir - unique directory name where the attachments are stored
     * @param $attachmentString - the comma delimited list of filenames to be attached
     */
    function addOrderAttachments($mail, $attachmentDir, $attachmentString) {
        $array = explode(",", $attachmentString);
        foreach ($array as $fileName) {
            $path = $_SERVER['DOCUMENT_ROOT'] . "/tmp/orderData/" . $attachmentDir . '/' . $fileName;
            //echo "adding attachment from path: " . $path . "<br>";
            if (is_file($path)) {
                //echo " is a file!<br>";
                $mail->addAttachment($path);
            }
        }
    }
    /**
     * This method recursively removes the contents of the folder from the temporary orderData.
     * @param $dir - the unique folder name for the current order being processed.
     */
    function cleanOrderAttachments($dir) {
	$toRemove = $_SERVER['DOCUMENT_ROOT'] . "/tmp/orderData/" . $dir;
	//echo "attempting to remove attachments from dir: " . $toRemove . "<br> ";
	if (is_dir($toRemove)) {
		//echo "is a directory <br>";
		$objects = scandir($toRemove);
		foreach ($objects as $object) {
			//echo "attempting to remove an object";
			if ($object != "." && $object != "..") {
				if (is_dir($toRemove."/".$object))
					rrmdir($toRemove."/".$object);
					else
						unlink($toRemove."/".$object);
			}
		}
		rmdir($toRemove);
	}
	else{
		//echo "Is not a dir";
	}
}
}
?>