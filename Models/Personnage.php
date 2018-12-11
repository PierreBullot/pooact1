<?php
class Personnage {
	
	//~ private $_id;
	//~ private $_nom;
	//~ private $_forcePerso;
	//~ private $_degats;
	//~ private $_niveau;
	//~ private $_experience;

	private $_id,
	        $_nom,
	        $_forcePerso,
	        $_degats,
	        $_niveau,
	        $_experience;
	        
	const CEST_MOI = 1;
	const PERSONNAGE_TUE = 2;
	const PERSONNAGE_FRAPPE = 3;
	
	public function id() {return $this->_id;}
	public function nom() {return $this->_nom;}
	public function forcePerso(){return $this->_forcePerso;}
	public function degats() {return $this->_degats;}
	public function niveau() {return $this->_niveau;}
	public function experience() {return $this->_experience;}
	
	public function setId($id) {
		$id = (int) $id;
		
		if ($id > 0) {
			$this->_id = $id;
		}
	}
	public function setNom($nom) {
		if (is_string($nom)) {
			$this->_nom = $nom;
		}
	}
	public function setForcePerso($forcePerso) {
		$forcePerso = (int) $forcePerso;
		
		if ( $forcePerso>=0 && $forcePerso<=100 ) {
			$this->_forcePerso = $forcePerso;
		}
		
	}
	public function setDegats($degats) {
		$degats = (int) $degats;
		
		if ( $degats>=0 && $degats<=100 ) {
			$this->_degats = $degats;
		}
	}
	public function setNiveau($niveau) {
		$niveau = (int) $niveau;
		
		if ( $niveau>0 && $niveau<=100 ) {
			$this->_niveau = $niveau;
		}
	}
	public function setExperience($experience) {
		$experience = (int) $experience;
		
		if ( $experience>=0 && $experience<100 ) {
			$this->_experience = $experience;
		}
	}
	
	
	
	
	//méthode pour frapper
	public function frapper(Personnage $cible){
		//vérifier que la cible ne s'attaque pas elle-même
		//erreur si oui
		
		//frapper la cible
		//dire ce qu'il se passe
		//gagner exp
	}
	
	
	//méthode pour recevoir des dégâts
	public function recevoirDegats(Personnage $agresseur){
		//recevoir dégâts
		//dire ce qu'il se passe
		
		//vérifier le taux de dégats
		//si >100 tuer le perso
			//message de mort
		//si certain seuil atteint se plaindre
	}
	
	
	// méthode pour gagner de l'exp
	
	
	
	// méthode pour monter de niveau
	
	
	
	// méthode pour mourrir
	// méthode pour se soigner
	// méthode pour parler
	// méthode pour se plaindre
}
