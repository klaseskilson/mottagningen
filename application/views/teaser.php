<?php
// teaser.php
?>


<div id="container">
	<?php
	if(time() < strtotime("2013-03-31 23:19"))
	{
	?>
<script type="text/javascript" language="javascript">
<!--
dateFuture = new Date(2013,02,31,23,19,00);

function GetCount(){
	dateNow = new Date();                                             //grab current date
	amount = dateFuture.getTime() - dateNow.getTime();                //calc milliseconds between dates
	delete dateNow;

	// time is already past
	if(amount < 0)
	{
		document.location.reload(true);
	}
	// date is still good
	else
	{
		days=0;hours=0;mins=0;secs=0;out="";

		amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		days=Math.floor(amount/86400);//days
		amount=amount%86400;

		hours=Math.floor(amount/3600);//hours
		amount=amount%3600;

		mins=Math.floor(amount/60);//minutes

		amount=amount%60;
		secs=Math.floor(amount);//seconds

		if(days != 0){out += days +" dag"+((days!=1)?"ar":"")+", ";}
		if(days != 0 || hours != 0){out += hours +" timm"+((hours!=1)?"ar":"e")+", ";}
		if(days != 0 || hours != 0 || mins != 0){out += mins +" minut"+((mins!=1)?"er":"")+" och ";}
		out += secs +" sekunder";
		document.getElementById('countbox').innerHTML=out;

		setTimeout("GetCount()", 1000);
	}
}

window.onload=function(){GetCount();}//call when everything has loaded
//-->
</script>
<p>Det kanske händer något om</p><h1 id="countbox"></h1>
	<?php
	}
	else
		echo '<p>Legionen presenterar...</p><iframe src="http://player.vimeo.com/video/63047254?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	?>

</div>


