<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Sdz\BlogBundle\Entity\Tag;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Sdz\BlogBundle\Entity\Publication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\PublicationRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="titre", message="Une publication existe déjà avec ce titre.")
 */
class Publication
{
	/**
	* @ORM\OneToMany(targetEntity="Sdz\BlogBundle\Entity\Commentaire",	mappedBy="publication")
	*/
	private $commentaires; // Ici commentaires prend un « s », car un article a plusieurs commentaires !

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
	 * @var DatetTime
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
     * 
     */
    private $contenu;

    /**
     * @var integer
     *
     * @ORM\Column(name="publication", type="integer")
     */
    private $publication;

     /**
	 * @ORM\Column(type="date", nullable=true)
	 */
    private $dateEdition;

	public function __construct()
	{
		$this->date = new \Datetime();
		$this->publication = true;
		
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
     * @return Publication
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
     * @return Publication
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
     * @return Publication
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
     * @return Publication
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
     * @param integer $publication
     * @return Publication
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;
    
        return $this;
    }

    /**
     * Get publication
     *
     * @return integer 
     */
    public function getPublication()
    {
        return $this->publication;
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
     * @return Publication
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
     * Add commentairesPub
     *
     * @param \Sdz\BlogBundle\Entity\Commentaire $commentaires
     * @return Publication
     */
    public function addCommentaires(\Sdz\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
		$commentaires->setPublication($this);
        return $this;
    }

    /**
     * Remove commentairesPub
     *
     * @param \Sdz\BlogBundle\Entity\Commentaire $commentairesPub
     */
    public function removeCommentaires(\Sdz\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentairesPub
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add commentaires
     *
     * @param \Sdz\BlogBundle\Entity\Commentaire $commentaires
     * @return Publication
     */
    public function addCommentaire(\Sdz\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
    
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
}