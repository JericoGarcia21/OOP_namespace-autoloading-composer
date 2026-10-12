<?php 
namespace App\Models;
class Teacher{
    private $name;
    private $subject;
    public function __construct($name,$subject){
        $this->name = $name;
        $this->subject = $subject;
    }

    public function getSummary(){
        return "{$this->name} teaches {$this->subject}";
    }
}

?>