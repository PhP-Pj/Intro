<?php
class Table extends Annotation {}
class Type extends Annotation {}
class Portfolio extends Annotation {
    public $share;
    public $price;

    public function checkConstraints($clazz) {
        if (!is_string($this->share)) {
            // Bug in Annotation??
            // If we throw an Exception for a particalur annotation we
            // can no longer use this annotation even if checkconstaint is OK
            // because otherwise unset(Annotation::$creationStack[$clazz])
            // don't get executed. See annotation Constructor

            //throw new Exception('share must be a string');
            printf("Error!!! share must be a string\n");
        }
        if (!is_float($this->price)) {
            //throw new Exception('price must be a float');
            printf("Error!!! price must be a float\n");
        }
    }
};
