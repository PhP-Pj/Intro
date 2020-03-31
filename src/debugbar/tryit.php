<?php
// I think add stuf from vendor as part of the project
require __DIR__ . '/../../vendor/autoload.php';
// kind of an import with name space
// https://www.php.net/manual/en/language.namespaces.importing.php
use DebugBar\StandardDebugBar;

$debugbar = new StandardDebugBar();
$debugbarRenderer = $debugbar->getJavascriptRenderer();

$debugbar["messages"]->addMessage("hello world!");
?>
<html>
<head>
    <?php echo $debugbarRenderer->renderHead() ?>
</head>
<body>
    ...
    <?php echo $debugbarRenderer->render() ?>
    <h1>God knows what this is supposed to do!</h1>
    <h1>Oh look at the bottom the debug bar appeared!</h1>
</body>
</html>