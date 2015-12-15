<?php

namespace Sdz\BlogBundle\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

use Sdz\BlogBundle\Entity\Article;
use Sdz\BlogBundle\Form\ArticleType;
use Sdz\BlogBundle\Form\ArticleEditType;

use Sdz\BlogBundle\Entity\Events;
use Sdz\BlogBundle\Form\EventsType;
use Sdz\BlogBundle\Form\EventsEditType;

use Sdz\BlogBundle\Entity\Publication;
use Sdz\BlogBundle\Form\PublicationType;
use Sdz\BlogBundle\Form\PublicationEditType;

use Sdz\BlogBundle\Entity\Publicationip;
use Sdz\BlogBundle\Form\PublicationipType;
use Sdz\BlogBundle\Form\PublicationipEditType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
	public function indexAction($page)
	{
		// Pour récupérer la liste de tous les articles 
		$events = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('SdzBlogBundle:Events')
						 ->getEvents(3, $page); // 3 articles par page: c'est totalement arbitraire !
		// On ajoute ici les variables page et nb_page à la vue
		return $this->render('SdzBlogBundle:Blog:index.html.twig', array('events' => $events, 'page' => $page, 'nombrePage' => ceil(count($events)/3)));
	}
	
	public function avenirAction($page)
	{
		// Pour récupérer la liste de tous les articles 
		$publicationsip = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('SdzBlogBundle:Publicationip')
						 ->getPublicationsip(3, $page); // 3 articles par page: c'est totalement arbitraire !

		// On ajoute ici les variables page et nb_page à la vue
		return $this->render('SdzBlogBundle:Blog:avenir.html.twig', array('publicationsip' => $publicationsip, 'page' => $page, 'nombrePage' => ceil(count($publicationsip)/3)));
	}
	
	public function suiteipAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:suiteip.html.twig');
	}
	
	public function contactAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:contact.html.twig');
	}
	
	public function fticAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:ftic.html.twig');
	}
	
	public function fbureauAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:fbureau.html.twig');
	}
	
	public function santeAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:sante.html.twig');
	}
	
	public function osmAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:osm.html.twig');
	}
	
	public function jerryAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:jerry.html.twig');
	}
	
	public function contextsahelAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:contextsahel.html.twig');
	}
	
	public function equipeAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:equipe.html.twig');
	}
	
	public function mobileAction($page)
	{
		return $this->render('SdzBlogBundle:Blog:mobile.html.twig');
	}
	
	public function actfticAction($page)
	{
		// Pour récupérer la liste de tous les articles 
		$publications = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('SdzBlogBundle:Publication')
						 ->getPublications(3, $page); // 3 articles par page: c'est totalement arbitraire !

		// On ajoute ici les variables page et nb_page à la vue
		return $this->render('SdzBlogBundle:Blog:actftic.html.twig', array('publications' => $publications, 'page' => $page, 'nombrePage' => ceil(count($publications)/3)));
	}
    
    public function articleAction($page)
	{
		// Pour récupérer la liste de tous les articles 
		$articles = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('SdzBlogBundle:Article')
						 ->getArticles(3, $page); // 3 articles par page: c'est totalement arbitraire !

		// On ajoute ici les variables page et nb_page à la vue
		return $this->render('SdzBlogBundle:Blog:article.html.twig', array('articles' => $articles, 'page' => $page, 'nombrePage' => ceil(count($articles)/3)));
	}
    
    public function eventsAction($page)
	{
		// Pour récupérer la liste de tous les articles 
		$events = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('SdzBlogBundle:Events')
						 ->getEvents(3, $page); // 3 articles par page: c'est totalement arbitraire !

		// On ajoute ici les variables page et nb_page à la vue
		return $this->render('SdzBlogBundle:Blog:events.html.twig', array('events' => $events, 'page' => $page, 'nombrePage' => ceil(count($events)/3)));
	}
    
    public function voirAction(Article $article)
    {
		$listeArticleCompetence = $this->getDoctrine()
									   ->getManager()
									   ->getRepository('SdzBlogBundle:ArticleCompetence')
									   ->findByArticle($article->getId());
		return $this->render('SdzBlogBundle:Blog:voir.html.twig', array('article' => $article, 'listeArticleCompetence' => $listeArticleCompetence));
    }
    
    
    public function voireventsAction(Events $events)
    {
		$listeEventsCompetence = $this->getDoctrine()
									   ->getManager()
									   ->getRepository('SdzBlogBundle:EventsCompetence')
									   ->findByEvents($events->getId());
		return $this->render('SdzBlogBundle:Blog:voirevents.html.twig', array('events' => $events, 'listeEventsCompetence' => $listeEventsCompetence));
    }
    
    public function voirpubAction(Publication $publication)
    {
		$listeCommentaire = $this->getDoctrine()
									   ->getManager()
									   ->getRepository('SdzBlogBundle:Commentaire')
									   ->findByPublication($publication->getId());

		return $this->render('SdzBlogBundle:Blog:voirpub.html.twig', array('publication' => $publication, 'listeCommentaire' => $listeCommentaire));
    }
    
    public function voirpubipAction(Publicationip $publicationip)
    {
		$listeCommentaireip = $this->getDoctrine()
									   ->getManager()
									   ->getRepository('SdzBlogBundle:Commentaireip')
									   ->findByPublicationip($publicationip->getId());

		return $this->render('SdzBlogBundle:Blog:voirpubip.html.twig', array('publicationip' => $publicationip, 'listeCommentaireip' => $listeCommentaireip));
    }
    
    
    /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
    public function ajouterartAction()
    {	
		$article = new Article();
		$form = $this->createForm(new ArticleType, $article);

		$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
					if ($form->isValid()) {
						//$article->getImage()->upload();
						$em = $this->getDoctrine()->getManager();
						$em->persist($article);
						$em->flush();
						$this->get('session')->getFlashBag()->add('info', 'Article bien ajouté');

						return $this->redirect($this->generateUrl('sdz_blog_voir', array('id' => $article->getId())));
						//return $this->redirect($this->generateUrl('sdz_blog_homepage'));
					}
					
			}			
		return $this->render('SdzBlogBundle:Blog:ajouterart.html.twig', array('form' => $form->createView(),));
    }
    
    /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
    public function ajoutereventsAction()
    {	
		$events = new Events();
		$form = $this->createForm(new EventsType, $events);

		$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
				
					if ($form->isValid()) {
					
						$em = $this->getDoctrine()->getManager();
						$em->persist($events);
						$em->flush();
						$this->get('session')->getFlashBag()->add('info', 'Evenement bien ajouté');

						return $this->redirect($this->generateUrl('sdz_blog_voirevents', array('id' => $events->getId())));
						//return $this->redirect($this->generateUrl('sdz_blog_homepage'));
					}
					
			}			
		return $this->render('SdzBlogBundle:Blog:ajouterevents.html.twig', array('form' => $form->createView(),));
    }
    
    /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
    public function ajouterpubAction()
    {	
		$publication = new Publication();
		$form = $this->createForm(new PublicationType, $publication);

		$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
				
					if ($form->isValid()) {
						//$article->getImage()->upload();
						$em = $this->getDoctrine()->getManager();
						$em->persist($publication);
						$em->flush();
						$this->get('session')->getFlashBag()->add('info', 'Publication bien ajouté');

						return $this->redirect($this->generateUrl('sdz_blog_voirpub', array('id' => $publication->getId())));
					}
					
			}			
		return $this->render('SdzBlogBundle:Blog:ajouterpub.html.twig', array('form' => $form->createView(),));
    }
    

    /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
    public function ajouterpubipAction()
    {	
		$publicationip = new Publicationip();
		$form = $this->createForm(new PublicationipType, $publicationip);

		$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
				
					if ($form->isValid()) {
						//$article->getImage()->upload();
						$em = $this->getDoctrine()->getManager();
						$em->persist($publicationip);
						$em->flush();
						$this->get('session')->getFlashBag()->add('info', 'Publication bien ajouté');

						return $this->redirect($this->generateUrl('sdz_blog_voirpubip', array('id' => $publicationip->getId())));
					}
					
			}			
		return $this->render('SdzBlogBundle:Blog:ajouterpubip.html.twig', array('form' => $form->createView(),));
    }
    
     /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
    public function modifierAction(Article $article)
	{
		$form = $this->createForm(new ArticleEditType(), $article);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($article);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Article bien modifié');
				return $this->redirect($this->generateUrl('sdz_blog_voir', array('id' => $article->getId())));
			}
		}
		return $this->render('SdzBlogBundle:Blog:modifier.html.twig', array('form' => $form->createView(), 'article' => $article));

	}
	
     /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
    public function modifiereventsAction(Events $events)
	{
		$form = $this->createForm(new EventsEditType(), $events);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($events);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Evenement bien modifié');
				return $this->redirect($this->generateUrl('sdz_blog_voirevents', array('id' => $events->getId())));
			}
		}
		return $this->render('SdzBlogBundle:Blog:modifierevents.html.twig', array('form' => $form->createView(), 'events' => $events));

	}
	
	 /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function modifierpubAction(Publication $publication)
	{
		$form = $this->createForm(new PublicationEditType(), $publication);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($publication);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Publication bien modifié');
				return $this->redirect($this->generateUrl('sdz_blog_voirpub', array('id' => $publication->getId())));
			}
		}
		return $this->render('SdzBlogBundle:Blog:modifierpub.html.twig', array('form' => $form->createView(), 'publication' => $publication));

	}
	
		 /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function modifierpubipAction(Publicationip $publicationip)
	{
		$form = $this->createForm(new PublicationipEditType(), $publicationip);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($publicationip);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Publication bien modifié');
				return $this->redirect($this->generateUrl('sdz_blog_voirpubip', array('id' => $publicationip->getId())));
			}
		}
		return $this->render('SdzBlogBundle:Blog:modifierpubip.html.twig', array('form' => $form->createView(), 'publicationip' => $publicationip));

	}
	
	 /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function supprimerAction(Article $article)
    {
		$form = $this->createFormBuilder()->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
			// On supprime l'article
				$em = $this->getDoctrine()->getManager();
				$em->remove($article);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Article bien supprimé');
				// Puis on redirige vers l'accueil
				return $this->redirect($this->generateUrl('sdz_blog_article'));
			}
		}
		// Si la requête est en GET, on affiche une page de	confirmation avant de supprimer
		return $this->render('SdzBlogBundle:Blog:supprimer.html.twig', array('article' => $article, 'form' => $form->createView()));

	}
	
	/**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function supprimereventsAction(Events $events)
    {
		$form = $this->createFormBuilder()->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
			// On supprime l'evenement
				$em = $this->getDoctrine()->getManager();
				$em->remove($events);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Evénement bien supprimé');
				// Puis on redirige vers l'accueil
				return $this->redirect($this->generateUrl('sdz_blog_events'));
			}
		}
		// Si la requête est en GET, on affiche une page de	confirmation avant de supprimer
		return $this->render('SdzBlogBundle:Blog:supprimerevents.html.twig', array('events' => $events, 'form' => $form->createView()));

	}
	
	 /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function supprimerpubAction(Publication $publication)
    {
		$form = $this->createFormBuilder()->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
			// On supprime l'article
				$em = $this->getDoctrine()->getManager();
				$em->remove($publication);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Publication bien supprimé');
				// Puis on redirige vers l'accueil
				return $this->redirect($this->generateUrl('sdz_blog_homepage'));
			}
		}
		// Si la requête est en GET, on affiche une page de	confirmation avant de supprimer
		return $this->render('SdzBlogBundle:Blog:supprimerpub.html.twig', array('publication' => $publication, 'form' => $form->createView()));

	}
	
	
	 /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function supprimerpubipAction(Publicationip $publicationip)
    {
		$form = $this->createFormBuilder()->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
			// On supprime l'article
				$em = $this->getDoctrine()->getManager();
				$em->remove($publicationip);
				$em->flush();
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Publication bien supprimé');
				// Puis on redirige vers l'accueil
				return $this->redirect($this->generateUrl('sdz_blog_homepage'));
			}
		}
		// Si la requête est en GET, on affiche une page de	confirmation avant de supprimer
		return $this->render('SdzBlogBundle:Blog:supprimerpubip.html.twig', array('publicationip' => $publicationip, 'form' => $form->createView()));

	}
	
	public function menuAction($nombre)
	{
		$liste = $this->getDoctrine()
					  ->getManager()
                      ->getRepository('SdzBlogBundle:Article')
                      ->findBy(array(), // Pas de critère
							   array('date' => 'desc'),  // On trie par date décroissante
							   $nombre, // On sélectionne $nombre articles
							   0 // À partir du premier
							  );
		return $this->render('SdzBlogBundle:Blog:menu.html.twig', array('liste_articles' => $liste )); // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
	}
	
	
	 /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function modifierImageAction($id_article)
	{
		$em = $this->getDoctrine()->getManager();
		// On récupère l'article
		$article = $em->getRepository('SdzBlogBundle:Article')->find($id_article);
		// On modifie l'URL de l'image par exemple
		$article->getImage()->setUrl('test.png');
		// On n'a pas besoin de persister notre article (si vous le faites, aucune erreur n'est déclenchée, Doctrine l'ignore)
		// Rappelez-vous, il l'est automatiquement car on l'a récupéré depuis Doctrine
		// Pas non plus besoin de persister l'image ici, car elle est également récupérée par Doctrine
		// On déclenche la modification
		$em->flush();
		return new Response('OK');
	}
	
	 /**
	 * @Secure(roles="ROLE_AUTEUR")
	 */
	public function modifierImageEventsAction($id_events)
	{
		$em = $this->getDoctrine()->getManager();
		// On récupère l'article
		$events = $em->getRepository('SdzBlogBundle:Events')->find($id_events);
		// On modifie l'URL de l'image par exemple
		$events->getImageEvents()->setUrl('test.png');
		// On n'a pas besoin de persister notre article (si vous le faites, aucune erreur n'est déclenchée, Doctrine l'ignore)
		// Rappelez-vous, il l'est automatiquement car on l'a récupéré depuis Doctrine
		// Pas non plus besoin de persister l'image ici, car elle est également récupérée par Doctrine
		// On déclenche la modification
		$em->flush();
		return new Response('OK');
	}
	


}
