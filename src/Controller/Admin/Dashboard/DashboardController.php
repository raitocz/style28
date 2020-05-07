<?php declare(strict_types=1);

namespace EryseBlog\Controller\Admin\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="admin_dashboard")
     */
    public function index(): Response
    {
        return $this->render('Admin/Dashboard/index.html.twig');
    }
}
