# Reflection

## ReflectionClass ReflectionObject

**ReflectionClass and ReflectionObject** makes it possible to inspect a either a class or na object.  
These 2 classes differ only by the constuctor and another method.

```
<?php

$classeMagicien = new ReflectionClass('Magicien'); 

$magicien = new Magicien(['nom' => 'vyk12', 'type' => 'magicien']);
$classeMagicien = new ReflectionObject($magicien);
```

## Class methods of the API

* ReflectionClass::hasProperty($atrributeName)
* ReflectionClass::hasMethod($methodName)
* ReflectionClass::hasConstant($constName)
* ReflectionClass::getConstant($constName)
* ReflectionClass::getConstants()

* ReflectionClass::getParentClass()
* ReflectionClass::isSubclassOf($className)
* ReflectionClass::isAbstract()
* ReflectionClass::isFinal()
* ReflectionClass::isInstantiable()

* ReflectionClass::isInterface()
* ReflectionClass::implementsInterface($interfaceName)
* ReflectionClass::getInterfaces()
* ReflectionClass::getInterfaceNames()

## Attribut methods of the API

To atrribute information one can instanciate ReflectionProperty or get an instance from ReflectionClass::getProperty(prperty_name)

```
<?php
$attributMagie = new ReflectionProperty('Magicien', 'magie');

$classeMagicien = new ReflectionClass('Magicien');
$attributMagie = $classeMagicien->getProperty('magie');

```

To get all the properties use **ReflectionClass::getProperties()**  

### Property API

* ReflectionProperty::getName()
* ReflectionProperty::getValue($object) which will work if the attribute is public
* ReflectionProperty::setAccessible([true | false]) to make the attribute visible. Use **false** to set it back to waht it was.
* ReflectionProperty::setValue($objet, $valeur)
* ReflectionProperty::isPrivate()
* ReflectionProperty::isProtected()
* ReflectionProperty::isPublic()

* ReflectionProperty::isStatic()
* For static attributes either **ReflectionClass::getProperty('attr')::getValue()** or **ReflectionClass::getStaticPropertyValue($attr)**
* ReflectionClass::setStaticPropertyValue($attr, $value)
* ReflectionClass::getStaticProperties()

## Methods methods of the API

To get info about the methods **ReflectionMethod(calss_name, method_name)** or **ReflectionClass::getMethod($name)**

* ReflectionMethod::isPublic()
* ReflectionMethod::isProtected()
* ReflectionMethod::isPrivate()
* ReflectionMethod::isAbstract()e
* ReflectionMethod::isFinal()
* ReflectionMethod::isStatic()
* ReflectionMethod::isConstructor()
* ReflectionMethod::isDestructor()

* ReflectionMethod::invoke($object, [$args|[, $argn]) $object on which we want to call the method and all its args or **ReflectionMethod::invokeArgs($object, [$array_of_args])**

```
<?php
class A
{
  public function hello($arg1, $arg2, $arg3 = 1, $arg4 = 'Hello world !')
  {
    var_dump($arg1, $arg2, $arg3, $arg4);
  }
}

$a = new A;
$hello = new ReflectionMethod('A', 'hello');

$hello->invoke($a, 'test', 'autre test'); // output: string(4) "test" string(10) "autre test" int(1) string(13) "Hello world !"
```

* ReflectionMethod::setAccessible($bool)


## Annotations

Annotations are class metadata inserted as a comment block with **@AnnotionName(annotationValue).  
The **addendum** lib is used to parse the annotations.  
https://code.google.com/p/addendum/downloads/list


```
<?php
/**
 * @TheAnnotation(value)
 */
class Personnage
{
  // ...
}
```

An Annotation is a class that extends Annotation.  
**value** is the default attribute of an annotation and can is retrived with  **ReflectionAnnotatedClass::getAnnotation('AnnotationNmae')::value**.  
A value is pass to the annotation when the Annotation is used to annotate a class.  
An array can be passd as a value as **{v1, v2 ..}**

**ReflectionAnnotatedClass::hasAnnotation(annotation_name)** to find out if a class has this annotation

### Defining a annotation with multiple values

Each attribute must be public

```
<?php
class ClassInfos extends Annotation
{
  public $author;
  public $version;
}
```

The annotation values can be retrieved with **ReflectionAnnotatedClass::getAnnotation('AnnotationNmae')::author, **ReflectionAnnotatedClass::getAnnotation('AnnotationNmae')::version**

### Checking the annotation parameters

One can override **Annotaion::checkConstraints()** to check the parameters passed to the annotated class.


## Attributes and Methods annotations

**ReflectionAnnotatedProperty(classname, attributename) and ReflectionAnnotatedMethod(classname, methodname)** to get the annotation of the attribute or method.  

## Restrict annotations to classes only, methods only or attributes only

It is possible to add an annotation to an annotation to specify its target with **@Target("class")**

```
<?php
/** @Target("class") */
class ClassInfos extends Annotation
{
  public $author;
  public $version;
}
```
