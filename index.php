<?php

// use App\View;

// session_start();

// require_once 'vendor/autoload.php';
// require_once 'const.php';

// // Looing for .env at the root directory
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// if(isset($_POST['login'])){
//     //todo login
// }else{
//     View::render('forms/form-login');
// }

class A
{
    public $name;
    public $id;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}

$test = new A();

$x = $test->setId(1)->setName('Fredrick');
print_r($x);
