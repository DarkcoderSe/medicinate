<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Preference;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preferences = [
            [ 'name' => 'email_verification', 'value' => '0'],
            [ 'name' => 'sms_verification', 'value' => '1'],
            [ 'name' => 'ref_coins', 'value' => '10'],
            [ 'name' => 'deafult_student_coins', 'value' => '0'],
        ];

        foreach($preferences as $preference)
            Preference::create($preference);

    }
}
