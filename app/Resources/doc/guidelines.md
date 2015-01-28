# Guidelines

## Noms des routes

### app/config/routing.yml

```
ndc_**BUNDLE**_bundle:
    resource: "@NDC**NAME**Bundle/Resources/config/routing.yml"
    prefix:   /
```

### src/**BUNDLE**Bundle/Resources/config/routing.yml

```
ndc_**NAME**_bundle_**CONTROLLER**:
    resource: routing/**CONTROLLER**.yml
    prefix: /my/prefix
```

### src/**BUNDLE**Bundle/Resources/config/routing/**CONTROLLER**.yml

```
**BUNDLE**_**CONTROLLER**_**ACTION**:
    pattern: /my/route
    defaults: { _controller: my:action }
```