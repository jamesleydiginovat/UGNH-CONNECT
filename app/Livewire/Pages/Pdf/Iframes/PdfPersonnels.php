<?php

namespace App\Livewire\Pages\Pdf\Iframes;

use Livewire\Component;
use Livewire\Attributes\On;

class PdfPersonnels extends Component
{
    public $fileName;

    #[On('success-pdf')] 
    public function getFileName($fileName){
        $this->fileName=$fileName;
        return $fileName;
    }

    public function render()
    {
        return view('livewire.pages.pdf.iframes.pdf-personnels');
    }
}
