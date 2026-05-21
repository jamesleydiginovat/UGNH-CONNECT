<?php

namespace App\Livewire\Pages;

use App\Models\coursModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CourseByFacultyChart extends Component
{
    protected $listeners = [
            'refreshTable'=>'$refresh',
    ];
    public $data = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = coursModel::select('codeFac', DB::raw('COUNT(*) as total'))
                        ->groupBy('codeFac')
                        ->pluck('total', 'codeFac');
    }

    public function render()
    {
        return view('livewire.pages.course-by-faculty-chart');
    }
}
