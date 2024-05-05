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
                        ->arrayNode('lox24')
                            ->children()
                                ->scalarNode('token')->end()
                            ->end()
                        ->end()
                   ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {

        $container->import(__DIR__ . '/Resources/config/services.yaml');
        $container->parameters()->set('lox24.api.client_config', $config['lox24']['token']);
    }
}