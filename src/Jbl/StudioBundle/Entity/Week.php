<?php

namespace Jbl\StudioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jbl\StudioBundle\Entity\Week
 *
 * @ORM\Table(name="week")
 * @ORM\Entity(repositoryClass="Jbl\StudioBundle\Entity\WeekRepository")
 */
class Week
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
     * @var date $start
     *
     * @ORM\Column(name="start", type="date", unique=true)
     */
    private $start;
    
    /**
     * @var date $end
     *
     * @ORM\Column(name="end", type="date", unique=true)
     */
    private $end;

    /**
     * @var boolean $isFree
     *
     * @ORM\Column(name="is_free", type="boolean")
     */
    private $isFree;
    
    /**
     * @ORM\ManyToOne(targetEntity="Rate", inversedBy="weeks", cascade={"remove"})
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id")
     */
    protected $rate;
    
    /**
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="contacts", cascade={"remove"})
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    protected $contact;   
    
    
    
    


    public function __construct()
    {
    	$this->isFree = true;
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
     * Set start
     *
     * @param date $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * Get start
     *
     * @return date 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param date $end
     */
    public function setEnd($end)
    {
    	$this->end = $end;
    }
    
    /**
     * Get end
     *
     * @return date
     */
    public function getEnd()
    {
    	return $this->end;
    }

    /**
     * Set isFree
     *
     * @param boolean $isFree
     */
    public function setIsFree($isFree)
    {
        $this->isFree = $isFree;
    }

    /**
     * Get isFree
     *
     * @return boolean 
     */
    public function getIsFree()
    {
        return $this->isFree;
    }

    /**
     * Set rate
     *
     * @param Jbl\StudioBundle\Entity\Rate $rate
     */
    public function setRate(\Jbl\StudioBundle\Entity\Rate $rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get rate
     *
     * @return Jbl\StudioBundle\Entity\Rate 
     */
    public function getRate()
    {
        return $this->rate;
    }
    
    /**
     * Set contact
     *
     * @param $contact
     */
    public function setContact($contact)
    {
    	$this->contact = $contact;
    }
    
    /**
     * Get contact
     *
     * @return Jbl\StudioBundle\Entity\Contact
     */
    public function getContact()
    {
    	return $this->contact;
    }
}