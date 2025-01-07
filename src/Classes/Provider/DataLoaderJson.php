<?php
declare(strict_type=1);

namespace Provider;

final class DataLoaderJson extends DataLoader {
    
    public function _construct(string $filename) {
        $this->content = json_decode(file_get_contents($filename), true);
    }
}