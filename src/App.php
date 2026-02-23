<?php

declare(strict_types=1);

namespace evgeny87\BracketValidator;

use evgeny87\BracketValidator\Service\BracketValidator as ValidatorService;
use evgeny87\BracketValidator\Exceptions\InvalidBracketsException;

class App 
{
    private ValidatorService $validator;

    public function __construct() 
    {
        $this->validator = new ValidatorService();
    }

    public function run(): string 
    {
        header('Content-Type: text/plain; charset=utf-8');
        try {
            $input = $_POST['string'] ?? '';
            $this->validator->verify($input);
            
            http_response_code(200);
            return "200 OK: Всё хорошо";

        } catch (InvalidBracketsException $e) {
            http_response_code(400);
            return "400 Bad Request: Всё плохо. " . $e->getMessage();
        } catch (\Throwable $e) {
            http_response_code(500);
            return "500 Internal Server Error";
        }
    }
}
