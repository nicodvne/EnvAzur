<?php

namespace Application\Utils;

class Utils {
    public function arrayHas(array $array, string $key): bool {
        return array_key_exists($key, $array) && !empty($array[$key]);
    }
} 
