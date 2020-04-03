# Exceptions

## Throwing

A error message and error code can be set

```
throw new Exception('Les deux paramètres doivent être des nombres');
```

#### Note

We must not thow an exeption from a destgructor. It would be fatal and would not display a stack trace.

## Catching

```
try {

}
catch (SomeException $e) {

}
catch (Exception $e) { // catch all

}

```

## Custom exceptions

Define your own exception by inheriting from Exception.

```
<?php
class Exception
{
  protected $message = 'exception inconnu'; // Message de l'exception.
  protected $code = 0; // Code de l'exception défini par l'utilisateur.
  protected $file; // Nom du fichier source de l'exception.
  protected $line; // Ligne de la source de l'exception.
  
  final function getMessage(); // Message de l'exception.
  final function getCode(); // Code de l'exception.
  final function getFile(); // Nom du fichier source.
  final function getLine(); // Ligne du fichier source.
  final function getTrace(); // Un tableau de backtrace().
  final function getTraceAsString(); // Chaîne formattée de trace.
  
  /* Remplacable */
  function __construct ($message = NULL, $code = 0);
  function __toString(); // Chaîne formatée pour l'affichage.
}
```

Ex:

```
<?php
class MonException extends Exception
{
  public function __construct($message, $code = 0)
  {
    parent::__construct($message, $code);
  }
  
  public function __toString()
  {
    return $this->message;
  }
}
```

## Pre-canned Exception

https://www.php.net/manual/fr/spl.exceptions.php


## finally

If the exception is not caught at least the fianlly block is executed before the excpetion is forwarded.

```
<?php
$db = new PDO('mysql:host=localhost;dbname=tests', 'root', '');

try
{
  // Quelques opérations sur la base de données
}
finally
{
  echo 'closing the connection';
}
```

## Convert errors in exceptions

It is possible to convert with **set_error_handler** fatal errors, alerts and notices in exception. The conversion doesn't catch the error but transform it.  
If the error-handler function returns, script execution will continue with the next statement after the one that caused an error.  

The **error handler** takes 5 parameters

* error code
* error message
* file name
* lign number
* array of all the current variables

**set_error_handler** takes 2 parameters

* handler
* the errors we want to intercept

## Handle all uncaught exceptions

It is possible to set a handler for all uncaught exception with **set_exception_handler**.  
Execution will stop after the exception_handler is called. 

