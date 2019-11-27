<?php 
    class FormValidator{
        public static $REQUIRED = "REQUIRED";
        private $errors = [];
        private $fields;
        private $validationFunctions = [$REQUIRED => function($key, $value){
            if(empty(trim($value))){
                $this->addError($key, $value);
                return false;
            }
            return true;
        } ];

        public function __construct($fields)
        {
            $this->fields = $fields;
        }

        public function validateForm(){
            foreach($this->fields as $field){
                foreach($field->validations as $validation){
                    $this->validationFunctions[$validation]($field->fieldName, $field->fieldValue)
                }
            }
        }

        private function addError($key, $value){
            $this->errors[$key] = $value;
        }

    }

    class FormField{
        public $fieldName;
        public $fieldValue;
        public $validations;

        public function __construct($fieldName, $fieldValue, $validations)
        {
            $this->fieldName;
            $this->fieldValue;
            $this->validations = $validations
        }
    }
?>