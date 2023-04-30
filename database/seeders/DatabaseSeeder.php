<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BtcPrice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $url = 'https://api.coinbase.com/v2/exchange-rates?currency=BTC';

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Получение курса биткоина в USD

        $bitcoin_rate = $data['data']['rates']['USD'];

        $btc = (int)$bitcoin_rate;

        BtcPrice::factory()->create([
            'price' => $btc,
            'previous_price' => $btc
        ]);

    }
}
