<?php

namespace lox24\bundle\api_client;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class LOX24Bundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
                   ->children()
                   ->arrayNode('api')
                   ->children()
                   ->scalarNode('token')->end()
                   ->scalarNode('http_client')->defaultValue('@default_http_client')->end()
                   ->scalarNode('request_factory')->defaultValue('@nyholm.psr7.psr17_factory')->end()
                   ->end()
                   ->end()
                   ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(__DIR__.'/Resources/config/lox24.yaml');
        $container->parameters()->set('lox24.api.token', $config['api']['token']);
        $container->parameters()->set('lox24.api.http_client', $config['api']['http_client']);
        $container->parameters()->set('lox24.api.request_factory', $config['api']['request_factory']);
    }
}
