<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customers;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        customers::truncate();
        $csvData = fopen(base_path('database\csv\customers.csv'),'r');

        $orderRaw = true;
        while(($data = fgetcsv($csvData, '555',',')) !== false){
            if(!$orderRaw){
                Customers :: create([
                    'Jobtitle' => $data[1],
                    'EmailId' => $data[2],
                    'FirstName' => $data[3],
                    'RegisteredSince' => $data[4],
                    'phone' => $data[5]

                ]);
            }
            $orderRaw = false;
        }
        fclose($csvData);
    }
}
