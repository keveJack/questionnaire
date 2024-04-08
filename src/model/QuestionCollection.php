<?php

namespace app\quizz\model;

class QuestionCollection implements \ArrayAccess, \Countable, \Iterator

{
    private $_values = [];
    private int $_position = 0;

    public function __construct()
    {
        $this->_values = [];
    }

    public function offsetExists($offset): bool
    {
        return isset($this->_values[$offset]);
    }

    public function offsetGet($offset): Question
    {
        return $this->_values[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!($value instanceof Question)) {
            throw new \InvalidArgumentException("Must be a question");
        }
        if (empty($offset)) { //this happens when you do $collection[] = 1;
            $this->_values[] = $value;
        } else {
            $this->_values[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->_values[$offset]);
    }

    public function count(): int
    {
        return count($this->_values);
    }

    public function rewind(): void
    {
        reset($this->_values);
        $this->_position = 0;
    }

    public function current(): Question
    {
        return current($this->_values);
    }

    public function key(): Mixed
    {
        return key($this->_values);
    }

    public function next(): void
    {
        next($this->_values);
        $this->_position++;
    }

    public function valid(): bool
    {
        return key($this->_values) !== null;
    }
    public static function listById(int $id): ?QuestionCollection
    {
        $statement = Database::getInstance()->getConnexion()->prepare('select * from question where numquizz = :id;');
        $statement->execute(['id' => $id]);
        $liste = new QuestionCollection();
        while ($row = $statement->fetch()) {
            $question = new Question($row['texte'], $row['id']);
            $liste[] = $question;
        }
        return $liste;
    }
}
