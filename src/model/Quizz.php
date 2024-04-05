<?php

namespace app\quizz\model;

use app\quizz\model\QuestionCollection;

class Quizz
{
    private string $_title;
    private QuestionCollection $_questions;

    public function __construct(string $title = 'No title choosen')
    {
        $this->_title = $title;
        $this->_questions = new QuestionCollection;
    }

    public function getTitle(): string
    {
        return $this->_title;
    }

    public function getQuestions(): QuestionCollection
    {
        return $this->_questions;
    }

    public function addQuestion(Question $question)
    {
        $this->_questions[] = $question;
    }
}

