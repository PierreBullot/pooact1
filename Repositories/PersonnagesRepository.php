<?php
class PersonnagesRepository
{
    private $_db; // Instance de PDO

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
    //  //SQL Table code
    // CREATE TABLE `personnages` (
    //     `id` INT NOT NULL AUTO_INCREMENT ,
    //     `nom` VARCHAR(32) NOT NULL ,
    //     `forcePerso` INT NULL ,
    //     `degats` INT NULL ,
    //     `niveau` INT NULL ,
    //     `experience` INT NULL ,
    // PRIMARY KEY (`id`)) ENGINE = InnoDB;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    //CREATE
    public function add(Personnage $perso)
    {
        $q = $this->_db->prepare('INSERT INTO personnages(nom, forcePerso, degats, niveau, experience) VALUES(:nom, :forcePerso, :degats, :niveau, :experience)');

        $q->bindValue(':nom', $perso->nom());
        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);

        return $q->execute();
    }
    
    public function exists($info)
	{
		if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
		{
			return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id = '.$info)->fetchColumn();
		}
		
		// Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
		
		$q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
		$q->execute([':nom' => $info]);
		
		return (bool) $q->fetchColumn();
	}
    

    //READs
    public function get($info)
    {
		if (is_int($info))
		{
			$q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages WHERE id = '.$info);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			
			return new Personnage($donnees);
		}
		else
		{
			$q = $this->_db->prepare('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages WHERE nom = :nom');
			$q->execute([':nom' => $info]);
			
			return new Personnage($q->fetch(PDO::FETCH_ASSOC));
		}
    }

    public function getList()
    {
        $persos = [];

        $q = $this->_db->prepare('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages WHERE nom <> :nom ORDER BY nom');
        $q->execute([':nom' => $nom]);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new Personnage($donnees);
        }

        return $persos;
    }

    //UPDATE
    public function update(Personnage $perso)
    {
        $q = $this->_db->prepare('UPDATE personnages SET forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience WHERE id = :id');

        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

        $q->execute();
    }

    //DELETE
    public function delete(Personnage $perso)
    {
        $this->_db->exec('DELETE FROM personnages WHERE id = ' . $perso->id());
    }
    
    public function count()
	{
		return $this->_db->query('SELECT COUNT(*) FROM personnages')->fetchColumn();
	}
}
