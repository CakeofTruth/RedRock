<?php 

$attachmentError = "";
	$formisvalid = 0;
	if(!empty($_POST)){
			$formisvalid = 1;
			$hasAttachment = 0;
			//If there are attachments, validate they are the required size and of the right file type
			$numfiles = count($_FILES['uploads']['name']) ;
			$realFiles = 0;
			foreach($_FILES['uploads']['name'] as $name){
				if(strlen($name) > 0 ){
					$realFiles = 1;	
				}
			}
			if($numfiles > 0  && $realFiles == 1){
				$hasAttachment = 1;
				$max_allowed_file_size = 5000;//1mb
				$allowed_extensions = array("png","jpg", "jpeg", "doc", "pdf", "docx", "xls", "xlsx", "csv", "txt");

				//validate extensions...
				foreach($_FILES['uploads']['name'] as $name){
					$type= substr($name, strrpos($name, '.') +1);
			
					$isValidExtension = extensionIsValid($type);
					if(!$isValidExtension){
						$attachmentError .="<br> An uploaded file is not of a supported file type. ".
						"Only the following file types are supported: [".implode(', ',$allowed_extensions) . "]";
						$formisvalid = 0;
						break;
					}
				}
			
				//validate filesizes
				foreach($_FILES['uploads']['size'] as $size){
					$realsize = $size/1024;
					$isValidSize = ($realsize < $max_allowed_file_size);
					if(!$isValidSize) {
						$attachmentError .= "<br> Files must be less than $max_allowed_file_size kb";
						$formisvalid = 0;
						break;
					}
				}
			}
	}
	if($formisvalid){
		include("ItemOrderForm.php");
	}
	else{
		include("CustomerOrderForm.php");
	}
	
function extensionIsValid($extension){
	$allowed_ext = false;
	$allowed_extensions = array("jpg", "jpeg", "doc", "pdf", "docx", "xls", "xlsx", "csv", "txt");
	foreach($allowed_extensions as $allowed) {
		if(strcasecmp($allowed,$extension) == 0){
			$allowed_ext = true;
			break;//Exit loop
		}
	}
	return $allowed_ext;
}
?>