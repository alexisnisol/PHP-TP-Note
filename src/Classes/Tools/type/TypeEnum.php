<?php

namespace Classes\Tools\type;

enum TypeEnum {
    case checkbox;
    case text;
    
    static function getTypes(): array {
        return self::cases();
    }
}

?>