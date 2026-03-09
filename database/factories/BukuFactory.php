<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    protected $model = Buku::class;

    public function definition(): array
    {
        $kategori = ['Novel', 'Komik', 'Pelajaran', 'Ilmiah', 'Biografi', 'Sejarah', 'Agama'];

        return [
            'judul'         => $this->faker->sentence(4),
            'penulis'       => $this->faker->name(),
            'penerbit'      => $this->faker->company(),
            'tahun_terbit'  => $this->faker->year(),
            'isbn'          => $this->faker->unique()->isbn13(),
            'jumlah_halaman'=> $this->faker->numberBetween(80, 1200),
            'kategori'      => $this->faker->randomElement($kategori),
            'stok'          => $this->faker->numberBetween(0, 15),
            'sinopsis'      => $this->faker->paragraphs(3, true),
            'sampul'        => null,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}