<html>
	<style type="text/css">
	body{
		background-color:#000;
		overflow:hidden;
	}
	#imgDIV {
		color:#fff;
	}
	.soupimg
	{
		height:100%;
	}
	.controll
	{
		color:#565656;
	}
	.next
	{
		position:absolute;
		right:20px;
		top:50%;
	}
	.previous
	{
		position:absolute;
		left:10px;
		top:50%;
	}
	#msg
	{
		position:absolute;
		color:#fff;
		font-size:26px;
		padding:10px;
		text-align: center;
		left:5%;
		right:5%;
		top:40%;
		background-color: red;
		opacity: 0.7;
	}
	</style>
<body>
	<div style="text-align: center;position:absolute;width:100%;height:90%;top:5%;" id="imgDIV">
		<i>Loading</i>
	</div>
	<div id="msg"></div>
	<div class="next controll"><h1>></h1></div>
	<div class="previous controll"><h1><</h1></div>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
var img = [];
count = -1;
function loadImages()
{
	$.getJSON( "img.php", function( data ) {
		$.each(data, function(key, value){
			if(!inArray(value, img))
			{
				img.push(value);
			}
		});
		//console.log(img);
		changeImage("next", true);
	});
}
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
function changeImage(task, timeoutset)
{
	//$("#imgDIV").fadeOut().html('<img class="soupimg" src="'+img[count]+'">').fadeIn();
	if(count > img.length - 4)
	{
		loadImages();
	}
	if(count > img.length -2)
	{
		count = -1;
	}
	if(task=="next")
	{
		count = count + 1;
	}
	if(task == "previous")
	{
		count = count - 1;
	}
	console.log(count);
	$("#imgDIV").fadeOut(4000, function () {
		$("#imgDIV").html('<img class="soupimg" src="'+img[count]+'">');
		$("#imgDIV").fadeIn(4000, function () {
			if(timeoutset==true)
			{
				setTimeout("changeImage('next', true)", 15000);
			}
		});
	});
}
function getMessage ()
{
	if ($("#msg").is(':visible')) {
		//alert("VISIBLE");
	}
	else
	{
		$.ajax({
		  url: "msg.php",
		}).done(function(res) {
		  if(res!="")
		  {
		  	$("#msg").html(res);
		  	$("#msg").fadeIn();
		  }
		});
	}
	setTimeout("getMessage()", 3000);
}
$("#msg").hide();
getMessage();
$(".next").click(function() {
	changeImage("next", false);
});
$(".previous").click(function () {
	changeImage("previous", false);
});
$("#msg").click(function () {
	$("#msg").fadeOut();
});
loadImages();
</script>