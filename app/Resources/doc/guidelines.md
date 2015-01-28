# Guidelines

## Routing

Chaque controller a son propre fichier de routing.

app/config/routing.yml
```
ndc_hello_bundle:
    resource: "@NDCHelloBundle/Resources/config/routing.yml"
    prefix:   /
```

src/NDC/HelloBundle/Resources/config/routing.yml
```
ndc_hello_bundle_controller_name:
    resource: routing/controllerName.yml
    prefix: /my/prefix
```

src/NDC/HelloBundle/Resources/config/routing/controllerName.yml
```
hello_controller_name_action:
    pattern: /my/route
    defaults: { _controller: HelloBundle:ControllerName:action }
```