<?php

namespace EryseBlog\Article\Admin\Controller;

use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use EryseBlog\Article\Entity\ArticleEntity;
use EryseBlog\Common\Entity\FlashType;
use EryseBlog\Common\Slug\Exception\SlugException;
use EryseBlog\Article\Admin\Form\ArticleEntityType;
use EryseBlog\Article\Repository\ArticleRepository;
use EryseBlog\Gallery\Photo\Repository\PhotoRepository;
use EryseBlog\Common\Slug\Service\SlugService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/article")
 * @IsGranted("ROLE_ADMIN")
 */
class ArticleController extends AbstractController
{
    /**
     * @var ArticleRepository
     */
    private ArticleRepository $articleRepository;

    /**
     * ArticleController constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/list", name="admin_article_list", methods={"GET"})
     */
    public function list(): Response
    {
        $articleEntities = $this->articleRepository->findAllforAdmin();

        return $this->render('Admin/Article/index.html.twig', [
            'articles' => $articleEntities,
        ]);
    }

    /**
     * @Route("/new", name="admin_article_new", methods={"GET","POST"})
     *
     * @param Request $request
     *
     * @param SlugService $slugService
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws SlugException
     */
    public function new(Request $request, SlugService $slugService): Response
    {
        $articleEntity = new ArticleEntity();
        $form = $this->createForm(ArticleEntityType::class, $articleEntity);
        $form->get('dateCreated')->setData(new DateTime());
        $form->get('datePublished')->setData(new DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleEntity->setSlug($slugService->slugify($articleEntity->getTitle()));
            $this->articleRepository->save($articleEntity);

            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('Admin/Article/new.html.twig', [
            'article' => $articleEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/preview", name="admin_article_preview", methods={"GET"})
     *
     * @param ArticleEntity $articleEntity
     *
     * @return Response
     */
    public function preview(ArticleEntity $articleEntity): Response
    {
        return $this->render('Admin/Article/preview.html.twig', [
            'article' => $articleEntity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_article_edit", methods={"GET","POST"})
     *
     * @param Request $request
     * @param ArticleEntity $articleEntity
     *
     * @param PhotoRepository $photoRepository
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function edit(Request $request, ArticleEntity $articleEntity, PhotoRepository $photoRepository): Response
    {
        $form = $this->createForm(ArticleEntityType::class, $articleEntity);
        $form->handleRequest($request);

        $photos = $photoRepository->findAllForArticle($articleEntity);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleEntity->setDateEdited(new DateTime());
            $this->articleRepository->save($articleEntity);

            $this->addFlash(FlashType::SUCCESS, 'Saved successfully');
        }

        return $this->render('Admin/Article/edit.html.twig', [
            'article' => $articleEntity,
            'photos' => $photos,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin_article_delete", methods={"DELETE"})
     *
     * @param Request       $request
     * @param ArticleEntity $articleEntity
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Request $request, ArticleEntity $articleEntity): Response
    {
        if ($this->isCsrfTokenValid('delete' . $articleEntity->getId(), $request->request->get('_token'))) {
            $this->articleRepository->remove($articleEntity);
        }

        return $this->redirectToRoute('admin_article_list');
    }
}
