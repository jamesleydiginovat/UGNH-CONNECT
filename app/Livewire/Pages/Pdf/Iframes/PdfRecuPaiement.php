<?php

namespace App\Livewire\Pages\Pdf\Iframes;

use Livewire\Attributes\On;
use Livewire\Component;

class PdfRecuPaiement extends Component
{
    public $fileName;
    // public $message;

    #[On('success-pdffiche')] 
    public function getFileName($filename,){
        $this->fileName=$filename;
        // $this->message=$message;
        // return $filename;
    }

    public function render()
    {
        return view('livewire.pages.pdf.iframes.pdf-recu-paiement');
    }
}
