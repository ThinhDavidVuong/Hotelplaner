<?php

class textareaBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('name');
        $this->addProperty('value', null);
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= "    <label class=\"col-md-2 control-label\" for=\"textinput\">{$this->label}</label>";
        $result .= "    <br/>";
        $result .= '    <div class="col-md-4">';
        $result .= "        <textarea name=\"{$this->name}\" class=\"form-control input-md commentarea\" required>{$this->value}</textarea>";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
