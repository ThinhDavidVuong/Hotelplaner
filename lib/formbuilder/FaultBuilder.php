<?php

class FaultBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('message');
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= "    <label class=\"col-md-6 control-label\" for=\"textinput\">{$this->message}</label>";
        $result .= '</div>';

        return $result;
    }
}
