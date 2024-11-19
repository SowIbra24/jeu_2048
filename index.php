<?php
	require_once"fonctions_jeu.php";
	$score = 0;
	$grille = [];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le jeu 2048</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div class="conteneur">

		<div class="accueil">
		Le jeu se présente sous la forme d'une grille de 4x4 cases. Au début de la partie, 
		deux cases contiennent un chiffre (2 ou 4). Les nombres peuvent être déplacés à droite,
		à gauche, vers le haut ou vers le bas. Lorsqu'ils entrent en collision, deux cases de même 
		valeur fusionnent pour former une seule case, dont la valeur est égale à la somme des deux 
		nombres fusionnés. Après chaque mouvement du joueur, une nouvelle case apparaît, avec une valeur 
		de 2 ou 4. <br>
		L'objectif est d'atteindre une case portant la valeur 2048 avant que la grille ne soit remplie et 
		qu'aucun mouvement ne soit plus possible. Si aucun déplacement n’est possible, la partie est perdue.
		</div>

		
	</div>

	
</body>

</html>
