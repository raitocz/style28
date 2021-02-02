<?php declare(strict_types=1);

namespace EryseBlog\Gallery\Admin\Controller;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use EryseBlog\Common\Entity\FlashType;
use EryseBlog\Gallery\Photo\Entity\PhotoEntity;
use EryseBlog\Gallery\Photo\Repository\PhotoRepository;
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

    /**
     * @Route("/remove/{photo}", name="admin_gallery_list_remove")
     * @param PhotoRepository $photoRepository
     * @param PhotoEntity $photo
     *
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PhotoRepository $photoRepository, PhotoEntity $photo): Response
    {
        $photoRepository->remove($photo);

        $this->addFlash(FlashType::SUCCESS, 'Photo removed successfully');

        return $this->redirectToRoute('admin_article_list');
    }
}
