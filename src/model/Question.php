<?php

namespace app\quizz\model;

class Question
{
    private string $_text;
    private ReponseCollection $_responses;

    public function __construct(string $_text)
    {
        $this->_text = $_text;
        $this->_responses = new ReponseCollection();
    }

    public function getText(): string
    {
        return $this->_text;
    }

    public function addResponse(Reponse $_response)
    {
        $this->_responses[] = $_response;
    }
}

