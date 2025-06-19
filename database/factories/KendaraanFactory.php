<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    protected $model = Kendaraan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisKendaraan = collect(['Large Dozer', 'Dump Truck', 'Scraper', 'Excavator', 'Bulldozer']);

        return [
            'jenis' => $jenisKendaraan->shuffle()->first(),
            'tahun_pembuatan' => $this->faker->year,
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
