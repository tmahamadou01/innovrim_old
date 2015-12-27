<?php

namespace Sdz\BlogBundle\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
	public function indexAction($page)
	{
		totalement arbitraire !
		// On ajoute ici les variables page et nb_page à la vue
		return $this->render('SdzBlogBundle:Blog:index.html.twig');
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

}
