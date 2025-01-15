<?php

namespace Classes\Tools\type;

use Classes\Tools\GenericQuestion;

abstract class InputSelection extends GenericQuestion
{
    public function render(): string
    {
        $html = '<div class="question-container">';
        foreach ($this->choices as $key => $choice) {
            $html .= "<div class='question'>";
            $html .= sprintf(
                '<input type="%s" %s value="%s" name="answer[]" id="%s"/>',
                $this->type, $this->isLocked() ? 'disabled' : '', $choice, $choice
            );
            $html .= sprintf(
                '<label for="%s">%s</label>',
                $choice, $choice
            );
            $html .= "</div>";
        }
        $html .= '</div>';
        return $html;
    }
}

?>