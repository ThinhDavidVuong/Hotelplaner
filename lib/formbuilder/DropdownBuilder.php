<?php

class DropdownBuilder extends Builder
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
        $result .= "      <select name=\"{$this->name}\">";
        $result .= "        <option value=\"emty\"></option>";
        foreach ($this->options as $option) {
          $result .="         <option value=\"$option\">$option</option>";
        }
        $result .= '         </select>';
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
