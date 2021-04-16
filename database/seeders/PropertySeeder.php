<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;
use LimitIterator;
use SplFileObject;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file =  new SplFileObject(storage_path('app/data/property-data.csv'));
        $file->setFlags (
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        $header = $file->current();

        foreach (new LimitIterator($file, 1) as $line){
            $property = array_change_key_case(array_combine($header,$line));
            Property::create($property);
        }
    }
}
