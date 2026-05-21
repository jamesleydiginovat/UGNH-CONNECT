<?php

namespace App\Livewire\Pages\Pdf\Iframes;

use Livewire\Attributes\On;
use Livewire\Component;

class PdfPersonnel extends Component
{
    public $fileName=true;

    #[On('Success-pdf')] 
    public function getFileName($fileName){
        $this->fileName=$fileName;
        return $fileName;
    }
    // public function render()
    // {
    //     return view('livewire.pages.pdf.iframes.pdf-personnel');
    // }
}
