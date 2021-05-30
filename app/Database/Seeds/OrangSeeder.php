<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class OrangSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama'          => 'Majid Hakim',
        //         'alamat'        => 'Kregenan - Kraksaan',
        //         'created_at'    => Time::now(),
        //         'updated_at'    => Time::now()
        //     ],
        //     [
        //         'nama'          => 'Muhammad Yasin',
        //         'alamat'        => 'Koloran - Kotaanyar',
        //         'created_at'    => Time::now(),
        //         'updated_at'    => Time::now()
        //     ]
        // ];

        // simple queries
        // $this->db->query(
        //     "INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
        //     $data
        // );

        // using Query Builder Single Array
        // $this->db->table('orang')->insert($data);

        // using Query Builder Multiple Array
        // $this->db->table('orang')->insertBatch($data);

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            # code...
            $data = [
                'nama'          => $faker->name,
                'alamat'        => $faker->address,
                'created_at'    => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'    => Time::now()
            ];
            $this->db->table('orang')->insert($data);
        }
    }
}
