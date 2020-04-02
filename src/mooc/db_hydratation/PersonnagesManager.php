<?php
// require ("Personnage.php");

class PersonnagesManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Personnage $perso)
  {
    $q = $this->_db->prepare('INSERT INTO personnage(nom, forcePerso, degats, niveau, experience) VALUES(:nom, :forcePerso, :degats, :niveau, :experience)');

    $q->bindValue(':nom', $perso->nom());
    $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
    $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);

    try {
        if ($q->execute()) {
            $id = $this->_db->lastInsertId();
            echo "Id=" . $id;
            return $id;
        }
        else {
            $err = $q->errorInfo();
            echo $err[0] . " - " . $err[1] . " - " . $err[2];
            echo "\nPDO::errorCode(): ", $q->errorCode();
            throw new Exception('Failed inserting '. $perso);
        }
    }
    catch (Exception $e) {
        echo '\nCaught exception: ',  $e->getMessage(), "\n";
    }
  }

  public function delete(Personnage $perso)
  {
    $this->_db->exec('DELETE FROM personnage WHERE id = '.$perso->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnage WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Personnage($donnees);
  }

  public function getList()
  {
    $persos = [];

    $q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnage ORDER BY nom');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $persos[] = new Personnage($donnees);
    }

    return $persos;
  }

  public function update(Personnage $perso)
  {
    $q = $this->_db->prepare('UPDATE personnage SET forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience WHERE id = :id');

    $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
    $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

    $q->execute();
  }

  public function count() {
    $q = $this->_db->query('SELECT COUNT(*) as count from  personnage');
    $q->execute();
    $count = $q->fetch(PDO::FETCH_ASSOC);
    return $count['count'];
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}