<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Sdz\BlogBundle\Entity\Tag;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
* Sdz\BlogBundle\Entity\Events
*
* @ORM\Table()
* @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\EventsRepository")
* @ORM\HasLifecycleCallbacks()
* @UniqueEntity(fields="titre", message="Un evenement existe déjà avec ce titre.")
*/

class Events
{	
	/**
     * @ORM\ManyToMany(targetEntity="Sdz\BlogBundle\Entity\Categorie", cascade={"persist"})
     */

	private $categories;
	
	/**
	* @ORM\OneToMany(targetEntity="Sdz\BlogBundle\Entity\Commentaire",
	mappedBy="events")
	*/
	private $commentaires; // Ici commentaires prend un « s », car un evenements a plusieurs commentaires !


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
	 * @var DateTime
	 *
	 * @ORM\Column(name="date", type="datetime")
	 * @Assert\DateTime()
	 */

    private $date;

    /**
     * @var string 
     *
     * @ORM\Column(name="titre", type="string", length=255, unique=true)
     * 
     */
    private $titre;

    /**
     * @var string 
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     * 
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $contenu;
    
    /**
	 * @ORM\Column(type="date", nullable=true)
	 */
	private $dateEdition;


	/**
	 * @ORM\Column(name="publication", type="boolean")
	 */
	private $publication;
	
	
	/**
	 * @ORM\OneToOne(targetEntity="Sdz\BlogBundle\Entity\ImageEvents", cascade={"persist", "remove"})
	 * @ Assert\File
	 * @Assert\Valid()
  	 */
	private $imageEvents;
	
	// Et modifions le constructeur pour mettre cet attribut publication à true par défaut
	public function __construct()
	{
		$this->date = new \Datetime();
		$this->publication = true;
		
		$this->categories = new \Doctrine\Common\Collections\ArrayCollection();
		$this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();

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
     * Set date
     *
     * @param \DateTime $date
     * @return Events
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Events
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Events
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    
        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Events
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     * @return Events
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;
    
        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set imageEvents
     *
     * @param \Sdz\BlogBundle\Entity\ImageEvents $imageEvents
     * @return Events
     */
    public function setImageEvents(\Sdz\BlogBundle\Entity\ImageEvents $imageEvents = null)
    {
        $this->imageEvents = $imageEvents;
    
        return $this;
    }

    /**
     * Get imageEvents
     *
     * @return \Sdz\BlogBundle\Entity\ImageEvents
     */
    public function getImageEvents()
    {
        return $this->imageEvents;
    }
    
    
    /**
     * Add categories
     *
     * @param \Sdz\BlogBundle\Entity\Categorie $categories
     * @return Events
     */
    public function addCategorie(\Sdz\BlogBundle\Entity\Categorie $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Sdz\BlogBundle\Entity\Categorie $categories
     */
    public function removeCategorie(\Sdz\BlogBundle\Entity\Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add commentaires
     *
     * @param \Sdz\BlogBundle\Entity\Commentaire $commentaires
     * @return Events
     */
    public function addCommentaire(\Sdz\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
		$commentaires->setEvents($this);
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \Sdz\BlogBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\Sdz\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
    
    /**
	* @ORM\PreUpdate
	*/
    public function updateDate()
	{
		$this->setDateEdition(new \Datetime());
	}

    /**
     * Set dateEdition
     *
     * @param \DateTime $dateEdition
     * @return Eventts
     */
    public function setDateEdition($dateEdition)
    {
        $this->dateEdition = $dateEdition;
    
        return $this;
    }

    /**
     * Get dateEdition
     *
     * @return \DateTime 
     */
    public function getDateEdition()
    {
        return $this->dateEdition;
    }

    /**
     * Set categories
     *
     * @param \Sdz\BlogBundle\Entity\ImageEvents $categories
     * @return Events
     */  
    public function setCategories(\Sdz\BlogBundle\Entity\ImageEvents $categories = null)
    {
        $this->categories = $categories;
    
        return $this;
    }


}