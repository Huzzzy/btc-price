<?php

namespace App\Jobs;

use Swap\Builder;
use App\Models\BtcPrice;
use Illuminate\Bus\Queueable;
use App\Events\NewBtcPriceEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class BtcNewPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $btc = BtcPrice::first();

        $url = 'https://api.coinbase.com/v2/exchange-rates?currency=BTC';

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Получение курса биткоина в USD

        $bitcoin_rate = $data['data']['rates']['USD'];


        $oldBtc = $btc->price;
        $newBtc = (int)$bitcoin_rate;


        $btc->update([
            'price' => $newBtc,
            'previous_price' => $oldBtc
        ]);

        event(new NewBtcPriceEvent($btc));
    }
}
