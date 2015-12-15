<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Sdz\BlogBundle\Entity\Tag;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
* Sdz\BlogBundle\Entity\Article
*
* @ORM\Table()
* @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\ArticleRepository")
* @ORM\HasLifecycleCallbacks()
* @UniqueEntity(fields="titre", message="Un article existe déjà avec ce titre.")
*/

class Article
{	
	/**
     * @ORM\ManyToMany(targetEntity="Sdz\BlogBundle\Entity\Categorie", cascade={"persist"})
     */

	private $categories;
	
	/**
	* @ORM\OneToMany(targetEntity="Sdz\BlogBundle\Entity\Commentaire",
	mappedBy="article")
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
	 * @ORM\OneToOne(targetEntity="Sdz\BlogBundle\Entity\Image", cascade={"persist", "remove"})
	 * @ Assert\File
	 * @Assert\Valid()
  	 */
	private $image;
	
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
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set image
     *
     * @param \Sdz\BlogBundle\Entity\Image $image
     * @return Article
     */
    public function setImage(\Sdz\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \Sdz\BlogBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Add categories
     *
     * @param \Sdz\BlogBundle\Entity\Categorie $categories
     * @return Article
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
     * @return Article
     */
    public function addCommentaire(\Sdz\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
		$commentaires->setArticle($this);
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
     * @return Article
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
     * @param \Sdz\BlogBundle\Entity\Image $categories
     * @return Article
     */
    public function setCategories(\Sdz\BlogBundle\Entity\Image $categories = null)
    {
        $this->categories = $categories;
    
        return $this;
    }
}