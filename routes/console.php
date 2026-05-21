<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use App\Models\paiementModel;
use App\Events\DailyPaymentSummary;
use App\Models\transactionPaiementModel;

/*
|--------------------------------------------------------------------------
| Console Commands
|--------------------------------------------------------------------------
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| SCHEDULER (Laravel 12)
|--------------------------------------------------------------------------
*/

Schedule::call(function () {

    $count = transactionPaiementModel::whereDate('created_at', today())->count();

    event(new DailyPaymentSummary(
        $count,
        now()->toDateString()
    ));

})->everyThirtyMinutes();