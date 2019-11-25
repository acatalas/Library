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
                
            }
        }

        private function addError($key, $value){
            $this->errors[$key] = $value;
        }

    }

    class FormField{
        private $fieldName;
        private $fieldValue;
        private $validations;

        public function __construct($fieldName, $fieldValue, $validations)
        {
            $this->fieldName;
            $this->fieldValue;
            $this->validations = $validations
        }
    }
?>