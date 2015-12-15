<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
*/
class EventsCompetence
{
	/**
	* @ORM\Id
	* @ORM\ManyToOne(targetEntity="Sdz\BlogBundle\Entity\Events")
	*/
	private $events;
	/**
	* @ORM\Id
	* @ORM\ManyToOne(targetEntity="Sdz\BlogBundle\Entity\Competence")
	*/
	private $competence;
	/**
	* @ORM\Column()
	*/
	private $niveau; // Ici j'ai un attribut de relation « niveau »
	
	// ... vous pouvez ajouter d'autres attributs bien entendu

    /**
     * Set niveau
     *
     * @param string $niveau
     * @return EventsCompetence
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    
        return $this;
    }

    /**
     * Get niveau
     *
     * @return string 
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set events
     *
     * @param \Sdz\BlogBundle\Entity\Events $events
     * @return EventsCompetence
     */
    public function setEvents(\Sdz\BlogBundle\Entity\Events $events)
    {
        $this->events = $events;
    
        return $this;
    }

    /**
     * Get events
     *
     * @return \Sdz\BlogBundle\Entity\Events
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set competence
     *
     * @param \Sdz\BlogBundle\Entity\Competence $competence
     * @return EventsCompetence
     */
    public function setCompetence(\Sdz\BlogBundle\Entity\Competence $competence)
    {
        $this->competence = $competence;
    
        return $this;
    }

    /**
     * Get competence
     *
     * @return \Sdz\BlogBundle\Entity\Competence 
     */
    public function getCompetence()
    {
        return $this->competence;
    }
}