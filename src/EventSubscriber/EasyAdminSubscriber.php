<?php

namespace App\EventSubscriber;

use App\Entity\Artwork;
use App\Entity\Category;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;
//appel de la slugger interface afin de génerer un slug à partir d'une chaîne de caractères (l'autowiring). (on recupère aussi l'utilisateur via security(core security))
    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }
//Fonction permettant de s'abonner aux events avant qu'une entité soient persistée. 
    public static function getSubscribedEvents()
    {
        return[
            BeforeEntityPersistedEvent::class => [['setArtworkSlugAndDateAndUser'], ['setCategorySlug' ]],            
        ];
    }
//Recuperation de l'instance Artwork
    public function setArtworkSlugAndDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if(!($entity instanceof Artwork)) {
            return;
        }
//Si c'est bien un Artwork on génère le slug à partir du titre et la date
        $slug = strtolower($this->slugger->slug($entity->getTitre()));
        $entity->setSlug($slug);
//idem pour la date
        $now = new DateTime('now');
        $entity->setDateCreate($now);
//Ainsi que pour l'utilisateur
        $user = $this->security->getUser();
        $entity->setUser($user);
        
        $entity->setBeliked(0);
    }
    public function setCategorySlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if(!($entity instanceof Category)) {
            return;
        }
        $slug = strtolower($this->slugger->slug($entity->getTitre()));
        $entity->setSlug($slug);
    }
}