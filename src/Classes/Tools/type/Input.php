<?php

namespace Classes\Tools\type;

use Classes\Tools\GenericQuestion;

abstract class Input extends GenericQuestion
{
    public function render(): string
    {
        $html = '<div class="question-container">';
        $html .= sprintf(
            '<label for="%s">%s</label>',
            $this->getId(), $this->label
        );
        $html .= sprintf(
            '<input type="%s" %s value="%s" name="answer" id="%s"/>',
            $this->type, $this->isLocked() ? 'disabled' : '', $this->getValue(), $this->getId()
        );
        $html .= '</div>';
        return $html;
    }
}

?>