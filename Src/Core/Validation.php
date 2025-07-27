<?php
namespace Core;
class Validation
{

    private array $errors = [];
    public function validate($rules)
    {
        foreach ($rules as $rule_name => $rule_values) {
            $rule_value = $_POST[$rule_name] ?? '';
            foreach ($rule_values as $rule) {
                if(str_contains($rule, ':')) {
                    [$rule, $min] = explode(':', $rule);
                    $this->$rule($rule_name, $rule_value, (int)$min);
                    continue;
                }
                $this->$rule($rule_name, $rule_value);
            }
        }
    }
    private function required($rule_name, $rule_value)
    {
        if (empty($rule_value)) {
            $this->addError($rule_name, "The $rule_name field is required.");
        }
    }
    private function string($rule_name, $rule_value)
    {
        if (!preg_match("/^[a-zA-Z0-9 .$!]+$/", $rule_value)) {
            $this->addError($rule_name, "The $rule_name field must be a string.");
        }
    }
    private function addError($rule_name, $message)
    {
        $this->errors[$rule_name][] = $message;
    }
    public function getErrors()
    {
        if(!empty($this->errors)){
            Session::set("errors",$this->errors);
            return $this->errors;
        }
        return false;
    }
    public function hasErrors()
    {
        return !empty($this->errors);
    }
    public function numeric($rule_name, $rule_value)
    {
        if (!is_numeric($rule_value)) {
            $this->addError($rule_name, "The $rule_name field must be numeric.");
        }
    }
    public function email($rule_name, $rule_value)
    {
        if (!filter_var($rule_value, \FILTER_VALIDATE_EMAIL)) {
            $this->addError($rule_name, "The $rule_name field must be a valid email address.");
        }
    }
    public function min($rule_name, $rule_value, $length)
    {
        if (strlen($rule_value) < $length) {
            $this->addError($rule_name, "The $rule_name field must be at least $length characters long.");
        }
    }
    public function max($rule_name, $rule_value, $length)
    {
        if (strlen($rule_value) > $length) {
            $this->addError($rule_name, "The $rule_name field must not exceed $length characters.");
        }
    }
}
