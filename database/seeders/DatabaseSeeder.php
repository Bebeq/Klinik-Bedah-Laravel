<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use App\Models\Settings;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // \App\Models\User::factory(10)->create();

        Settings::create([
            'nama' => 'title',
            'keterangan' => 'Klinik Akbar'
        ]);
        Settings::create([
            'nama' => 'logo',
            'keterangan' => 'Klinik Akbar'
        ]);

        Settings::create([
            'nama' => 'no_hp',
            'keterangan' => '085727928601'
        ]);
        Settings::create([
            'nama' => 'email',
            'keterangan' => 'Klinikbedahmelati@gmail.com'
        ]);
        Settings::create([
            'nama' => 'alamat',
            'keterangan' => 'Gg. Buntu, Mlati Lor, Kec. Kota, Kabupaten Kudus'
        ]);

        User::create([
            'name' => 'Akbar Jadi Admin',
            'password' => Hash::make('admin'),
            'nik' => 1234567890123456,
            'role' => 2,
            'no_hp' => '000000000',
            'alamat' => 'Di Kota Terdekat'
        ]);

        User::create([
            'name' => 'Akbar Jadi Pasien',
            'password' => Hash::make('pasien'),
            'nik' => 1234567890654321,
            'no_hp' => '111111111',
            'alamat' => 'Di Kota Paling Jauh'
        ]);

        User::create([
            'name' => 'Akbar Jadi Dokter',
            'password' => Hash::make('dokter'),
            'nik' => 1234267890652321,
            'role' => 3,
            'no_hp' => '222222222',
            'alamat' => 'Di Kota Paling Jauh'
        ]);

        Antrian::create([
            'no' => 1,
            'user_id' => 2,
            'status' => 2,
            'tanggal_antrian' => Carbon::now()
        ]);

        for($i = 1; $i <= 50; $i++){
            User::create([
                'name' => $faker->name,
                'password' => Hash::make('pasien'),
                'nik' => $faker->randomNumber(5, true) . $faker->randomNumber(5, true) . $faker->randomNumber(5, true) . $faker->randomNumber(1, true),
                'no_hp' => $faker->randomNumber(5, true) . $faker->randomNumber(5, true),
                'alamat' => $faker->address
            ]);
        }


        for($i = 1; $i <= 20; $i++){
            Antrian::create([
                'no' => rand(1,50),
                'user_id' => rand(1,50),
                'status' => 3,
                'tanggal_antrian' => Carbon::now()->subDays(rand(0, 7))
            ]);
        }
        for($i = 1; $i <= 20; $i++){
            Antrian::create([
                'no' => rand(1,50),
                'user_id' => rand(1,50),
                'status' => 5,
                'tanggal_antrian' => Carbon::now()->subDays(rand(0, 7))
            ]);
        }
    }
}
