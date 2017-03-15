<?php

class MultipleBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('name');
        $this->addProperty('options');
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= "    <label class=\"col-md-2 control-label\" for=\"textinput\">{$this->label}</label>";
        $result .= '    <div class="col-md-4">';
        foreach ($this->options as $option) {
          $result .="         <input type="checkbox" name="{$this->name}" value=\"$option\">$option<br>";
        }
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
