<?php

namespace NDC\AnalyticsBundle\Controller;

use NDC\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class StatsController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @Template
     */
    public function articleAction(Article $article)
    {
        $now = new \DateTime;
        $now->setTime(0,0);

        $from = new \DateTime;
        $from->setTime(0,0);
        $from->modify('-20 days');

        return array(
            'stats' => $this->em->getRepository('NDCAnalyticsBundle:View')->articlesPerSessionStats($from, $now),
        );
    }
}
