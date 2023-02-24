<?php

namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;

class StatsService {
	
	private $manager;

	//Injection de dependance
	public function __construct(EntityManagerInterface $manager){
		$this->manager = $manager;
	}

	//Affiche les Taches dont le state est "En Cours"
	public function getEncours(){
		return $this->manager->createQuery('select * from App\Entity\Tache inner join App\Entity\Statut where statut.description="En Cours"')->getSingleScalarResult();


	}
}