<?php declare(strict_types=1);

namespace EryseBlog\Home\Frontend\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="frontend_home_about")
     *
     * @return Response
     * @throws \Exception
     */
    public function about(): Response
    {
        return $this->render('Frontend/Home/about.html.twig');
    }
}
