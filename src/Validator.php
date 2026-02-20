<?php

declare(strict_types=1);

namespace evgeny\BracketValidator;

use evgeny\BracketValidator\Exceptions\InvalidBracketsException;

class Validator
{
    public function isValid(string $input): bool
    {
        if (empty(trim($input))) {
            throw new InvalidBracketsException("String cannot be empty.");
        }

        $balance = 0;
        $length = strlen($input);

        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];

            if ($char === '(') {
                $balance++;
            } elseif ($char === ')') {
                $balance--;
            }

            if ($balance < 0) {
                return false;
            }
        }

        return $balance === 0;
    }
}
