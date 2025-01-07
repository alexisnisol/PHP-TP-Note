<?php
declare(strict_types=1);

namespace Provider;

abstract class DataLoader implements IDataLoader {
    
    protected $content;

    public function getData(): array {
        return $this->content;
    }
 
}