<?php
/*
	javascript view of ads, basically just prints it where loaded
*/
?>
/*
Brilliant ads loaded from <?php echo $_SERVER['SERVER_NAME'] ?> in only {elapsed_time} seconds

Collector is <?php echo $collector; ?>.

README:
1. Load file in header of HTML Document.
2. Call this function in body onload
	initads("objecttocontainads");
3. In the HTML document, include an empty div with the id you call in the body onload.
For example
	<div id="objecttocontainads"></div>
4. DONE!
*/

function initads(object)
{
	var main = document.getElementById(object);

<?php
foreach ($ads as $ad) {
?>
	main.innerHTML += '<a href="<?php echo $ad['link']; ?>" target="_blank"><img src="http://<?php echo $_SERVER['SERVER_NAME'].':'.($_SERVER['SERVER_PORT'] !== 80? $_SERVER['SERVER_PORT'] :'').'/web/ads/ad_'.$ad['id'].'.png'; ?>" /></a>';
<?php
}
?>

}
