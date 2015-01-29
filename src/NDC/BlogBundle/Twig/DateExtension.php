<?php


namespace NDC\BlogBundle\Twig;

use Symfony\Component\Translation\Translator;

class DateExtension extends \Twig_Extension
{
    /** @var Translator */
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('fullDate', array($this, 'fullDateFilter')),
        );
    }

    public function fullDateFilter(\DateTime $date, $showDay = true)
    {
        $elements = array();;

        if($showDay)
            $elements[] = $this->trans('day.'.$date->format('N'));

        $elements[] = $date->format('j');
        $elements[] = $this->trans('month.'.$date->format('n'));

        if($date->format('o') != (new \DateTime())->format('o'))
            $elements[] = $date->format('o');

        return implode(' ', $elements);
    }

    protected function trans($key, array $params = array())
    {
        return $this->translator->trans($key, $params, 'dates');
    }

    public function getName()
    {
        return 'date_extension';
    }
} 