<?php
$adrMailBase = "delasallesioboutink";
$longueur = strlen($adrMailBase);

echo $adrMailBase . "@gmail.com" . '<br>';

/* Pour la première adresse on n'a pas autant de caractères que pour les autres, on enlève donc 1 à la longueur */
for ($i=1; $i < $longueur; $i++){
	$debutAdr = substr($adrMailBase, 0, $i);
	$finAdr = substr($adrMailBase, $i, $longueur - $i);
	echo $debutAdr . "." . $finAdr . "@gmail.com" . '<br>';
}

for ($j=3; $j < $longueur+1; $j++){

	$debutAdr = substr($adrMailBase, 0, $j-2);
	$finAdr = substr($adrMailBase, $j-2, $longueur);
	$adrMail = $debutAdr . "." . $finAdr;
	echo $adrMail . "@gmail.com" . '<br>';
	
	$longueur = strlen($adrMail);
	
	for ($k=$j; $k < $longueur; $k++){
		$debutAdr = substr($adrMail, 0, $k);
		$finAdr = substr($adrMail, $k, $longueur - $k);
		echo $debutAdr . "." . $finAdr . "@gmail.com" . '<br>';
	}
	
}