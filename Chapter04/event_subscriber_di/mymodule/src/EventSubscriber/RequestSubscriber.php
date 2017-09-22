<?php

namespace Drupal\mymodule\EventSubscriber;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestSubscriber implements EventSubscriberInterface {

  /**
   * The route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Account proxy.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $accountProxy;

  /**
   * Creates a new RequestSubscriber object.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match.
   * @param \Drupal\Core\Session\AccountProxyInterface $account_proxy
   *   The current user.
   */
  public function __construct(RouteMatchInterface $route_match, AccountProxyInterface $account_proxy) {
    $this->routeMatch = $route_match;
    $this->accountProxy = $account_proxy;
  }

  /**
   * Redirects all anonymous users to the login page.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   The event.
   */
  public function doAnonymousRedirect(GetResponseEvent $event) {
    // Make sure we are not on the user login route.
    if ($this->routeMatch->getRouteName() == 'user.login') {
      return;
    }

    // Check if the current user is logged in.
    if ($this->accountProxy->isAnonymous()) {
      // If they are not logged in, create a redirect response.
      $url = Url::fromRoute('user.login')->toString();
      $redirect = new RedirectResponse($url);

      // Set the redirect response on the event, cancelling default response.
      $event->setResponse($redirect);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::REQUEST => ['doAnonymousRedirect', 28],
    ];
  }

}
