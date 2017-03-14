<?php

class PasswordBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('name');
        $this->addProperty('value', null);
        $this->addProperty('pattern', '^.{1,}$');
        $this->addProperty('titel', '');
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= "    <label class=\"col-md-2 control-label\" for=\"textinput\">{$this->label}</label>";
        $result .= '    <div class="col-md-4">';
        $result .= "        <input name=\"{$this->name}\" type=\"password\" value=\"{$this->value}\" pattern=\"{$this->pattern}\" title=\"{$this->titel}\" class=\"form-control input-md\" required>";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
