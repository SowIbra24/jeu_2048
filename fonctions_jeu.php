<?php

     /**
     * Enregistre le score actuel dans un fichier texte nommé "score.txt".
     *
     * @param int $score Le score à sauvegarder.
     */
    function sauvegarde_score($score)
    {
        file_put_contents("score.txt", $score);
    }

    /**
     * Lit le score depuis le fichier texte "score.txt" et le retourne.
     *
     * @return int Le score sauvegardé dans le fichier.
     */
    function charge_score(&$score)
    {
        return file_get_contents("score.txt");
    }

    /**
     * Génère un nombre aléatoire qui est soit 2 soit 4, avec une chance égale pour chaque.
     *
     * @return int Retourne 2 ou 4 de manière aléatoire.
     */
    function genere_nombre()
    {
        $chiffre = rand(0, 1); 

        if ($chiffre == 0)
            return 2;         
        else
            return 4;         
    }

	/**
     * Sélectionne une position aléatoire parmi les cases vides d'une grille 4x4.
     * Si la grille est pleine (aucune case vide), retourne null.
     *
     * @param array $grille La grille de jeu, représentée comme un tableau 2D de 4x4.
     * @return array un tableau qui contient les coordonnées de la case vide de la grille passée en 
     * paramètre
     */

	function tirage_aleatoire($grille)
    {
        $cases_vides = []; 

        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                if ($grille[$i][$j] == 0) {
                    $cases_vides[] = [$i, $j];
                }
            }
        }

        if (empty($cases_vides)) {
            return false;
        }

        return $cases_vides[array_rand($cases_vides)];
    }

    /**
     * Ajoute un nombre aléatoire (2 ou 4) dans une case vide de la grille.
     * La case est choisie au hasard parmi les cases vides.
     * 
     * @param array &$grille La grille de jeu, un tableau 2D de 4x4, où chaque case est un entier.
     *                       La fonction modifie cette grille en y ajoutant un nombre aléatoire.
     * @return void
     */
    function ajoute_nombre(&$grille)
    { 
        $indice = tirage_aleatoire($grille); 
        $ligne = $indice[0];
        $colonne = $indice[1];
        $grille[$ligne][$colonne] = genere_nombre();
    }

    /**
     * Sauvegarde la matrice globale $grille dans "grille.txt".
     *
     * Chaque ligne de la matrice 4x4 est écrite dans le fichier,
     * avec les éléments séparés par des espaces. Le fichier est réinitialisé
     * avant l'écriture.
     *
     * @param array $grille La matrice 4x4 à sauvegarder.
     * @return void
     */
    function sauvegarde_grille($grille)
    {
        file_put_contents("grille.txt", "");
        for ($i=0;$i<4;$i++)
        {
            for($j=0;$j<4;$j++)
            {
                file_put_contents("grille.txt",$grille[$i][$j], FILE_APPEND);
                if ($j < 3)
                    file_put_contents("grille.txt"," ", FILE_APPEND);
                
            }
            file_put_contents("grille.txt","\n", FILE_APPEND);
        }
           
    }

    /**
     * Charge la matrice $grille à partir du fichier "grille.txt".
     *
     * Lit une matrice 4x4 depuis `grille.txt`, où les lignes sont séparées par des
     * sauts de ligne et les valeurs par des espaces, puis remplit $grille.
     *
     * @param array &$grille La matrice 4x4 à remplir.
     * @return void
     */

    function charge_grille (&$grille)
	{
		$chaine = file_get_contents("grille.txt");
		$chaine = str_replace("\n", " " , $chaine);
		$valeur = explode(" " , $chaine);
		$n=0;
		for ($i = 0; $i < 4 ; $i++)
		{
			for ($j = 0; $j < 4; $j++) 
			{
				$grille[$i][$j] = (int) ($valeur[$n]);
				$n++;
			}
		}		
	}

    /**
     * La fonction réinitialise le score à 0, remplit la grille avec des 0,
     * et place deux cases avec la valeur 2 dans des positions aléatoires vides.
     * Les modifications sont sauvegardées dans les fichiers "score.txt" et "grille.txt".
     * 
     * @param array $grille La grille de jeu, un tableau 2D de 4x4 où chaque case représente une 
     *  position dans le jeu. La grille est réinitialisée à 0 avant de placer les cases 2.
     * @param int $score Le score du joueur. Il est réinitialisé à 0 au début de la partie.
     * @return void
     */

    function nouvelle_partie(&$grille, &$score)
    {
        $score = 0;
        sauvegarde_score($score); 
        
        $grille = array_fill(0,4,array_fill(0,4,0));

        for ($i = 0; $i < 2; $i++) {
            do {
                $ligne = rand(0, 3);
                $colonne = rand(0, 3);
            } while ($grille[$ligne][$colonne] != 0); 
            
            $grille[$ligne][$colonne] = 2;
        }
        sauvegarde_grille($grille);
    }

    /**
     * @brief Génère une classe CSS en fonction de la valeur d'une case.
     *
     * Cette fonction retourne une chaîne de caractères correspondant
     * à une classe CSS. Si la valeur est 0, elle retourne "c0" pour
     * indiquer une case vide. Sinon, elle retourne une classe comme
     * "c2", "c4", etc., en fonction de la valeur.
     *
     * @param int $valeur La valeur numérique de la case (0, 2, 4, 8, ...).
     * @return string La classe CSS associée à la valeur de la case.
     */
    function obtenir_classe_css($valeur) 
    {
        return $valeur == 0 ? "c0" : "c" . $valeur;
    }

    /**
     * @brief Affiche une cellule de la grille avec le style correspondant à sa valeur.
     *
     * Cette fonction utilise la valeur d'une cellule de la grille pour déterminer 
     * la classe CSS à appliquer (via la fonction `obtenir_classe_css`), puis affiche 
     * une cellule HTML avec cette classe. Si la valeur de la cellule est 0, la cellule
     * reste vide.
     *
     * @param array $grille La grille de jeu qui est deja initialisée
     * @param int $ligne L'indice de la ligne de la cellule dans la grille.
     * @param int $colonne L'indice de la colonne de la cellule dans la grille.
     * @return void
     */
    function afficher_cellule($grille, $ligne, $colonne) 
    {
        $classe_css = obtenir_classe_css($grille[$ligne][$colonne]);
        echo "<td class='$classe_css'>";
        echo $grille[$ligne][$colonne] == 0 ? "" : $grille[$ligne][$colonne];
        echo "</td>";
    }

    /**
     * @brief Affiche la grille complète sous forme de tableau HTML.
     *
     * Cette fonction parcourt toutes les lignes et colonnes de la grille , 
     * et utilise `afficher_cellule` pour afficher chaque case dans une table HTML.
     * 
     * @param array $grille La grille de jeu à afficher 
     * @return void
     */
    function afficher_grille ($grille)
    {
        echo "<table> ";
        for($i=0;$i<4;$i++)
        {
            echo "<tr>";
            for($j=0;$j<4;$j++)
            {
                afficher_cellule($grille,$i,$j);
            }
            echo "</tr>";
        }
        echo " </table>";
    }

?>