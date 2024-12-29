<?php
    require_once('fonctions_jeu.php');

    function decale_ligne(&$grille,$indLigne, $direction) {
        $resultat = array_fill(0, 4, 0);
        if ($direction === "gauche") {
            $indexe = 0; 
            foreach ($grille[$indLigne] as $valeur) {
                if ($valeur != 0) {
                    $resultat[$indexe++] = $valeur;
                }
            }
        } else { 
            $indexe = 3;
            foreach (array_reverse($grille[$indLigne]) as $valeur) {
                if ($valeur != 0) {
                    $resultat[$indexe--] = $valeur;
                }
            }
        }
        $grille[$indLigne] = $resultat;
    }
    
?>
