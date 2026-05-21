<?php

namespace App\Livewire\Pages;

use App\Models\transactionPaiementModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransactionByMounth extends Component
{
    public $months = [];
    public $totals = [];
    
    protected $listeners = [
            'refreshTable'=>'$refresh',
    ];

    public function mount()
    {
        $data = transactionPaiementModel::select(
                DB::raw('EXTRACT(MONTH FROM "dateTransaction") as month'),
                DB::raw('SUM(montant) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $this->months = [];
        $this->totals = [];

        foreach ($data as $item) {
            $this->months[] = date("F", mktime(0, 0, 0, $item->month, 1)); // Jan, Feb...
            $this->totals[] = $item->total;
        }
    }

    public function render()
    {
        return view('livewire.pages.transaction-by-mounth');
    }
}
