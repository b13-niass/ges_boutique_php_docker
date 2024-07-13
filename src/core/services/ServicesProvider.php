<?php

namespace Boutique\Core\Service;

use Boutique\App\App;
use Boutique\Core\Container;
use Boutique\Core\Impl\IAuthorize;
use Boutique\Core\Impl\IFile;
use Boutique\Core\Impl\IServicesProvider;
use Boutique\Core\Impl\ISession;
use Boutique\Core\Impl\IValidator;

class ServicesProvider implements IServicesProvider{

    public function register(Container $container)
    {
        $container->set(IValidator::class, function (){
            return App::getValidator();
        });

        $container->set(ISession::class, function (){
            return App::getSession();
        });

        $container->set(IFile::class, function (){
            return App::getFileUploadSystem();
        });

        $container->set(IAuthorize::class, function (){
            return App::getAuthorize();
        });
    }
}