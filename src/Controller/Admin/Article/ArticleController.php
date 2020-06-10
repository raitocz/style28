<?php

namespace EryseBlog\Controller\Admin\Article;

use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use EryseBlog\Entity\Article\ArticleEntity;
use EryseBlog\Exception\SlugException;
use EryseBlog\Form\Article\ArticleEntityType;
use EryseBlog\Repository\Article\ArticleRepository;
use EryseBlog\Service\SlugService;
use Exception;
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
     * @param Request       $request
     * @param ArticleEntity $articleEntity
     *
     * @return Response
     *
     * @throws Exception
     */
    public function edit(Request $request, ArticleEntity $articleEntity): Response
    {
        $form = $this->createForm(ArticleEntityType::class, $articleEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleEntity->setDateEdited(new DateTime());
            $this->articleRepository->save($articleEntity);

            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('Admin/Article/edit.html.twig', [
            'article' => $articleEntity,
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
