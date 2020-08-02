<?php

namespace App\Action;

use LogicException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/logout", name="app_logout")
 *
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class LogoutAction
{
    public function __invoke()
    {
        throw new LogicException(
            'This method can be blank - it will be intercepted by the logout key on your firewall.'
        );
    }
}
