```blade
@extends('layouts.basePdf')

@section('titre')
    {{ $titre }}
@endsection

@section('contenu')

<style>

    body{
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
        color: #222;
    }

    .table-horaire{
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .table-horaire th{
        background: #1833a0;
        color: white;
        border: 1px solid #cfcfcf;
        padding: 6px;
        text-align: center;
        font-size: 11px;
    }

    .table-horaire td{
        border: 1px solid #dcdcdc;
        vertical-align: top;
        padding: 4px;
        height: 120px;
        word-wrap: break-word;
    }

    .cours-box{
        border-bottom: 1px solid #d6d6d6;
        padding-bottom: 4px;
        margin-bottom: 4px;
    }

    .cours-nom{
        font-weight: bold;
        font-size: 10px;
        line-height: 14px;
    }

    .cours-heure{
        font-size: 9px;
        color: #444;
        margin-top: 2px;
    }

    .cours-prof{
        font-size: 9px;
        color: #1833a0;
        margin-top: 2px;
    }

    .titre-section{
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: bold;
    }

    .info-classe{
        background: #f3f5ff;
        border: 1px solid #d8defa;
        padding: 6px;
        margin-top: 15px;
        margin-bottom: 5px;
        font-weight: bold;
        font-size: 11px;
    }

    tr{
        page-break-inside: avoid;
    }

</style>

<section style="margin-top:20px;">

@foreach($Horaires as $faculteCode => $faculte)

    @foreach($faculte as $niveau => $niveaux)

        @foreach($niveaux as $session => $sessions)

            @php
                $coursSample = collect($sessions)->flatten()->first();
            @endphp

            <div class="info-classe">
                Faculté :
                {{ $coursSample->faculte->nom ?? '---' }}

                |
                Niveau :
                {{ $niveau }}

                |
                Session :
                {{ $session }}
            </div>

            <table class="table-horaire">

                <thead>
                    <tr>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                        <th>Dimanche</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>

                        @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'] as $jour)

                            <td>

                                @if(isset($sessions[$jour]))

                                    @foreach(collect($sessions[$jour])->sortBy('heure_debut') as $cours)

                                        @php
                                            $prof = \App\Models\professeurModel::where(
                                                'codeProf',
                                                $cours->prof->codeProf
                                            )->first();

                                            $nomProf = $prof
                                                ? $prof->nom.' '.$prof->prenom
                                                : '---';
                                        @endphp

                                        <div class="cours-box">

                                            <div class="cours-nom">
                                                {{ $cours->cours }}
                                            </div>

                                            <div class="cours-heure">
                                                {{ substr($cours->heure_debut,0,5) }}
                                                -
                                                {{ substr($cours->heure_fin,0,5) }}
                                            </div>

                                            <div class="cours-prof">
                                                {{ $nomProf }}
                                            </div>

                                        </div>

                                    @endforeach

                                @endif

                            </td>

                        @endforeach

                    </tr>

                </tbody>

            </table>

        @endforeach

    @endforeach

@endforeach

</section>

@endsection
```
