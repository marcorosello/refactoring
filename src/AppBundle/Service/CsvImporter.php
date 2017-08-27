<?php

namespace AppBundle\Service;

/**
 * Class CsvImporter
 * @package AppBundle\Service
 */
class CsvImporter
{
    /**
     * @param $filePath
     *
     * @return array
     */
    public function import($filePath)
    {
        $products = [];
        $product = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {

            $fields = fgetcsv($handle, 1000, ",");

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                for ($c=0; $c < $num; $c++) {
                    if ($fields[$c] == 'material') {
                        $data[$c] =  preg_replace('/[^a-z0-9]/i', '_', $data[$c]);
                    }
                    $product[$fields[$c]] = $data[$c];
                }
                $products[] = $product;
            }
            fclose($handle);
        }

        return $products;   
    }

}