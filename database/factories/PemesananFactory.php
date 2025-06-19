<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemesanan>
 */
class PemesananFactory extends Factory
{
    protected $model = Pemesanan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_pemesanan' => $this->faker->date('Y-m-d'),
            'kendaraan_id' => Kendaraan::pluck('id')->random(),
            'status' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
