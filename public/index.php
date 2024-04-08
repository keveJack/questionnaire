<?php
declare (strict_types = 1);
use app\quizz\model\QuestionCollection;
use app\quizz\model\Quizz;
use app\quizz\model\ReponseCollection;

/** /public/index.php */
require_once dirname(__DIR__) . '/vendor/autoload.php';
// $json = file_get_contents('quizzphp.json');
// $json_data = json_decode($json);
// $quizz = Quizz::create($json_data);


try
{
    // $connexion = new PDO('mysql:host=mysql-srv;dbname=quizz','de_user','password');
    // $statement=$connexion->prepare('select * from quizz;');
    // $statement->execute();
    // while ($row = $statement->fetch()){
    //     print_r($row);
    // }
    $liste = Quizz::list();
    var_dump($liste);
}
catch (PDOException $e)
{
    echo"error:".$e->getMessage();
}
echo "YOLOOO<br>";
var_dump(Quizz::findById(1));
echo "YOLOOO<br>";
var_dump(QuestionCollection::listById(1));
echo "YOLOOO<br>";
var_dump(ReponseCollection::listById(1));

