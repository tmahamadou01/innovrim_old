<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * PublicationipRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PublicationipRepository extends EntityRepository
{
	public function getSelectList()
	{
		$qb = $this->createQueryBuilder('p')->where('p.publicationip = 1'); // On filtre sur l'attribut publication
		// Et on retourne simplement le QueryBuilder, et non la Query, attention
		return $qb;
	}

	public function getPublicationsip($nombreParPage, $page)
	{
		if ($page < 1) {
			throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "'.$page.'").');
		}

		// On déplace la vérification du numéro de page dans cette méthode
		$query = $this->createQueryBuilder('p')
			          ->orderBy('p.date', 'DESC')
                      ->getQuery();
        
		// On définit l'article à partir duquel commencer la liste
		$query->setFirstResult(($page-1) * $nombreParPage)
		// Ainsi que le nombre d'articles à afficher
			  ->setMaxResults($nombreParPage);             
		return new Paginator($query);
	}
}
