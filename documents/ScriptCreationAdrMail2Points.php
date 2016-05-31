<?php

/* NE FONCTIONNE PAS CORRECTEMENT */
$adrMailBase = "delasallesioboutink";
$longueur = strlen ( $adrMailBase );

echo $adrMailBase . "@gmail.com" . '<br>';

$incrementation = 0;
for($i = 1; $i < 3; $i ++) {
	
	$debutAdr = substr ( $adrMailBase, 0, $i + $incrementation );
	$milieuAdr = substr ( $adrMailBase, $i, 1 + $incrementation );
	$finAdr = substr ( $adrMailBase, $i + 1, $longueur - 2 );
	$adrMailBase = $debutAdr . "." . $milieuAdr . "." . $finAdr;
	echo $adrMailBase . "@gmail.com" . $i . '<br>';
	
	$longueur = strlen ( $adrMailBase );
	
	for($j = 5; $j < $longueur - 2; $j ++) {
		
		$debutAdr = substr ( $adrMailBase, 0, $j );
		$finAdr = substr ( $adrMailBase, $j, $longueur );
		$adrMail = $debutAdr . "." . $finAdr;
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo $adrMail . "@gmail.com" . $j . '<br>';
		
		$longueur = strlen ( $adrMail );
		$k = $j;
		
		for($k = $j + 2; $k < $longueur; $k ++) {
			$debutAdr = substr ( $adrMail, 0, $k );
			$finAdr = substr ( $adrMail, $k, $longueur - $k );
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo $debutAdr . "." . $finAdr . "@gmail.com" . '<br>';
		}
	}
	$incrementation += 1;
}