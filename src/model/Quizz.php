<?php

namespace app\quizz\model;

class Quizz
{
    private string $_title;
    private int $_id;
    private QuestionCollection $_questions;

    public function __construct(string $title = 'No title choosen', int $id = 0)
    {
        $this->_title = $title;
        $this->_questions = new QuestionCollection;
        $this->_id = $id;
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
    public static function create($pJsonObject): Quizz
    {

        if (is_object($pJsonObject) && property_exists($pJsonObject, 'title') && property_exists($pJsonObject, 'questions')) {

            $quizz = new Quizz();
            $quizz->_title = $pJsonObject->title;

            foreach ($pJsonObject->questions as $question) {

                // if (is_object($question) && property_exists($question, 'text') && property_exists($question, 'responses')) {

                //     $questionObj = new Question();
                //     $questionObj->text = $question->text;

                //     foreach ($question->responses as $response) {

                //         if (is_object($response) && property_exists($response, 'text') && property_exists($response, 'isValid')) {

                //             $responseObj = new Response();
                //             $responseObj->text = $response->text;
                //             $responseObj->isValid = $response->isValid;

                //             $questionObj->addResponse($responseObj);
                //         }
                //     }

                //     $quizz->addQuestion($questionObj);
                // }
            }

            return $quizz;
        } else {

            throw new \Exception('Invalid JSON object');
        }
    }
    public static function list(): \ArrayObject
    {
        $liste = new \ArrayObject();
        $statement = Database::getInstance()->getConnexion()->prepare('select * from quizz;');
        $statement->execute();
        while ($row = $statement->fetch()) {
            $liste[] = new Quizz(id: $row['id'], title: $row['titre']);
        }
        return $liste;
    }
    public static function findById(int $id): ?Quizz
    {
        $statement = Database::getInstance()->getConnexion()->prepare('select * from quizz where id =:id;');
        $statement->execute(['id' => $id]);
        if ($row = $statement->fetch()) {
            return new Quizz(id: $row['id'], title: $row['titre']);
        }

        return null;
    }
    public static function filter(string $texte): \ArrayObject
    {
        $liste = new \ArrayObject();
        $statement = Database::getInstance()->getConnexion()->prepare('select * from quizz where titre like :textSearched;');
        $statement->execute(['textSearched' => $texte]);
        while ($row = $statement->fetch()) {
            $liste[] = new Quizz(id: $row['id'], title: $row['titre']);
        }
        return $liste;
    }
}
