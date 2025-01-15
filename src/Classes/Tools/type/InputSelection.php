<?php

namespace Classes\Tools\type;

use Classes\Tools\GenericQuestion;

abstract class InputSelection extends GenericQuestion
{

    public const ADMIN_FORM = <<<HTML
    <label for="options">Choix (séparés par des points-virgules)</label>
    <input type="text" id="options" name="options" required>
    <label for="answer">Réponse(s) (séparés par des points-virgules)</label>
    <input type="text" id="answer" name="answer" required>
    HTML;

    public function render(): string
    {
        $html = '<div class="question-container">';
        foreach ($this->choices as $key => $choice) {
            $html .= "<div class='question'>";
            $html .= sprintf(
                '<input type="%s" %s value="%s" name="answer[]" id="%s"/>',
                $this->type->name, $this->isLocked() ? 'disabled' : '', $choice, $choice
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