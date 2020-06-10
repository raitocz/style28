<?php declare(strict_types=1);

namespace EryseBlog\Controller\Admin\Gallery;

use EryseBlog\Repository\Gallery\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/gallery/list")
 */
class ListController extends AbstractController
{
    /**
     * @Route("/index", name="admin_gallery_list_index")
     * @param PhotoRepository $photoRepository
     *
     * @return Response
     */
    public function index(PhotoRepository $photoRepository): Response
    {
        $photos = $photoRepository->findAll();

        return $this->render('Admin/Gallery/List/index.html.twig', ['photos' => $photos]);
    }

}
