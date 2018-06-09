<?php
namespace Aruberuto\MetadataFields;

use Aruberuto\MetadataFields\Model\Field;
use Aruberuto\MetadataFields\Model\FieldGroup;


trait HasFields {
    public $fields = [];

    function __construct()  {
        $this->initFields();
    }

    // public function addField($fieldName, $type = 'text', $name = '', $instructions = '',$required = false,
    //     $options = array(), $booleanAttributes = array(), $attributes = array())
    // {
    //     $this->fields[] = $this->newField($fieldName, $type, $name ,$instructions , $required, $options , $booleanAttributes , $attributes);

    // }

    public function addField($fieldName, $args = array())
    {
        $this->fields[] = $this->newField($fieldName, $args);

    }

    // public function newField($fieldName, $type = 'text', $name = '', $instructions = '', $required = false,
    //     $options = array(), $booleanAttributes = array(), $attributes = array())
    // {
    //    $field = new Field();
    //    $field->setField($fieldName, $type, $name , $instructions , $required, $options , $booleanAttributes , $attributes);
    //    return $field;
    // }

    public function newField($fieldName, $args = array())
    {
       $field = new Field();
       $field->setField($fieldName, $args);
       return $field;
    }

    // public function addFieldGroup( $groupType, $fields, $fieldGroup = '', $groupName = '') {
    //     $this->fields[] = $this->newFieldGroup($groupType, $fields, $fieldGroup, $groupName );
    // }
    // public function newFieldGroup($groupType, $fields, $fieldGroup = '', $groupName = '') {
    //     $group = new FieldGroup();
    //     $group->setGroup($groupType, $fields, $fieldGroup, $groupName );
    //     return $group;
    // }

    public function addFieldGroup( $fields, $args = array()) {
        $this->fields[] = $this->newFieldGroup($fields, $args );
    }
    public function newFieldGroup($fields, $args = array()) {
        $group = new FieldGroup();
        $group->setGroup($fields, $args);
        return $group;
    }

    // public function addFieldToGroup($field, $group) {
    //     $group->addField($field);
    //     return $group;
    // }

    public function addFieldToGroup($field, $group) {
        $group->addField($field);
        return $group;
    }

}

