<?php

namespace Jbl\StudioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jbl\StudioBundle\Entity\Phone
 *
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="Jbl\StudioBundle\Entity\PhoneRepository")
 */
class Phone
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean $available
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available;


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
     * Set available
     *
     * @param boolean $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }

    /**
     * Get available
     *
     * @return boolean 
     */
    public function getAvailable()
    {
        return $this->available;
    }
}