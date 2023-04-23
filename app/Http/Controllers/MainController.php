<?php

namespace App\Http\Controllers;

use App\Events\NewBtcPriceEvent;
use App\Models\BtcPrice;
use Swap\Builder;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;

class MainController extends Controller
{
    public function index()
    {
        $btc = BtcPrice::first();

        return Inertia::render('Main/Index', [
            'btc' => $btc
        ]);
    }
}
