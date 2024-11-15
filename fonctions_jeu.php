<?php

     /**
     * Enregistre le score actuel dans un fichier texte nommé "score.txt".
     *
     * @param int $score Le score à sauvegarder.
     */
    function score_vers_fichier()
    {
        global $score;
        file_put_contents("score.txt", $score);
    }

    /**
     * Lit le score depuis le fichier texte "score.txt" et le retourne.
     *
     * @return int Le score sauvegardé dans le fichier.
     */
    function fichier_vers_score()
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
        $chiffre = rand(0, 1); // Génère 0 ou 1 de façon aléatoire

        if ($chiffre == 0)
            return 2;          // Retourne 2 si le chiffre est 0
        else
            return 4;          // Retourne 4 si le chiffre est 1
    }


	/**
     * Sélectionne une position aléatoire parmi les cases vides d'une grille 4x4.
     * Si la grille est pleine (aucune case vide), retourne null.
     *
     * @param array $grille La grille de jeu, représentée comme un tableau 2D de 4x4.
     * @return array un tableau qui contient les coordonnées de la case vide de la grille passée en 
     * paramètre
     */
	function tirage_aleatoire()
	{
        global $grille;
		$table;
		do{
			$table[0] = rand(0,3);
			$table[1] = rand(0,3);
		  } while($grille[$table[0]][$table[1]] != 0);
		  
		  return $table;
		
	}


?>