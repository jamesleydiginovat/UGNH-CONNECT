<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document_tb_esalleModel extends Model
{
    use HasFactory;
    protected $table = 'document_cours_tb_esalle';
    protected $fillable = [
        'titre',
        'codeFac',
        'codeCours',
        'niveau',
        'session',
        'pdf',
        'professeurs',
        'anneAcademique'
    ];


    public function coursRelation()
    {
        return $this->belongsTo(document_tb_esalleModel::class, 'codeCours', 'codeCours');
    }




}
