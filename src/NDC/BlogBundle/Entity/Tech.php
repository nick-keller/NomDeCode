<?php

namespace NDC\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Tech
 * @ExclusionPolicy("all")
 */
class Tech
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Expose
     */
    private $name;

    /**
     * @var string
     * @Expose
     */
    private $color;

    /**
     * @var string
     * @Expose
     */
    private $slug;

    /**
     * @var string
     */
    private $abbr;

    /**
     * @var string
     */
    private $txtColor;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tech
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Tech
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Tech
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set abbr
     *
     * @param string $abbr
     * @return Tech
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get txtColor
     *
     * @return string
     */
    public function getTxtColor()
    {
        return $this->txtColor;
    }

    /**
     * Set txtColor
     *
     * @param string $txtColor
     * @return Tech
     */
    public function setTxtColor($txtColor)
    {
        $this->txtColor = $txtColor;

        return $this;
    }
}
