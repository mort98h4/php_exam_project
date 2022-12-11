<?php

include_once __DIR__ . '/../utils.php';

class Brewery {
    private string $name;

    public function setName(string $name): bool {
        if (!$this->nameIsValid($name)) {
            return false;
        } else {
            $this->name = $name;
            return true;
        }
    }

    public function nameIsValid(string $name): bool {
        return ((strlen($name) >= _STR_MIN_LEN) && (strlen($name) <= _STR_MAX_LEN));
    }

    public function name(): string {
        return (isset($this->name) ? $this->name : '');
    }
}