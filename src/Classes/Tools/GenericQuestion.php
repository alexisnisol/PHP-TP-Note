<?php

namespace Classes\Tools;

use Classes\Tools\type\TypeEnum;

abstract class GenericQuestion implements InputRenderInterface
{

    public const ADMIN_FORM = <<<HTML
        <label for="answer">Réponse</label>
        <input type="text" id="answer" name="answer" required>
        HTML;

    protected TypeEnum $type;

    protected string $label = '';

    protected array $choices = [];

    protected mixed $answer = '';

    protected int $score = 0;

    protected mixed $value = '';

    protected bool $locked = false;

    public function __construct(
        protected readonly string $id,
        string                    $label,
        array                     $choices,
        mixed                     $answer,
        int                       $score = 1,
        mixed                     $value = '')
    {
        $this->label = $label;
        $this->choices = $choices;
        $this->answer = $answer;
        $this->score = $score;
        $this->value = $value;
    }


    public function __toString(): string
    {
        return $this->render();
    }

    function getLabel(): string
    {
        return $this->label;

    }

    function getId(): string
    {
        return $this->id;
    }
    function getScore(): int
    {
        return $this->score;
    }

    function getValue(): string|array
    {
        return $this->value;
    }

    function isLocked(): bool
    {
        return $this->locked;
    }

    function setValue(string|array $value): void
    {
        $this->value = $value;
    }

    function setLocked(bool $locked): void
    {
        $this->locked = $locked;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function checkAnswer($response): bool
    {
        if (is_null($response)) return false;
        return $this->answer == $response;
    }
}


?>