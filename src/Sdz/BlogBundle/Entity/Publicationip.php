<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Sdz\BlogBundle\Entity\Tag;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Sdz\BlogBundle\Entity\Publicationip
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\PublicationipRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="titre", message="Une publication existe déjà avec ce titre.")
 */
class Publicationip
{
	/**
	* @ORM\OneToMany(targetEntity="Sdz\BlogBundle\Entity\Commentaireip",	mappedBy="publicationip")
	*/
	private $commentairesip; // Ici commentaires prend un « s », car un article a plusieurs commentaires !

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
     * @ORM\Column(name="publicationip", type="integer")
     */
    private $publicationip;

     /**
	 * @ORM\Column(type="date", nullable=true)
	 */
    private $dateEdition;

	public function __construct()
	{
		$this->date = new \Datetime();
		$this->publicationip = true;
		
		$this->commentairesip = new \Doctrine\Common\Collections\ArrayCollection();

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
     * @return Publicationip
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
     * @return Publicationip
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
     * @return Publicationip
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
     * @return Publicationip
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
     * Set publicationip
     *
     * @param integer $publicationip
     * @return Publicationip
     */
    public function setPublicationip($publicationip)
    {
        $this->publicationip = $publicationip;
    
        return $this;
    }

    /**
     * Get publicationip
     *
     * @return integer 
     */
    public function getPublicationip()
    {
        return $this->publicationip;
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
     * @return Publicationip
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
     * Add commentairesPubip
     *
     * @param \Sdz\BlogBundle\Entity\Commentaireip $commentairesip
     * @return Publicationip
     */
    public function addCommentairesip(\Sdz\BlogBundle\Entity\Commentaireip $commentairesip)
    {
        $this->commentairesip[] = $commentairesip;
		$commentairesip->setPublicationip($this);
        return $this;
    }

    /**
     * Remove commentairesPubip
     *
     * @param \Sdz\BlogBundle\Entity\Commentaireip $commentairesPubip
     */
    public function removeCommentairesip(\Sdz\BlogBundle\Entity\Commentaireip $commentairesip)
    {
        $this->commentairesip->removeElement($commentairesip);
    }

    /**
     * Get commentairesPubip
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentairesip()
    {
        return $this->commentairesip;
    }

    /**
     * Add commentairesip
     *
     * @param \Sdz\BlogBundle\Entity\Commentaireip $commentairesip
     * @return Publicationip
     */
    public function addCommentaireip(\Sdz\BlogBundle\Entity\Commentaireip $commentairesip)
    {
        $this->commentairesip[] = $commentairesip;
    
        return $this;
    }

    /**
     * Remove commentairesip
     *
     * @param \Sdz\BlogBundle\Entity\Commentaireip $commentairesip
     */
    public function removeCommentaireip(\Sdz\BlogBundle\Entity\Commentaireip $commentairesip)
    {
        $this->commentairesip->removeElement($commentairesip);
    }
}