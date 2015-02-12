<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @Template
     */
    public function indexAction(Request $request, $page)
    {
        $articles = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Article')->queryAllPublished(),
            $page,
            10
        );

        return array(
            'articles' => $articles,
        );
    }

    /**
     * @Template
     */
    public function articleAction(Article $article, $slug)
    {
        if($article->getState() != 'published') {
            if($this->getUser() == $article->getAuthor() or $this->isGranted('ROLE_ADMIN')) {
                $this->addFlash('warning', "L'article demandé n'est pas publié et n'est donc pas accessible publiquement");
                return $this->redirect($this->generateUrl('blog_article_admin_edit', array("id" => $article->getId())));
            } else
                throw $this->createNotFoundException();
        }

        if($article->getSlug() != $slug)
            return $this->redirect($this->generateUrl('blog_article', array('id'=>$article->getId(), 'slug'=>$article->getSlug())), 301);

        return array();
    }
} 