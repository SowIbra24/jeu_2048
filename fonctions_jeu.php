<?php

     /**
     * Enregistre le score actuel dans un fichier texte nommé "score.txt".
     *
     * @param int $score Le score à sauvegarder.
     */
    function sauvegarde_score($grille)
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
        // tableau de tableaux qui contiendra dans chaque ligne, un tableau qui contiendra les indices
        // de la case vide de la grille 
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

        // retourne un indice d'une case de cases_vides qui stocke les coordonées d'une case vide de grille
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

?>