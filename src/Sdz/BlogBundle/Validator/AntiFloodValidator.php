<?php
// src/Sdz/BlogBundle/Validator/AntiFloodValidator.php
namespace Sdz\BlogBundle\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;


class AntiFloodValidator extends ConstraintValidator
{
	private $request;
	private $em;

	public function __construct(Request $request, EntityManager $em)
	{
		$this->request = $request;
		$this->em = $em;
	}

	public function validate($value, Constraint $constraint)
	{
		$ip = $this->request->server->get('REMOTE_ADDR');
		$isFlood = $this->em->getRepository('SdzBlogBundle:Publication')->isFlood($ip, 15);


		// Pour l'instant, on considère comme flood tout message de moins de 3 caractères
		if (strlen($value) < 3 && $isFlood) {
		// C'est cette ligne qui déclenche l'erreur pour le	formulaire, avec en argument le message
			$this->context->addViolation($constraint->message, array('%string%'=> $value));
		}
	}
}
