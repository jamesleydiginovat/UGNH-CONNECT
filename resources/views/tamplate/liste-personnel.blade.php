
    @extends('layouts.basePdf')

    @section('titre')
        {{ $titre }}
    @endsection

    @section('contenu')

        {{-- <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th style="width: 130px">Code</th>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Adresse</th>
                </tr>
            </thead>

            <tbody>
                @foreach($personnels as $p)
                <tr>
                    
                    <td>{{ $p->code }}</td>
                    <td>{{ $p->nom." ".$p->prenom }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->telephone }}</td>
                    <td>{{ $p->adresse }}</td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}




        <style>
        table {
            width: 100%;
            border-collapse: collapse; /* 🔥 très important */
        }

        .th {
            border: 1px solid #e4e3e3; /* 👈 bordure fine */
            padding: 4px;
            font-size: 18px;
        }

        thead tr {
            background-color: #1833a0;
            color: white;
        }
        </style>

        <section style="margin-top: 20px;">
            @if ($codePersonnel =="")
                @if ($personnels->isEmpty())
                    <p>Aucun!</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th class="th" style="width:130px;">Code</th>
                                <th class="th" >Nom complet</th>
                                <th class="th" >Email</th>
                                <th class="th" >Téléphone</th>
                                <th class="th" >Adresse</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($personnels as $personnel)
                            <tr>
                                <td class="th"  >{{ $personnel->code }}</td>
                                <td class="th" >{{ $personnel->nom . " " . $personnel->prenom }}</td>
                                <td class="th" >{{ $personnel->email }}</td>
                                <td class="th" >{{ $personnel->telephone }}</td>
                                <td class="th" >{{ $personnel->adresse }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                
                <table width="100%" cellspacing="0" cellpadding="5">
                    <tbody>
                        @foreach ($personnels as $personnel )
                        <tr class="bg-blue-100" style="background-color: #bcdef7">
                            <td class="font-bold text-left"  style="padding: 3px; font-weight: bold; text-align: start">STATUS</td>
                            <td class="text-end" style="padding: 3px; text-align: end; font-weight: bold;">{{ $personnel->status }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Code</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->code }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Nom</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->nom }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Prenom</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->prenom }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Sexe</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->sexe }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Email</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->email }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Adresse</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->adresse }}</td>
                        </tr>


                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Telephone</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->telephone }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Fonction</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->fonction }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold text-left" style="padding: 3px; font-weight: bold; text-align: start">Condition matrimoniale</td>
                            <td class="text-left" style="padding: 3px;">{{ $personnel->conditionMatrimoniale }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>

            @endif
        </section>

    @endsection