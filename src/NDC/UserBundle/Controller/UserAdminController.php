<?php


namespace NDC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UserAdminController extends Controller
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
    public function indexAction(Request $request)
    {
        $users = $this->paginator->paginate(
            $this->em->getRepository('NDCUserBundle:User')->queryAll(),
            $request->query->get('page', 1),
            25
        );

        return array(
            'users' => $users,
        );
    }
} 