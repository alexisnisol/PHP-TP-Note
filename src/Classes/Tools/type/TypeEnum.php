<?php

namespace Classes\Tools\type;

enum TypeEnum: string
{
    case checkbox = InputSelection::ADMIN_FORM;
    case text = Text::ADMIN_FORM;
    
    static function getTypes(): array {
        return self::cases();
    }
}

?>