<?php

namespace App\Livewire\Pages\Pdf\Iframes;

use Livewire\Attributes\On;
use Livewire\Component;

class PdfReleverDesNotes extends Component
{
    public $fileName;
    // public $message;

    #[On('success-pdf')] 
    public function getFileName($filename,){
        $this->fileName=$filename;
    }
    
    public function render()
    {
        return view('livewire.pages.pdf.iframes.pdf-relever-des-notes');
    }
}
