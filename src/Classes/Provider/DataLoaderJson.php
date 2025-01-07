<?php
declare(strict_type=1);

namespace Provider;

final class DataLoaderJson extends DataLoader {
    
    public function __construct(string $path) {
        $this->content = json_decode(file_get_contents($path), true);
    }
}