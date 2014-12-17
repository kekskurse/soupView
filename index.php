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
		width:90%;
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
	</style>
<body>
	<div style="text-align: center;position:absolute;width:100%;height:90%;top:5%;" id="imgDIV">
		<i>Loading</i>
	</div>
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
		changeImage("next");
	});
}
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
function changeImage(task)
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
			setTimeout("changeImage('next')", 15000);
		});
	});
}
$(".next").click(function() {
	changeImage("next");
});
$(".previous").click(function () {
	changeImage("previous");
});
loadImages();
</script>