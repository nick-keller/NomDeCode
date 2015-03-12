<?php

namespace NDC\BlogBundle\Form;

use NDC\BlogBundle\Entity\Demo;
use NDC\BlogBundle\Repository\ArticleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DemoType extends AbstractType
{
    /** @var  Demo */
    private $demo;

    public function __construct(Demo $demo)
    {
        $this->demo = $demo;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article', null, array(
                'query_builder' => function(ArticleRepository $repo) {
                    return $repo->queryArticleWithoutDemo($this->demo);
                },
            ))
            ->add('name', null, array(
                'label' => 'Nom',
            ))
            ->add('dependencies', null, array(
                'label' => 'Dépendences',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                    'placeholder' => 'Liens des dépendences en .css ou .js, une par ligne',
                ),
            ))
            ->add('html', null, array(
                'label' => 'HTML',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                ),
            ))
            ->add('css', null, array(
                'label' => 'CSS',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                ),
            ))
            ->add('js', null, array(
                'label' => 'JS',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                ),
            ))
            ->add('Enregistrer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NDC\BlogBundle\Entity\Demo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ndc_blogbundle_demo';
    }
}
