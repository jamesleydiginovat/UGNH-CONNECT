
    @extends('layouts.basePdf')

    @section('titre')
        {{-- {{ $titre }} --}}
    @endsection

    @section('contenu')

        {{-- <style>
    .page {
        width: 210mm;
        height: 297mm;
        /* padding: 5mm; */
        font-family: 'Times New Roman', Times, serif;
    }
    .page-break {
        page-break-after: always;
    }

    .header {
        display: flex;
        flex-direction: row;
        align-items: center;
        border-bottom: 1px solid black;
        padding-bottom: 10px;
    }

    /* LOGO */
    .logo {
        width: 80px;
        height: 80px;
    }

    /* TITRE CENTRÉ */
    .title {
        width: 100%;
        text-align: center;
    }

    .title h1 {
        font-size: 20px;
        font-weight: bold;
    }

    .title h2 {
        font-size: 18px;
    }

    .title h3 {
        font-size: 14px;
    }

    .nomFac{
        display: flex;
        flex-direction: row;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        line-height: 0.1;
    }

    .nomFac p{
        line-height: 0.1;
    }

    .infosEtd{
        margin-bottom: 3px;
        line-height: 1;
    }


    table{
        width: 100%;
        border-collapse: 1px;
    }

    .notetb tr{
        border: solid 1px black;
    }



    </style> --}}

    
    <style>
    .page {
        width: 100%;
        min-height: 100vh;
        background: #fff;
        color: #000;
        /* padding: 20px; */
        font-family: 'Times New Roman', Times, serif;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-size: 14px;
        position: relative;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .header-table td {
        vertical-align: middle;
    }

    .logo {
        width: 80px;
        height: 80px;
    }

    .header-center {
        text-align: center;
    }

    .header-center h1,
    .header-center h2,
    .header-center h3,
    .header-center p {
        margin: 2px 0;
    }

    .header-center h1 {
        font-size: 22px;
        font-weight: bold;
    }

    .header-center h2 {
        font-size: 16px;
    }

    .faculte-box {
        text-align: center;
        /* margin-top: 20px; */
        /* margin-bottom: 20px; */
        font-size: 20px;
    }

    .faculte-box p {
        margin: 3px 0;
        font-weight: bold;
    }

    .student-info {
        border: 1px solid #000;
        padding: 10px;
        margin-bottom: 20px;
    }

    .student-info td {
        padding: 5px;
    }

    .student-info span {
        font-weight: bold;
    }

    .note-table {
        width: 100%;
        border: 1px solid #000;
        margin-top: 10px;
    }

    .note-table th,
    .note-table td {
        border: 1px solid #000;
        padding: 6px;
        font-size: 11px;
    }

    .note-table thead th {
        background: #e5e5e5;
        text-transform: uppercase;
    }

    .session-row th {
        background: #facc15;
        color: #000;
        text-align: left;
        padding: 8px;
    }

    .resume-table {
        margin-top: 20px;
        border: 1px solid #000;
    }

    .resume-table th {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
        background: #f3f3f3;
    }

    .signature-section {
        width: 100%;
        margin-top: 80px;
    }

    .signature-table td {
        width: 33%;
        text-align: center;
        vertical-align: top;
    }

    .signature-line {
        margin-top: 40px;
    }

    .text-left {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }
</style>

    <div class="page">

        <!-- HEADER -->
        {{-- <table class="header-table">
            <tr>
                <td width="15%">
                    <img class="logo" src="{{ public_path('images/logoUGNH.png') }}">
                </td>

                <td width="70%" class="header-center">
                    <h1>UGNH</h1>
                    <h2>Université du Grand Nord d'Haïti</h2>
                    <p>La science au service du développement</p>
                    <p>142, rue 7A, HT1110 - Cap-Haïtien, Haïti</p>
                </td>

                <td width="15%" class="text-right">
                    <img class="logo" src="{{ public_path('images/logoUGNH.png') }}">
                </td>
            </tr>
        </table> --}}

        @foreach ($InfosEtudiant as $infos)

            <!-- FACULTE -->
            <div class="faculte-box">
                <p>Faculté des {{ $infos->faculte->first()?->nom ?? '' }}</p>
                <p>Relever des notes pour l’année académique 2026-2027</p>
            </div>

            <!-- INFOS ETUDIANT -->
            <table class="student-info">
                <tr>
                    <td width="50%">
                        Matricule :
                        <span>{{ $infos->matricule ?? '' }}</span>
                    </td>

                    <td width="50%">
                        Niveau :
                        <span>{{ $niveau }}</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        Nom et prénom :
                        <span>{{ $infos->nom ?? '' }} {{ $infos->prenom ?? '' }}</span>
                    </td>
                </tr>
            </table>

        @endforeach

        <!-- TABLE NOTES -->
        <table class="note-table">

            <thead>
                <tr>
                    <th>Cours</th>
                    <th>Note</th>
                    {{-- <th>Reprise</th>
                    <th>Crédits</th>
                    <th>Mention</th> --}}
                </tr>
            </thead>

            <tbody>

                @php
                    $moyenne1 = 0;
                    $moyenne2 = 0;

                    $total1 = 0;
                    $total2 = 0;
                @endphp

                @foreach ($noteByEtudiant as $session => $notes)

                    <tr class="session-row">
                        <th colspan="5">Session {{ $session }}</th>
                    </tr>

                    @php
                        $total = 0;
                        $creditsTotal = 0;
                        $nombreMatiere = 0;
                    @endphp

                    @foreach ($notes as $note)

                        @php
                            if ($note->noteIntra != null && $note->examenFinal != null) {
                                $noteFinal = $note->noteIntra + $note->examenFinal;
                            } else {
                                $noteFinal = '-';
                            }
                        @endphp

                        <tr>
                            <td>{{ $note->nom }}</td>

                            <td>{{ $noteFinal }}</td>

                            {{-- <td>
                                @if (($noteFinal < 65 && is_null($note->noteRattrapage) && !is_null($note->noteIntra) && !is_null($note->examenFinal)))
                                    Oui
                                @elseif (is_null($note->noteIntra) || is_null($note->examenFinal))
                                    -
                                @else
                                    {{ $note->noteRattrapage ?? 'Non' }}
                                @endif
                            </td> --}}

                            {{-- <td>{{ $note->credit ?? 0 }}</td> --}}

                            @php
                                $mention = function($note) {
                                    if ($note >= 85) return 'Très Bien';
                                    if ($note >= 75) return 'Bien';
                                    if ($note >= 65) return 'Assez Bien';
                                    if ($note >= 50) return 'Passable';

                                    return 'Échec';
                                };
                            @endphp

                            {{-- <td>
                                {{ $noteFinal != '-' ? $mention($noteFinal) : '-' }}
                            </td> --}}
                        </tr>

                        @php
                            $nombreMatiere += 1;

                            if ($note->noteIntra != null && $note->examenFinal != null) {
                                $total += ($note->noteIntra + $note->examenFinal);
                            }

                            $creditsTotal += ($note->credit ?? 1);
                        @endphp

                    @endforeach

                    {{-- <tr>
                        <td colspan="5">
                            <strong>Total :</strong> {{ $total }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5">
                            <strong>Moyenne :</strong>

                            @if($nombreMatiere > 0)
                                {{ number_format($total / ($nombreMatiere * 10), 2) }}
                            @else
                                0
                            @endif
                        </td>
                    </tr> --}}

                    @php
                        $moyenne = $nombreMatiere > 0
                            ? $total / ($nombreMatiere * 10)
                            : 0;

                        if ($session == '1') {
                            $moyenne1 = $moyenne;
                            $total1 = $total;
                        }

                        elseif ($session == '2') {
                            $moyenne2 = $moyenne;
                            $total2 = $total;
                        }
                    @endphp

                @endforeach

            </tbody>

        </table>

        <!-- RESUME -->
        {{-- <table class="resume-table">
            <tr>
                <th>
                    Total Général :
                    {{ ($total1 + $total2) ?? 0 }}
                </th>
            </tr>

            <tr>
                <th>
                    Moyenne de l'année :
                    {{ number_format((($moyenne1 + $moyenne2) / 2), 2) }}
                </th>
            </tr>

             @if ($admisOrNot !='null')
                <tr>
                    <th style="font-weight: bold;">
                        Descision fin d'annee :

                        @if ($admisOrNot =='yes')
                            Admis(e)
                        @else
                            Echoue(e)
                        @endif
                    </th>
                </tr>
             @endif
            
        </table> --}}

        <!-- SIGNATURE -->
        <div class="signature-section">

            <table class="signature-table">
                <tr>
                    <td class="text-left">
                        Fait à l’UGNH, le 27 Avril 2026
                    </td>

                    <td>
                        <div class="signature-line">
                            ______________________
                        </div>

                        <p>Décanat de Sc. Informatique</p>
                    </td>

                    <td>
                        <div class="signature-line">
                            ______________________
                        </div>

                        <p>Rectorat de l’UGNH</p>
                    </td>
                </tr>
            </table>

        </div>

    </div>
    @endsection