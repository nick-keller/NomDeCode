<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Article;
use NDC\BlogBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ArticleAdminController extends Controller
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
    public function indexAction()
    {
        return array(
        );
    }

    /**
     * @Template
     */
    public function addAction()
    {
        $article = new Article;
        $article->setAuthor($this->getUser());

        return $this->handleForm($article);
    }

    private function handleForm(Article $article, Request $request = null)
    {
        $form = $this->createForm(new ArticleType, $article);

        return array(
            'form' => $form->createView(),
        );
    }
} 