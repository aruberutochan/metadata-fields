<?php

namespace Aruberuto\MetadataFields\Model;

use Illuminate\Support\Facades\View;
use Aruberuto\MetadataFields\Model\FieldGroup;

Class Field {

    public $name;
    public $bladeInput;
    public $type;
    public $label;
    public $instructions;
    public $required;
    public $options;
    public $booleanAttributes;
    public $attributes;
    public $id;

    // public function setField( $field, $type = 'text', $name = '', $instructions = '', $required = false,
    //     $options = array(), $booleanAttributes = array(), $attributes = array()
    // ){
    //     $this->field = $field;
    //     $this->type = $type;
    //     $this->name = $name;
    //     $this->instructions = $instructions;
    //     $this->required = $required;
    //     $this->options = $options;
    //     $this->booleanAttributes = $booleanAttributes;
    //     $this->attributes = $attributes;

    // }
    public function setField( $fieldName, $args = array() ){

        $this->name = $fieldName;
        $defaultBladeInput = 'fields::fields.inputs.default';
        $defaultArgs = array(
            'type'               => 'text',
            'id'                 => $fieldName,
            'label'              => '',
            'instructions'       => '',
            'required'           => false,
            'options'            => array(),
            'booleanAttributes'  => array(),
            'attributes'         => array()

        );

        foreach ($defaultArgs as $key => $value) {
            $this->$key = isset($args[$key]) ? $args[$key] : $value;
        }


        if(isset($args['bladeInput'])) {
            $this->bladeInput = $args['bladeInput'];
        } elseif(View::exists('fields::fields.inputs.' . strtolower($this->type) ) ) {
            $this->bladeInput = 'fields::fields.inputs.' . strtolower($this->type);
        } else {
            $this->bladeInput = $defaultBladeInput;
        }

    }

    public function renderInputField($value = '') {

        return view('fields::fields.input', ['field' => $this, 'value' => $value]);
    }

}
