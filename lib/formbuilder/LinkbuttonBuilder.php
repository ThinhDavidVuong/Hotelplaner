<?php

class LinkbuttonBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('name');
        $this->addProperty('onclick');
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= '    <label class="col-md-2 control-label" for="textinput">&nbsp;</label>';
        $result .= '    <div class="col-md-4">';
        $result .= "        <a title=\"{$this->name}\" class=\"btn btn-primary\" href=\"{$this->onclick}\">{$this->label}</a>";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
