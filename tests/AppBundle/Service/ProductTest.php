<?php

namespace Test\AppBundle\Service;


use AppBundle\Service\CsvImporter;
use AppBundle\Service\Product;
use AppBundle\Model\Product as ProductModel;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductTest
 * @package Test\AppBundle\Service
 */
class ProductTest extends TestCase
{
    /** @var  \PHPUnit_Framework_MockObject_Stub */
    private $csvImporter;

    /** @var  \PHPUnit_Framework_MockObject_Stub */
    private $model;

    /** @var  Product */
    private $product;


    /**
     * setUp
     */
    public function setUp()
    {
        $this->csvImporter = new CsvImporter();
        $this->model = $this->createMock(ProductModel::class);
        $this->product = new Product($this->model, $this->csvImporter);
    }

    /**
     * testProductImport
     */
    public function testProductImport()
    {
        $this->model->expects($this->once())->method('create');
        $this->product->import('products.csv');
    }

}