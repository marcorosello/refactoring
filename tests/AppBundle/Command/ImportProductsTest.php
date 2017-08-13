<?php

/**
 * This file is part of Boozt Platform
 * and belongs to Boozt Fashion AB.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Test\AppBundle\Command;

use AppBundle\Command\ImportProductsCommand;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class ImportProductsTest
 * @package Test\AppBundle\Command
 */
class ImportProductsTest extends WebTestCase
{
    /** @var Connection */
    private $conn;
    /** @var CommandTester */
    private $commandTester;

    /**
     *
     */
    protected function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $client = static::createClient();
        $application = new Application(self::$kernel);
        $application->add(new ImportProductsCommand());
        $command = $application->find('products:import');
        $this->commandTester = new CommandTester($command);
        $this->conn = $client->getContainer()->get('doctrine.dbal.default_connection');
    }

    /**
     *
     */
    public function testImport()
    {
        $this->commandTester->execute(array(
            'command'  => 'products:import',
            'path' => 'products.csv',

        ));

        $output = $this->commandTester->getDisplay();
    }
}