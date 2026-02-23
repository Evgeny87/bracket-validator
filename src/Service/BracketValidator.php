<?php

declare(strict_types=1);

namespace evgeny87\BracketValidator\Service;

use evgeny87\BracketValidator\Exceptions\InvalidBracketsException;

class BracketValidator 
{
    public function verify(string $string): void 
    {
        if (empty(trim($string))) {
            throw new InvalidBracketsException("Строка пуста");
        }

        $balance = 0;
        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] === '(') $balance++;
            if ($string[$i] === ')') $balance--;

            if ($balance < 0) {
                throw new InvalidBracketsException("Некорректный порядок скобок");
            }
        }

        if ($balance !== 0) {
            throw new InvalidBracketsException("Количество скобок не совпадает");
        }
    }
}
