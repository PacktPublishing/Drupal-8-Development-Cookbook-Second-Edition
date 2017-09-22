<?php

namespace Drupal\geoip\Plugin\GeoLocator;

use Drupal\Core\Plugin\PluginBase;

/**
 * CDN geolocation provider.
 *
 * @GeoLocator(
 *   id = "cdn",
 *   label = "CDN",
 *   description = "Checks for geolocation headers sent by CDN services",
 *   weight = -10
 * )
 */
class Cdn extends PluginBase implements GeoLocatorInterface {

  /**
   * {@inheritdoc}
   */
  public function label() {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function description() {
    return $this->pluginDefinition['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function geolocate($ip_address) {

    if (!empty($_SERVER['HTTP_CF_IPCOUNTRY'])) {
      $country_code = $_SERVER['HTTP_CF_IPCOUNTRY'];
    }
    elseif (!empty($_SERVER['HTTP_CLOUDFRONT_VIEWER_COUNTRY'])) {
      $country_code = $_SERVER['HTTP_CLOUDFRONT_VIEWER_COUNTRY'];
    }
    else {
      $country_code = NULL;
    }

    return $country_code;
  }
  
}