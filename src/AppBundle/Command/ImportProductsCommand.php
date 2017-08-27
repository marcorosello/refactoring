<?php

namespace AppBundle\Command;

use AppBundle\Service\CsvImporter;
use AppBundle\Service\Product;
use AppBundle\Model\Product as ProductModel;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportProductsCommand
 * @package AppBundle\Command
 */
class ImportProductsCommand extends ContainerAwareCommand
{
    /**
     * configure
     */
    public function configure()
    {
        $this->setName('products:import')
            ->setDescription('Import products from file')
            ->addArgument('path', InputArgument::REQUIRED, 'File path')
            ->setHelp('Ahhh......');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Fasten the seat belts, here we go!');

        $conn = $this->getContainer()->get('doctrine.dbal.default_connection');
        $model = new ProductModel($conn);
        $service = new Product($model, new CsvImporter());
        $path = $input->getArgument('path');

        $service->import($path);

        $output->writeln('we are done!!!');
    }

}