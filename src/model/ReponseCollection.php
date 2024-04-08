<?php
declare (strict_types = 1);
namespace app\quizz\model;

class ReponseCollection implements \ArrayAccess, \Countable, \Iterator

{
    private $_values;
    private $_position = 0;

    public function __construct()
    {
        $this->_values = [];
    }

    public function count(): int
    {
        return count($this->_values);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->_values[$offset]);
    }

    public function offsetGet($offset): Reponse
    {
        return $this->_values[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!($value instanceof Reponse)) {
            throw new \InvalidArgumentException("Must be a response");
        }
        if (empty($offset)) {
            $this->_values[] = $value;
        } else {
            $this->_values[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->_values[$offset]);
    }

    public function rewind(): void
    {
        reset($this->_values);
        $this->_position = 0;
    }

    public function current(): Reponse
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
    public static function listById(int $id): ReponseCollection
    {
        $liste = new ReponseCollection();
        $statement = Database::getInstance()->getConnexion()->prepare('select * from reponse where numQuestion = :id;');
        $statement->execute(['id' => $id]);
        while ($row = $statement->fetch()) {
            $reponse = new Reponse($row['texte'], $row['is_valid'] == 1 ? true : false, $row['id']);
            $liste[] = $reponse;

        }
        return $liste;
    }
}
