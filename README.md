# LOX24 API client Symfony bundle

## Installation

### Flex

```shell
composer require symfony/flex
composer require lox24eu/lox24_api_client_bundle
```
Apply recipe and fill your API token to .env variable `LOX24_API_TOKEN``

### Manual

```shell
composer require lox24eu/lox24_api_client_bundle
```

Add to your `config/bundles.php`:

```php
<?php

return [
    // some bundles here
    lox24\bundle\api_client\LOX24Bundle::class => ['all' => true],
];
```

Create `config/packages/lox24_api.yaml`:

```yaml
lox24:
    api:
        token: '%env(LOX24_API_TOKEN)%'
        http_client: '@psr18.http_client'
        request_factory: '@nyholm.psr7.psr17_factory'
```

Apply recipe and fill your API token to .env variable `LOX24_API_TOKEN``
