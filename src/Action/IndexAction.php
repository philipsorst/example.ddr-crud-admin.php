<?php

namespace App\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/", name="app.index")
 *
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class IndexAction extends AbstractController
{
    public function __invoke()
    {
        return $this->redirectToRoute('app.blog_post.list');
    }
}
