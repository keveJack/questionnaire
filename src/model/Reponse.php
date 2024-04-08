<?php
declare (strict_types = 1);
namespace app\quizz\model;

class Reponse
{
    private $_text;
    private $_isValid;

    public function __construct(string $_text, bool $_isValid = false, int $id = 0)
    {
        $this->_text = $_text;
        $this->_isValid = $_isValid;
    }

    public function getText(): string
    {
        return $this->_text;
    }

    public function isValid(): bool
    {
        return $this->_isValid;
    }
}
