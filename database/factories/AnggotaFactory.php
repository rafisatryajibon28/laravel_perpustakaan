<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;

    public function definition(): array
    {
        $kelas = ['X IPA 1', 'X IPS 2', 'XI IPA 3', 'XI IPS 1', 'XII IPA 2', 'XII IPS 4'];

        return [
            'nis'           => $this->faker->unique()->numerify('##########'),
            'nama_lengkap'  => $this->faker->name(),
            'kelas'         => $this->faker->randomElement($kelas),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat'        => $this->faker->address(),
            'no_telepon'    => $this->faker->phoneNumber(),
            'email'         => $this->faker->unique()->safeEmail(),
            'tanggal_daftar'=> $this->faker->dateTimeBetween('-1 year', 'now'),
            'status_aktif'  => $this->faker->boolean(85), // 85% aktif
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}