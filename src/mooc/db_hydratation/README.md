# PhP - DB Connection  - Class Loader

## PhP

Contrarily to the the mooc seems to say about the **hydrate** construct there is no magic.  
It must be called by the constructor to hydrate the object.  
The only benefit of the **hydrate** method is when testing we don't need to create a new object via the constructor we can just pass an array parameter to the **hydrate** method to reinitialize the object.

## DB

Strange things could happen when calling PDOStatement::execute() where the prepare statement is trying to INSERT to an inexisting table. **execute** returns **false** i.e. an **error occured** but **PDO::errorInfo() or PDO::errorCode()** return **0000**, meaning **success**.

Actually, it's because **PDOStatement::errorInfo()** or  **PDOStatement::errorCode()** must be called to get the query's error.

## require 'file.php' - no parentheses

**require** is identical to **include** except upon failure it will also produce a fatal **E_COMPILE_ERROR**  
**include** only emits a warning **E_WARNING**
It seems as messy as **C / C++**, file can get included more the once depending on the order. Not sure yet if there is an **#ifdef / #define** construct to prevent the issue.  
Maybe this follwing pattern can be used:

```
if ((include 'vars.php') == TRUE) {
    echo 'OK';
}
```

### Using the pattern:

```
function classLoader($classname)
{
  require $classname.'.php';
}

spl_autoload_register('classLoader');
```
seems convenient but as far as I undersatnd it must use in the main file and no **require** can be used in othe files otherwise we get an **already defined** error.

**include/require** looks for files in the **include_path** first then the current folder.  
**inlude_path** can be set with **set_nclude_path()**
