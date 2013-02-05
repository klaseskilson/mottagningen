<?php

$names = array("Atre", "Tim", "Kristina", "Åsa", "Klas",
		 "Linn", "Tekko", "Tenni", "Sebastian", "Johan");

$week = ltrim(date("W"), '0') - 6;

?>

<div id="container">
	<h1>Fika kanskeee.</h1>
	<p>Vem i Legionen ska fixa fika?</p>
	<p>
		<?php echo $names[$week]; ?>, ååååååååååååååååååååååååååh <?php echo $names[$week]; ?>!
	</p>
</div>
