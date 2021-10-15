<?php

namespace ContainerUN0LeKB;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMaker_DoctrineHelperService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'maker.doctrine_helper' shared service.
     *
     * @return \Symfony\Bundle\MakerBundle\Doctrine\DoctrineHelper
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/maker-bundle/src/Doctrine/DoctrineHelper.php';

        return $container->privates['maker.doctrine_helper'] = new \Symfony\Bundle\MakerBundle\Doctrine\DoctrineHelper('App\\Entity', ($container->privates['maker.php_compat_util'] ?? $container->load('getMaker_PhpCompatUtilService')), ($container->services['doctrine'] ?? $container->load('getDoctrineService')), true, ['default' => [0 => [0 => 'App\\Entity', 1 => ($container->privates['doctrine.orm.default_annotation_metadata_driver'] ?? $container->load('getDoctrine_Orm_DefaultAnnotationMetadataDriverService'))]]]);
    }
}
