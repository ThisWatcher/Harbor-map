<?php

namespace App\Entity;

use JsonSerializable;

class Harbor implements JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $lat;

    /**
     * @var int
     */
    private $lon;

    /**
     * @var string
     */
    private $image;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Harbor
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Harbor
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param int $lat
     * @return Harbor
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return int
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param int $lon
     * @return Harbor
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Harbor
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'lon' => $this->getLon(),
            'lat' => $this->getLat(),
            'image' => $this->getImage(),
        ];
    }

}