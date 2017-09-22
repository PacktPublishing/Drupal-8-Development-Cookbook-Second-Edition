<?php

namespace Drupal\console_commands\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\ContainerAwareCommand;
use Drupal\Console\Core\Style\DrupalStyle;
use Drupal\Console\Annotations\DrupalCommand;

/**
 * Class DisableUsersCommand.
 *
 * @DrupalCommand (
 *     extension="console_commands",
 *     extensionType="module"
 * )
 */
class DisableUsersCommand extends ContainerAwareCommand {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('console_commands:disable_users')
      ->setDescription($this->trans('commands.console_commands.disable_users.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    // Get the default timezone and make a DateTime object for 10 days ago.
    $system_date = \Drupal::config('system.date');
    $default_timezone = $system_date->get('timezone.default') ?: date_default_timezone_get();
    $now = new \DateTime('now', new \DateTimeZone($default_timezone));
    $now->modify('-10 days');

    $query = \Drupal::entityQuery('user')->condition('login', $now->getTimestamp(), '>');
    $results = $query->execute();
  
    if (empty($results)) {
      $output->writeln('<info>No users to disable!</info>');
    }

    foreach ($results as $uid) {
      /** @var \Drupal\user\Entity\User $user */
      $user = \Drupal\user\Entity\User::load($uid);
      $user->block();
      $user->save();
    }
  
    $total = count($results);
    $output->writeln("Disabled $total users");
  }
}
