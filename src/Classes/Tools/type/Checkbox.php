<?php

namespace Classes\Tools\type;

final class Checkbox extends InputSelection
{
    protected TypeEnum $type = TypeEnum::checkbox;

    public function checkAnswer($response): bool
    {
        if (is_null($response)) return false;
        if(!is_array($this->answer)) {
            $this->answer = explode(',', $this->answer);
        }
        $diff1 = array_diff($this->answer, $response);
        $diff2 = array_diff($response, $this->answer);
        return count($diff1) == 0 && count($diff2) == 0;
    }

    public function getAnswer(): string
    {
        return implode(',', $this->answer);
    }
}

?>