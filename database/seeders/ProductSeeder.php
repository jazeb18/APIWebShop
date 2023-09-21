<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        products::truncate();
        $csvData = fopen(base_path('database\csv\products.csv'),'r');

        $orderRaw = true;
        while(($data = fgetcsv($csvData, '555',',')) !== false){
            if(!$orderRaw){
                Products :: create([
                    'ProductName' => $data[1],
                    'ProductPrice' => $data[2]
                    ]);
            }
            $orderRaw = false;

        }
        fclose($csvData);
    }
}
