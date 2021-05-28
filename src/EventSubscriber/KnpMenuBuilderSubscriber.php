<?php
namespace App\EventSubscriber;

use App\Repository\TestRepository;
use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class KnpMenuBuilderSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
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
            $tests = $user->getTests()->getValues();
            $menu->addChild('acceuil', [
                'route' => 'main_home',
                'label' => 'Acceuil',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'fas fa-id-badge');
            $menu->addChild('monProfile', [
                'route' => 'monProfile',
                'routeParameters' => ['id' => $user->getId()],
                'label' => 'Mon Profile',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'fas fa-id-badge');
            $menu->addChild('deco', [
                'route' => 'app_logout',
                'label' => 'Déconnection',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'fas fa-sign-out-alt');
        }
        if(in_array("ROLE_ADMIN", $token->getRoleNames()) || in_array("ROLE_CONSULTANT", $token->getRoleNames())){
            $menu->addChild('AdminHeader', [
                'label' => 'ADMINISTRATION',
                'childOptions' => $event->getChildOptions()
            ])->setAttribute('class', 'header');
            $menu->addChild('listUser', [
                'route' => 'admin_users',
                'label' => 'Gestion Utilisateurs',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'fas fa-users');
            $menu->addChild('listRessource', [
                'route' => 'admin_ressources',
                'label' => 'Gestion Resources',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'fas fa-users');
            $menu->addChild('listTests', [
                'route' => 'admin_tests',
                'label' => 'Gestion des Tests',
                'childOptions' => $event->getChildOptions(),
            ])->setLabelAttribute('icon', 'fas fa-copy');
            $tests = $user->getTests()->getValues();
            if($tests){
                foreach ($tests as $test){
                    $menu->addChild('admintest'.$test->getNom(), [
                        'label' => 'Aperçu du test '.$test->getNom(),
                        'childOptions' => $event->getChildOptions(),
                    ])->setLabelAttribute('icon', 'fas fa-copy');
                }
            }else{
                $menu->addChild('ajoutTest', [
                    'label' => 'Ajout d\'accès',
                    'childOptions' => $event->getChildOptions(),
                ])->setLabelAttribute('icon', 'fas fa-plus');
            }

        }
    }
}