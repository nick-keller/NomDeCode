# Guidelines

## Routing

Chaque controller a son propre fichier de routing.

app/config/routing.yml
```YAML
ndc_hello_bundle:
    resource: "@NDCHelloBundle/Resources/config/routing.yml"
    prefix:   /
```

src/NDC/HelloBundle/Resources/config/routing.yml
```YAML
ndc_hello_bundle_controller_name:
    resource: routing/controllerName.yml
    prefix: /my/prefix
```

src/NDC/HelloBundle/Resources/config/routing/controllerName.yml
```YAML
hello_controller_name_action:
    pattern: /my/route
    defaults: { _controller: HelloBundle:ControllerName:action }
```

## Controller

### Injection de services

Pour les services les plus utilisés, s'appuyer sur l'injection de services dans les attributs.

```PHP
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;

class MyController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Paginator
     */
    private $paginator;
}
```

Ne pas oublier d'enregistrer le bundle dans app/config/config.yml
```YAML
jms_di_extra:
    locations:
        bundles: [NDCMyBundle]
```

### Annotation @Template

Utiliser l'annotation @Template pour render une view.

```PHP
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MyController extends Controller
{
    /**
     * @Template
     */
    public function indexAction()
    {
        return array(
        );
    }
}
```