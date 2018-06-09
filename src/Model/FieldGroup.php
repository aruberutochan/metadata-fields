<?php

namespace Aruberuto\MetadataFields\Model;

use Illuminate\Support\Facades\View;
use Aruberuto\MetadataFields\Model\Field;

Class FieldGroup {
    public $fields = [];
    public $fieldGroup;
    public $groupType;
    public $groupName;
    public $bladeInput;

    // public function setGroup($groupType, $fields, $fieldGroup = '', $groupName = '') {
    //     $this->fields       = $fields;
    //     $this->fieldGroup   = $fieldGroup;
    //     $this->groupType    = $groupType;
    //     $this->groupName    = $groupName;
    // }
    public function setGroup($fields, $args = array()) {
        $this->fields       = $fields;
        $defaultBladeInput = 'fields::fields.groups.default';
        $defaultArgs = array(
            'groupType'     => 'default',
            'fieldGroup'    => '',
            'groupName'     => '',

        );

        foreach ($defaultArgs as $key => $value) {
            $this->$key = isset($args[$key]) ? $args[$key] : $value;
        }

        if(isset($args['bladeInput'])) {
            $this->bladeInput = $args['bladeInput'];
        } elseif(View::exists('fields::fields.groups.' . strtolower($this->groupType) ) ) {
            $this->bladeInput = 'fields::fields.groups.' . strtolower($this->groupType);
        } else {
            $this->bladeInput = $defaultBladeInput;
        }

    }

    public function renderFieldGroup() {

        return view('fields::fields.group', ['group' => $this]);
    }

    public function addField($field) {
        $this->fields[] = $field;
    }

}
