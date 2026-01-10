<?php


namespace classes;

use data\Conexion;

require_once __DIR__ . "/../data/Conexion.php";


class City
{
    private $id;
    private $name;
    private $population;
    private $country;

    public function __construct($name, $population, $country)
    {
        $this->name = $name;
        $this->population = $population;
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @param mixed $population
     */
    public function setPopulation($population)
    {
        $this->population = $population;
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

    public static function getCity($name)
    {
        $con = (new Conexion())->getPdo();
        $stmt = $con->prepare("SELECT * FROM city WHERE name = :id");
        $stmt->bindParam(":id", $name);
        $stmt->execute();
        $result = $stmt->fetch();
        return json_encode($result);
    }

    public static function getCities()
    {
        $con = (new Conexion())->getPdo();
        $stmt = $con->prepare("SELECT * FROM cities");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return json_encode($result);
    }


}