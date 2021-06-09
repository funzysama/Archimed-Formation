<?php


namespace App\Service;


use Artgris\Bundle\FileManagerBundle\Service\CustomConfServiceInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FileManagerConfService implements CustomConfServiceInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getConf($extra = [])
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $folder = $user->getModule()->getDossier();
        if(in_array('ROLE_CONSULTANT', $user->getRoles()) || in_array('ROLE_ADMIN', $user->getRoles())){
            $folder = '../public/uploads/';
        }
        return [
            'dir'   => $folder,
            'tree'  => false
     ];
    }
}