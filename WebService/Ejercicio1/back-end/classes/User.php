<?php

class User
{
    private $name;
    private $surname;
    private $birthday;
    private $country;

    function __construct($name, $surname, $birthday, $country){
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    public static function getUsers(){
        $content = file_get_contents("../data/usuarios.json");
        return $content;
    }

    public static function getUser($id){
        $content = file_get_contents("../data/usuarios.json");
        $users = json_decode($content, true);
        return json_encode($users[$id]);
    }

    public static function deleteUser($id){
        $content = file_get_contents("../data/usuarios.json");
        $users = json_decode($content, true);
        array_splice($users, $id, 1);
        $file = fopen("../data/usuarios.json", "w");
        fwrite($file, json_encode($users));
        fclose($file);
    }

    public function create()
    {
        try {
            $content = file_get_contents("../data/usuarios.json");
            $users = json_decode($content, true);
            $users[] = array(
                "name" => $this->name,
                "surname" => $this->surname,
                "birthday" => $this->birthday,
                "country" => $this->country
            );
            $file = fopen("../data/usuarios.json", "w");
            fwrite($file, json_encode($users));
            fclose($file);
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public function update($index){
        try{
            $content = file_get_contents("../data/usuarios.json");
            $users = json_decode($content, true);
            $user = array(
                'name' => $this->name,
                'surname' => $this->surname,
                'birthday' => $this->birthday,
                'country' => $this->country
            );
            $users[$index] = $user;
            $file=fopen("../data/usuarios.json", "w");
            fwrite($file, json_encode($users));
            fclose($file);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }



}