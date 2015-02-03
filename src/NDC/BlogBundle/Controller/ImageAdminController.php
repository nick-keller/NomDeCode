<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Image;
use NDC\BlogBundle\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Symfony\Component\HttpFoundation\Request;

class ImageAdminController extends Controller
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
     * @var UploadableManager
     */
    private $uploadableManager;

    /**
     * @Template
     */
    public function indexAction(Request $request)
    {
        $images = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Image')->queryAll(),
            $request->query->get('page', 1),
            24
        );

        $image = new Image;
        $form = $this->createForm(new ImageType, $image);

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $this->em->persist($image);
                $this->uploadableManager->markEntityToUpload($image, $image->getFile());
                $this->em->flush();

                $this->addFlash('success', 'Image ajoutée.');

                return $this->redirect($this->generateUrl('blog_image_admin_index'));
            }
        }

        return array(
            'images' => $images,
            'form' => $form->createView(),
        );
    }

    /**
     * @Template
     */
    public function browseAction(Request $request)
    {
        $images = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Image')->queryAll(),
            $request->query->get('page', 1),
            30
        );

        return array(
            'images' => $images,
            'funcNum' => $request->query->get('CKEditorFuncNum'),
        );
    }
} 