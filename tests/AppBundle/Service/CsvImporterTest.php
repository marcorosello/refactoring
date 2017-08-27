<?php

namespace Test\AppBundle\Service;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\CsvImporter;

/**
 * Class ImportProductsTest
 * @package Test\AppBundle\Command
 */
class CsvImporterTest extends TestCase {

    /** @var CsvImporter */
    private $csvImporter;

    /**
     * setUp
     */
    public function setUp()
    {
        $this->csvImporter = new CsvImporter();
    }

    /**
     * testImport
     */
    public function testImport()
    {
        $products = $this->csvImporter->import('products.csv');

        $this->assertArraySubset(['ean' => 8767377373], $products[0]);
    }
}
