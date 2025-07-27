<?php
namespace Core;
class FormBuilder{
    private string $form;
    function __construct($action, $method="GET", array $attributes = []) {
        $attributes =$this->buildAttributes($attributes);
        $this->form = "<form action=\"$action\" method=\"$method\" $attributes >";
    }
    function input(string $type, string $name='', string $value = "", array $attributes = []): self {
        $attributes = $this->buildAttributes($attributes);
        $this->form .= "<label for=\"$name\">".ucfirst($name)."</label>";
        $this->form .= "<input type=\"$type\" name=\"$name\" value=\"$value\" $attributes>";
        $this->form .= "<div>".Session::error("$name")."</div>";
        return $this;
    }
    function submit(string $value = "Submit", array $attributes = []): self {
        $attributes = $this->buildAttributes($attributes);
        $this->form .= "<input type=\"submit\" value=\"$value\" $attributes>";
        return $this;
    }
    function dropdown(string $name, array $options, string $selected = "", array $attributes = []): self {
        $attributes = $this->buildAttributes($attributes);
        $this->form .= "<label for=\"$name\">".ucfirst($name)."</label>";
        $this->form .= "<select name=\"$name\" $attributes>";
        foreach ($options as $key => $val) {
            $isSelected = ($key == $selected) ? 'selected' : '';
            $this->form .= "<option value=\"$key\" $isSelected>$val</option>";
        }
        $this->form .= "</select>";
        return $this;
    }
    function checkbox(string $name, string $value = "", bool $checked = false, array $attributes = []): self {
        $attributes = $this->buildAttributes($attributes);
        $isChecked = $checked ? 'checked' : '';
        $this->form .= "<label for=\"$name\">".ucfirst($name)."</label>";
        $this->form .= "<input type=\"checkbox\" name=\"$name\" value=\"$value\" $isChecked $attributes>";
        return $this;
    }
    function textarea(string $name, string $value = "", array $attributes = []): self {
        $attributes = $this->buildAttributes($attributes);
        $this->form .= "<label for=\"$name\">".ucfirst($name)."</label>";
        $this->form .= "<textarea name=\"$name\" $attributes>$value</textarea>";
        return $this;
    }
    function build(): string {
        $this->form .= "</form>";
        return $this->form;
    }
    private function buildAttributes(array $attributes): string {
        $attr = '';
        foreach ($attributes as $key => $value) {
            $attr .= "$key=\"$value\" ";
        }
        return trim($attr);
    }

}