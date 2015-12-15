<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sdz\BlogBundle\Validator\AntiFlood;

/**
 * Commentaireip
 *
 * @ORM\Table()
   @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\CommentaireipRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class Commentaireip
{
	/**
	* @ORM\PrePersist 
	*/
	public function increase()
	{
		$nbCommentairesip = $this->getArticle()->getNbCommentairesip();
		$this->getArticle()->setNbCommentairesip($nbCommentairesip+1);
		
		$nbCommentairesip = $this->getPublicationip()->getNbCommentairesip();
		$this->getPublicationip()->setNbCommentairesip($nbCommentairesip+1);
	}
	
	/**
	* @ORM\PreRemove
	*/
	public function decrease()
	{
		$nbCommentairesip = $this->getArticle()->getNbCommentairesip();
		$this->getArticle()->setNbCommentairesip($nbCommentairesip-1);
		
		$nbCommentairesip = $this->getPublicationip()->getNbCommentairesip();
		$this->getPublicationip()->setNbCommentairesip($nbCommentairesip-1);
	}

	/**
	 * @ORM\ManyToOne(targetEntity="Sdz\BlogBundle\Entity\Article", inversedBy="commentairesip"))
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $article;

	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Sdz\BlogBundle\Entity\Publicationip", inversedBy="commentairesip"))
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $publicationip;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @AntiFlood()
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
	public function __construct()
	{
		$this->date = new \Datetime();
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
     * Set auteur
     *
     * @param string $auteur
     * @return Commentaireip
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
     * @return Commentaireip
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
     * Set date
     *
     * @param \DateTime $date
     * @return Commentaireip
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
     * Set article
     *
     * @param \Sdz\BlogBundle\Entity\Article $article
     * @return Commentaireip
     */
    public function setArticle(\Sdz\BlogBundle\Entity\Article $article)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return \Sdz\BlogBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set publicationip
     *
     * @param \Sdz\BlogBundle\Entity\Publicationip $publicationip
     * @return Commentaireip
     */
    public function setPublicationip(\Sdz\BlogBundle\Entity\Publicationip $publicationip)
    {
        $this->publicationip = $publicationip;
    
        return $this;
    }

    /**
     * Get publicationip
     *
     * @return \Sdz\BlogBundle\Entity\Publicationip 
     */
    public function getPublicationip()
    {
        return $this->publicationip;
    }
}