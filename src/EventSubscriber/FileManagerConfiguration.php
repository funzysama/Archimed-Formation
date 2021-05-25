<?php


namespace App\EventSubscriber;


use Artgris\Bundle\FileManagerBundle\Event\FileManagerEvents;
use SplFileInfo;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * block and hide all files/folders with regex: "/privates|.privates/"
 *
 * Class FileManagerConfiguration
 * @package App\EventSubscriber
 */
class FileManagerConfiguration implements EventSubscriberInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            FileManagerEvents::POST_DIRECTORY_FILTER_CONFIGURATION => 'postConfiguration',   // Add Directory Filter
            FileManagerEvents::POST_FILE_FILTER_CONFIGURATION => 'postConfiguration', // Add File Filter
            FileManagerEvents::POST_CHECK_SECURITY => 'postSecurity', // add Directory access security
            FileManagerEvents::FILE_ACCESS => 'postSecurity', // add File access security
        ];
    }

    /**
     * Add Directory & File Filter
     * @param GenericEvent $event
     */
    public function postConfiguration(GenericEvent $event)
    {
        /** @var Finder $finder */
        $finder = $event->getArgument('finder');
        $token = $this->tokenStorage->getToken();
        $user = $token->getUser();
        if(!in_array("ROLE_ADMIN", $user->getRoles())){
            $finder->notName($this->patterns());
        }
    }

    /**
     * Add filemanager post security (directory access) & file access security
     * @param GenericEvent $event
     */
    public function postSecurity(GenericEvent $event)
    {
        $dir = $event->getArgument('path');
        $info = new SplFileInfo($dir);
        $token = $this->tokenStorage->getToken();
        $user = $token->getUser();
        if (preg_match($this->patterns(), $info) && !in_array("ROLE_ADMIN", $user->getRoles())) {
            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'You are not allowed to access this folder or file.');
        }
    }

    private function patterns(): string
    {
        return "/private|.private/";
    }
}