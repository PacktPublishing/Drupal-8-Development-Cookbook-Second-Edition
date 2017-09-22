<?php

namespace Drupal\ip_restrict\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds the IP Restrict middleware if enabled.
 */
class IpRestrictPass implements CompilerPassInterface {

  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container) {
    if (FALSE === $container->hasDefinition('ip_restrict.middleware')) {
      return;
    }

    $ip_restrict_config = $container->getParameter('ip_restrict');

    if (!$ip_restrict_config['enabled']) {
      $container->removeDefinition('ip_restrict.middleware');
    }
  }

}