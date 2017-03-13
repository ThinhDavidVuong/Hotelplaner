<?php

class textareaBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('name');
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= "    <label class=\"col-md-2 control-label\" for=\"textinput\">{$this->label}</label>";
        $result .= "    <br/>";
        $result .= '    <div class="col-md-4">';
        $result .= "        <textarea name=\"{$this->name}\" class=\"form-control input-md commentarea\" required>";
        $result .= "        </textarea>";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
