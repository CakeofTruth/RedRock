<html>
<head>
<script type="text/javascript"></script>
<script>
function show1(){
	document.getElementById('div1').style.display ='none';
}
function show2(){
	document.getElementByID('div1').style.display = 'block';
}
</script>
</head>
<body>
<label for="porting">Will you be porting any numbers?<span class="required" style="color:red;">*</span>
			</label>
		<input type="radio" name="porting" value="yes" onclick="show1();"/> Yes
		<input type="radio" name="porting" value="yes" onclick="show2();"/> No
		<div id="div1" class="hide">
		<a href="javascript:void(0);" onclick="addElement();">Add</a>
    			<a href="javascript:void(0);" onclick="removeElement();">Remove</a>
				<div id="content"></div>
		</div>
</body>
</html>