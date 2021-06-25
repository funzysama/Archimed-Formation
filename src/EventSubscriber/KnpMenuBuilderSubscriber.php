<?php
namespace App\EventSubscriber;

use App\Repository\TestRepository;
use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class KnpMenuBuilderSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;
    private $repository;

    public function __construct(TokenStorageInterface $tokenStorage, TestRepository $repository)
    {
        $this->tokenStorage = $tokenStorage;
        $this->repository = $repository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KnpMenuEvent::class => ['onSetupMenu', 100],
        ];
    }

    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();
        $token = $this->tokenStorage->getToken();
        $user = $token->getUser();
        if(in_array("ROLE_USER", $token->getRoleNames())) {
            $menu->addChild('mainMenu', [
                'label' => 'MENU PRINCIPAL',
                'childOptions' => $event->getChildOptions()
            ])->setAttribute('class', 'header');
            $tests = $this->repository->findAll();
            $menu->addChild('acceuil', [
                'route' => 'main_home',
                'label' => 'Accueil',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'lnr lnr-home');
            $menu->addChild('monProfile', [
                'route' => 'monProfile',
                'routeParameters' => ['id' => $user->getId()],
                'label' => 'Mon Profil',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'lnr lnr-user');
            $menu->addChild('deco', [
                'route' => 'app_logout',
                'label' => 'Déconnexion',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'lnr lnr-exit');
        }
        if(in_array("ROLE_ADMIN", $token->getRoleNames()) || in_array("ROLE_CONSULTANT", $token->getRoleNames())) {
            $menu->addChild('AdminHeader', [
                'label' => 'ADMINISTRATION',
                'childOptions' => $event->getChildOptions()
            ])->setAttribute('class', 'header');
            $menu->addChild('listUser', [
                'route' => 'main_users',
                'label' => 'Gestion Utilisateurs',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'lnr lnr-users');
        }
        if(in_array("ROLE_ADMIN", $token->getRoleNames())){
            $menu->addChild('listRessource', [
                'route' => 'ressource_index',
                'label' => 'Gestion Ressources',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'lnr lnr-earth');
            $menu->addChild('listModules', [
                'route' => 'module_index',
                'label' => 'Gestion Modules',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'pe-7s-plugin');
            $menu->addChild('listTests', [
                'label' => 'Gestion des Tests',
                'childOptions' => $event->getChildOptions(),
                'options' => ['branch_class' => 'treeview']
            ])->setLabelAttribute('icon', 'lnr lnr-cog');
            $menu->getChild('listTests')->addChild('gestionI3P', [
                'route' => 'admin_gestion_i3p',
                'label' => 'Gestion I3P',
                'childOptions' => $event->getChildOptions(),
            ])
                ->setLabelAttribute('icon', 'lnr lnr-cog');
            $menu->getChild('listTests')->addChild('gestionRiasec', [
                'route' => 'admin_gestion_riasec',
                'label' => 'Gestion Riasec',
                'childOptions' => $event->getChildOptions(),
            ])
                ->setLabelAttribute('icon', 'lnr lnr-cog');
        }
    }
}