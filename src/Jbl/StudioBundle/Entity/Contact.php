<?php

namespace Jbl\StudioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jbl\StudioBundle\Entity\Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="Jbl\StudioBundle\Entity\ContactRepository")
 */
class Contact
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
     * @var string $firstName
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var text $address
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var text $info
     *
     * @ORM\Column(name="info", type="text", nullable=true)
     */
    private $info;

    /**
     * @ORM\OneToMany(targetEntity="Week", mappedBy="contact", cascade={"remove", "persist"})
     */
    protected $weeks;

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
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address
     *
     * @param text $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return text 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set info
     *
     * @param text $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Get info
     *
     * @return text 
     */
    public function getInfo()
    {
        return $this->info;
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