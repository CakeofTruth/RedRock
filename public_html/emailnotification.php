<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">


<head>
	
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	
<title>Editable Invoice</title>

</head>


<body style="font: 14px/1.4 Georgia, serif;">

	
	<div id="page-wrap" style="width: 800px; margin: 0 auto;">

		
		<textarea id="header">Red Rock Telecommunications Invoice</textarea>
		
		
			<div id="identity">
		
            
				<textarea id="address" style="border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none;">
				Red Rock Telecommunications <br> 3719 E La Salle St. <br> Phoenix, AZ, 85040 <br> Phone: (602)-802-8450</textarea>

            
					<div id="logo" style="text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden;">

              
						<div id="logoctr" style="display: none; display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px;"></div>

              <div id="logohelp" style="text-align: left; display: none; font-style: italic; padding: 10px 5px;">
                <input id="imageloc" type="text" size="50" value="" /><br />
              </div>
              <img id="image" src="/assets/images/redrocklogo.png" alt="Red Rock" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title" style="font-size: 20px; font-weight: bold; float: left;"><?php echo test_input($_POST["resellername"]); ?></textarea>

            <table id="meta" style="margin-top: 1px; width: 300px; float: right;">
                <tr>
                    <td class="meta-head" style="text-align: left; background: #eee;">Invoice #</td>
                    <td><textarea><?php echo test_input($_POST["Order_No"]); ?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head" style="text-align: left; background: #eee;">Date</td>
                    <td><textarea id="date"><?php echo date("m/d/y");?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head" style="text-align: left; background: #eee;">Amount Due</td>
                    <td><div class="due"><?php echo $_POST["totalNonRecurring"];?></div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items" style="clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black;">
		
		  <tr>
		      <th style="background: #eee;" >USOC</th>
		      <th style="background: #eee;">Description</th>
		      <th style="background: #eee;">Quantity</th>
		      <th style="background: #eee;">Monthly Recurring Cost</th>
		      <th style="background: #eee;">One Time Cost</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea style="width: 80px; height: 50px;"><?php echo $itemName = $row["USOC"]; ?></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		      <td class="description"><textarea style="width: 80px; height: 50px;">Monthly web updates for http://widgetcorp.com (Nov. 1 - Nov. 30, 2009)</textarea></td>
		      <td><textarea class="cost" style="width: 80px; height: 50px;">$650.00</textarea></td>
		      <td><textarea class="qty" style="width: 80px; height: 50px;">1</textarea></td>
		      <td><span class="price" style="width: 80px; height: 50px;">$650.00</span></td>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name" style="border: 0; vertical-align: top; "><div class="delete-wpr" style="position: relative;"><textarea>SSL Renewals</textarea><a class="delete"
		      style="display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; 
		      font-family: Verdana; font-size: 12px;"href="javascript:;" title="Remove row">X</a></div></td>
		      <td class="description" style="width: 300px;"><textarea style="width: 100%;">Yearly renewals of SSL certificates on main domain and several subdomains</textarea></td>
		      <td><textarea class="cost">$75.00</textarea></td>
		      <td><textarea class="qty">3</textarea></td>
		      <td><span class="price">$225.00</span></td>
		  </tr>
		  
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Monthly Recurring Charge:</td>
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="subtotal" style="height: 20px; background: none;" ><?php echo $_POST["totalMonthly"];?></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" style="border-right: 0; text-align: right;">Non-Recurring Charge:</td>
		      <td class="total-value" style="border-left: 0; padding: 10px;"><div id="total" style="height: 20px; background: none;"><?php echo $_POST["totalNonRecurring"];?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank" style="border: 0;"> </td>
		      <td colspan="2" class="total-line balance" style="background: #eee;">Balance Due</td>
		      <td class="total-value balance" style="background: #eee;"><div class="due"><?php echo $_POST["totalNonRecurring"];?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
	
</body>

</html>