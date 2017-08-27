<?php


namespace AppBundle\Service;

use AppBundle\Model\Product as Model;

/**
 * Class Product
 * @package AppBundle\Service
 */
class Product
{
    /** @var Model */
    private $model;
    /** @var  CsvImporter */
    private $csvImporter;

    /**
     * Product constructor.
     *
     * @param Model       $model
     * @param CsvImporter $csvImporter
     */
    public function __construct(Model $model, CsvImporter $csvImporter)
    {
        $this->model = $model;
        $this->csvImporter = $csvImporter;
    }


    /**
     * @param $filePath
     */
    public function import($filePath)
    {
        $products = $this->csvImporter->import($filePath);

        //todo: extract method or even class
        foreach ($products as $product) {
            foreach ($product as $field => $value) {
                if ($field == 'material') {
                    $product[$field] =  preg_replace('/[^a-z0-9]/i', '_', $value);
                }
            }
        }
        
        foreach ($products as $product) {
            $this->model->create($product);
        }
    }

}