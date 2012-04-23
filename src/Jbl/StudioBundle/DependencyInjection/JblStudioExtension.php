<?php

namespace Jbl\StudioBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class JblStudioExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        if (!isset($config['website_name'])) {
        	throw new \InvalidArgumentException('The "website_name" option must be set');
        }
        
        if (!isset($config['website_email'])) {
        	throw new \InvalidArgumentException('The "website_email" option must be set');
        }
        $container->setParameter('jbl_studio.website_name', $config['website_name']);
        $container->setParameter('jbl_studio.website_email', $config['website_email']);
    }
}
