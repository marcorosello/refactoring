<?php

/**
 * This file is part of Boozt Platform
 * and belongs to Boozt Fashion AB.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportProductsCommand extends ContainerAwareCommand
{ 
    public function configure()
    {
        $this->setName('products:import')
            ->setDescription('Import products from file')
            ->addArgument('path', InputArgument::REQUIRED, 'File path')
            ->setHelp('Ahhh......');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Fasten the seat belts, here we go!');
        $this->dbal = $this->getContainer()->get('doctrine.dbal.default_connection');

        $stmt = $this->dbal->prepare('INSERT INTO ean (`name`, `ean`, `material`, `price`, `vat`)
                                VALUES (:name, :ean, :material, :price, :vat)');
        $stmt1 = $this->dbal->prepare('DELETE FROM `ean` WHERE ean = :ean');
        $row = 1;
        $added = 0;
        if (($handle = fopen($input->getArgument('path'), "r")) !== FALSE) {

            $fields = fgetcsv($handle, 1000, ",");

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $output->writeln("$num fields in line $row");
                $row++;
                for ($c=0; $c < $num; $c++) {
                    if ($fields[$c] == 'material') {
                        $data[$c] =  preg_replace('/[^a-z0-9]/i', '_', $data[$c]);
                    }
                    if ($fields[$c] == 'ean') {
                        $this->lastEan = $data[$c];
                    }
                    $stmt->bindValue(':' . $fields[$c], $data[$c], \PDO::PARAM_STR);
                    $output->writeln($fields[$c] . ': ' . $data[$c]);
                }
                try {
                    $stmt->execute();
                    $added++;
                    $output->writeln('Added ' . $added);
                } catch (\Exception $ex) {
                    //do nothing
                    $output->writeln('skipping');
                    $this->dbal->query('DELETE FROM `ean` WHERE ean = ' . $this->lastEan);
                }
            }
            fclose($handle);
        }
        $output->writeln('we are done!!!');

    }

}