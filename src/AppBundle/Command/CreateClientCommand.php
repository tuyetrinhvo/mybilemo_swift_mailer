<?php
/**
 * Class Doc Command
 *
 * PHP version 7.0
 *
 * @category PHP_Class
 * @package  AppBundle
 * @author   trinhvo <ttvdep@gmail.com>
 * @license  tuyetrinhvo@2018
 * @link     Link Name
 */
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateClientCommand
 *
 * @category PHP_Class
 * @package  AppBundle\Command
 * @author   trinhvo <ttvdep@gmail.com>
 * @license  tuyetrinhvo@2018
 * @link     Link Name
 */
class CreateClientCommand extends ContainerAwareCommand
{
    /**
     * Function configure
     */
    protected function configure()
    {
        $this
            ->setName('create:new:client')
            ->setDescription('Create a new client')
        ;
    }

    /**
     * Function execute
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris([$this->getContainer()->get('kernel')->getRootDir()]);
        $client->setAllowedGrantTypes(['password', 'refresh_token']);
        $clientManager->updateClient($client);

        $output->writeln('Your client_id : ' . $client->getPublicId());
        $output->writeln('Your client_secret : ' . $client->getSecret());
    }
}