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
<link rel='stylesheet' id='custom-css' href='/css/customerorderform.css'
	type='text/css' media='all' />
</head>
<body>
<div class="flexbox-parent">
<div class="flexbox-item fill-area content flexbox-item-grow">
        <div class="fill-area-content flexbox-item-grow">
<?php 
$pagetitle ="Forgot Password";
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/header.php');
?>
</div>
</div>
<div class="flexbox-item fill-area content flexbox-item-grow">
        <div class="fill-area-content flexbox-item-grow">
	<div id="order-form" class="clearfix">
	<form action="change.php" method="POST">
	<p>E-mail Address: <input type="text" name="ForgotPasswordEmail"/></p>
	<div style="text-align: center; padding: 5%;">
	<p><input type="submit" name="submit" id="submit-button" style="margin: auto; display: block;"/></p>
	</div>
	</form> 
	</div>
</div>
</div>
<div class="flexbox-item footer">  
<?php 
	include ($_SERVER ["DOCUMENT_ROOT"] . '/main/footer.php');
?>
</div>
</div>
</body>
</html>