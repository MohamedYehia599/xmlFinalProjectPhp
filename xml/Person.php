<?php
session_start();
class Person
{
    public $people;
    // private $index ;
    function __construct()
    {
        if (file_exists('person.xml'))
            $this->people = simplexml_load_file('person.xml');
            $this->set_max_index();
    }
     private function set_max_index()
     {
        $i = 0;
        foreach ($this->people->person as $person) {
            
            $i++;
        }
        $_SESSION['max_index']=$i-1;
     }

    public function insert($name, $phone, $address, $email)
    {
        $person = $this->people->addChild('person');
        $person->addChild('name', $name);
        $person->addChild('phone', $phone);
        $person->addChild('address', $address);
        $person->addChild('email', $email);
        $_SESSION['max_index']=$_SESSION['max_index']+1;
        file_put_contents('person.xml', $this->people->asXML());
    }
    public function update($name, $phone, $address, $email)
    {
        // echo $name;
        // echo $phone;
        // echo $address;
        // echo $email;
        foreach ($this->people->person as $person) {
            if ($person->name == $name || $person->phone == $phone || $person->address == $address || $person->email == $email) {
                $person->name = $name;
                $person->phone = $phone;
                $person->address = $address;
                $person->email = $email;
                break;
            }
        }
        file_put_contents('person.xml', $this->people->asXML());
    }
    public function delete($name)
    {
        $i = 0;
        foreach ($this->people->person as $person) {
            if ($person->name == $name) {
               
                $p = $i;
            }
            $i++;
        }
        if (isset($p)) {
            unset($this->people->person[$p]);
            file_put_contents('person.xml', $this->people->asXML());
            $_SESSION['max_index']=$_SESSION['max_index']-1;
        }
    }
    public function search($name)
    {
        $i = 0;
        $person_arr = array();
        foreach ($this->people->person as $person) {
            if ($person->name == $name) {
                array_push($person_arr, $name, $person->phone, $person->address, $person->email);
                $_SESSION['index']=$i;
                return $person_arr;
            }
            $i++;
        }
        return null;
    }
    public function get_next()
    {
        $person_arr = array();

        if(!isset($_SESSION['index']) ||$_SESSION['index'] == $_SESSION['max_index'] ){
          $person =  $this->people->person[0];
          array_push($person_arr, $person->name, $person->phone, $person->address, $person->email);
          $_SESSION['index'] =0;
          return $person_arr;

        }else{
        
        
        $i = 0;
        foreach ($this->people->person as $person) {
            if ($_SESSION['index'] == ($i - 1) ) {
                
                array_push($person_arr, $person->name, $person->phone, $person->address, $person->email);
                $_SESSION['index'] = $i;
                return $person_arr;
            }
            $i++;
        }
    }
}
public function get_prev(){
    $person_arr = array();

    if(!isset($_SESSION['index']) || $_SESSION['index'] == 0 ){
      $person =  $this->people->person[$_SESSION['max_index']];
      array_push($person_arr, $person->name, $person->phone, $person->address, $person->email);
      $_SESSION['index'] =$_SESSION['max_index'];
      return $person_arr;

    }else{
    
    
    $i = 0;
    foreach ($this->people->person as $person) {
        if ($_SESSION['index'] == ($i + 1) ) {
            
            array_push($person_arr, $person->name, $person->phone, $person->address, $person->email);
            $_SESSION['index'] = $i;
            return $person_arr;
        }
        $i++;
    }
}



}
}
