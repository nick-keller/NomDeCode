<?php


namespace NDC\BlogBundle\Controller;

use Doctrine\ORM\EntityManager;
use NDC\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\NamePrefix;


/**
 * @NamePrefix("api_")
 */
class ArticleApiController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Paginator
     */
    private $paginator;

    public function getArticleAction($id)
    {
        $article = $this->em->getRepository('NDCBlogBundle:Article')->findOneById($id);

        return $article;
    }
} 