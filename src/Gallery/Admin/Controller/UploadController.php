<?php declare(strict_types=1);

namespace EryseBlog\Gallery\Admin\Controller;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use EryseBlog\Gallery\Photo\Entity\PhotoEntity;
use EryseBlog\Gallery\Photo\Admin\Form\PhotoEntityType;
use EryseBlog\Gallery\Photo\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/gallery/upload-photo")
 */
class UploadController extends AbstractController
{
    /**
     * @Route("/select", name="admin_gallery_upload_select")
     *
     * @return Response
     */
    public function select(): Response
    {
        $photo = new PhotoEntity();
        $form = $this->createForm(
            PhotoEntityType::class,
            $photo,
            ['action' => $this->generateUrl('admin_gallery_upload_process')]
        );

        return $this->render('Admin/Gallery/Upload/select.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/process", name="admin_gallery_upload_process")
     * @param Request $request
     *
     * @param PhotoRepository $photoRepository
     *
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function process(Request $request, PhotoRepository $photoRepository): Response
    {
        $form = $this->createForm(PhotoEntityType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->getData();
            $photoRepository->save($photo);

            $this->addFlash('success', 'Photo successfully uploaded');
        }

        return $this->redirectToRoute('admin_gallery_upload_select');
    }

}
