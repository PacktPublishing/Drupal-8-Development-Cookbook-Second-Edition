<?php

namespace Drupal\geoip\Plugin\GeoLocator;

/**
 * Interface GeoLocatorInterface.
 */
interface GeoLocatorInterface {

  /**
   * Get the plugin's label.
   *
   * @return string
   *   The geolocator label
   */
  public function label();

  /**
   * Get the plugin's description.
   *
   * @return string
   *   The geolocator description
   */
  public function description();

  /**
   * Performs geolocation on an address.
   *
   * @param string $ip_address
   *   The IP address to geolocate.
   *
   * @return string|NULL
   *   The geolocated country code, or NULL if not found.
   */
  public function geolocate($ip_address);

}