<?php
// require ('personnage_manager.php');

function classLoader($classname)
{
  require $classname.'.php';
}

spl_autoload_register('classLoader');


$db = new PDO('mysql:host=localhost;dbname=personnageDB', 'personnageDBUser', 'personnage_pwd');
$manager = new PersonnagesManager($db);
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nom"])) {
    $nameErr = "Name is required";
  } else {
    $nom = $_POST["nom"];
    $perso = new Personnage([
      'nom' => $nom,
      'forcePerso' => 0,
      'degats' => 0,
      'niveau' => 0,
      'experience' => 0
    ]);
    $manager->add($perso);
  }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Php - DB</title>
    
    <meta charset="utf-8" />
  </head>
  <body>
    <p>Number of characters : <?= $manager->count() ?></p>
<?php
if (isset($message)) // On a un message à afficher ?
  echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <p>
        Nom : <input type="text" name="nom" maxlength="50" />
        <input type="submit" value="Créer ce personnage" name="creer" />
        <input type="submit" value="Utiliser ce personnage" name="utiliser" />
      </p>
    </form>
  </body>
</html>