<?php

namespace Jbl\StudioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jbl\StudioBundle\Entity\Rate
 *
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="Jbl\StudioBundle\Entity\RateRepository")
 */
class Rate
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
     * @var integer $value
     *
     * @ORM\Column(name="value", type="integer", nullable=true)
     */
    private $value;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Week", mappedBy="rate", cascade={"remove", "persist"})
     */
    protected $weeks;


    public function __construct()
    {
    	$this->value = 0;
    	$this->weeks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set value
     *
     * @param integer $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add weeks
     *
     * @param Jbl\StudioBundle\Entity\Week $weeks
     */
    public function addWeek(\Jbl\StudioBundle\Entity\Week $weeks)
    {
        $this->weeks[] = $weeks;
    }

    /**
     * Get weeks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getWeeks()
    {
        return $this->weeks;
    }
    
    /**
     * Set weeks
     *
     * @param \Doctrine\Common\Collections\Collection $comments
     */
    public function setWeeks(\Doctrine\Common\Collections\Collection $weeks)
    {
    	$this->weeks = $weeks;
    }
}