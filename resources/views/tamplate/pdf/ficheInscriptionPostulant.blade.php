<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        /* PAGE PRINCIPALE */
        .page {
            width: 210mm;
            min-height: 297mm;
            background-color: white;
            color: black;
            margin: auto;
            padding: 1mm;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-sizing: border-box;
            font-family: 'Times New Roman', Times, serif;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        .border{
            border:1px solid #000;
        }

        .center{
            text-align: center;
        }

        .right{
            text-align: right;
        }

        .bold{
            font-weight: bold;
        }

        .title{
            font-size: 22px;
            font-weight: bold;
        }

        .subtitle{
            font-size: 14px;
        }

        .section-title{
            font-size: 14px;
            font-weight: bold;
            padding: 5px;
            border-bottom: 1px solid #000;
            margin-top: 10px;
        }

        .label{
            font-weight: bold;
            width: 180px;
        }

        .field{
            border-bottom: 1px solid #000;
            height: 22px;
        }

        .small{
            font-size: 10px;
        }

        .photo-box{
            width: 120px;
            height: 140px;
            border:1px solid #000;
        }

        td{
            padding:4px;
            vertical-align: top;
        }

        .cover{
            object-fit: cover;
        }

    </style>

    @foreach($etudiants as $etudiant)

    <table>
        <tr>
            <td width="18%">
                <img src="{{ public_path('images/logoUGNH.png') }}" width="90">
            </td>

            <td width="64%" class="center">
                <div class="title">UNIVERSITÉ DU GRAND NORD D'HAÏTI</div>

                <div class="subtitle">
                    La Science au service du Développement
                </div>

                <div>
                    142, Rue 7A, Cap-Haïtien, HAÏTI
                </div>

                <br>

                <div style="font-size:20px;font-weight:bold;">
                    FORMULAIRE D'INSCRIPTION
                </div>
            </td>

            <td width="18%" class="right">
                <table class="border">
                    <tr>
                        <td class="center bold">
                            N° : {{ $etudiant->matricule }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br>

    <!-- DATE / FACULTE -->
    <table class="border">
        <tr>
            <td width="25%">
                <span class="bold">Date :</span>
            </td>

            <td width="25%">
                {{ date('d/m/Y') }}
            </td>

            <td width="25%">
                <span class="bold">Faculté :</span>
            </td>

            <td width="25%">
                {{ $codeFac }}
            </td>
        </tr>

        <tr>
            <td>
                <span class="bold">Niveau :</span>
            </td>

            <td>
                {{ $etudiant->niveau }}
            </td>

            <td>
                <span class="bold">Statut :</span>
            </td>

            <td>
                {{ $etudiant->status }}
            </td>
        </tr>
    </table>

    <!-- RENSEIGNEMENTS PERSONNELS -->
    <div class="section-title">
        RENSEIGNEMENTS PERSONNELS
    </div>

    <table class="border">

        <tr>
            <td class="label">Matricule</td>
            <td class="field">{{ $etudiant->matricule }}</td>

            <td rowspan="6" width="140" class="center">
                <div class="photo-box">
                    @if($etudiant->photo)
                        <img class="cover" src="{{ public_path('storage/photosEtudiants/'.$etudiant->photo) }}"
                            width="118"
                            height="138">
                    @endif
                </div>
            </td>
        </tr>

        <tr>
            <td class="label">Nom</td>
            <td class="field">{{ $etudiant->nom }}</td>
        </tr>

        <tr>
            <td class="label">Prénom</td>
            <td class="field">{{ $etudiant->prenom }}</td>
        </tr>

        <tr>
            <td class="label">Sexe</td>
            <td class="field">{{ $etudiant->sexe }}</td>
        </tr>

        <tr>
            <td class="label">Date de naissance</td>
            <td class="field">{{ $etudiant->dateNaissance }}</td>
        </tr>

        <tr>
            <td class="label">Lieu de naissance</td>
            <td class="field">{{ $etudiant->lieuNaissance }}</td>
        </tr>

        <tr>
            <td class="label">Adresse</td>
            <td colspan="2" class="field">
                {{ $etudiant->adresse }}
            </td>
        </tr>

        <tr>
            <td class="label">Téléphone</td>
            <td colspan="2" class="field">
                {{ $etudiant->telephone }}
            </td>
        </tr>

        <tr>
            <td class="label">Email</td>
            <td colspan="2" class="field">
                {{ $etudiant->email }}
            </td>
        </tr>

        <tr>
            <td class="label">NIF / CIN</td>
            <td colspan="2" class="field">
                {{ $etudiant->nif_cin }}
            </td>
        </tr>

        <tr>
            <td class="label">Groupe sanguin</td>
            <td colspan="2" class="field">
                {{ $etudiant->groupeSanguin }}
            </td>
        </tr>

        <tr>
            <td class="label">Condition matrimoniale</td>
            <td colspan="2" class="field">
                {{ $etudiant->conditionMatrimoniale }}
            </td>
        </tr>

    </table>

    <!-- AUTRES RENSEIGNEMENTS -->
    <div class="section-title">
        AUTRES RENSEIGNEMENTS
    </div>

    <table class="border">

        <tr>
            <td class="label">Occupation actuelle</td>
            <td class="field">
                {{ $etudiant->occupationAcctuelle }}
            </td>
        </tr>

        <tr>
            <td class="label">Lieu de travail</td>
            <td class="field">
                {{ $etudiant->lieuDeTravail }}
            </td>
        </tr>

        <tr>
            <td class="label">Personne Responsable</td>
            <td class="field">
                {{ $etudiant->nomPrenomPersonneR }}
            </td>
        </tr>

        <tr>
            <td class="label">Téléphone Responsable</td>
            <td class="field">
                {{ $etudiant->telephonePersonneR }}
            </td>
        </tr>

        <tr>
            <td class="label">Lien</td>
            <td class="field">
                {{ $etudiant->lien }}
            </td>
        </tr>

        <tr>
            <td class="label">Personne Référence</td>
            <td class="field">
                {{ $etudiant->PersonneReferences }}
            </td>
        </tr>

    </table>

    <!-- NIVEAU D'ETUDE -->
    <div class="section-title">
        NIVEAU D'ÉTUDE
    </div>

    <table class="border">

        <tr>
            <td colspan="4" class="center bold">
                ÉTUDES SECONDAIRES
            </td>
        </tr>

        <tr class="bold center">
            <td>NIVEAU</td>
            <td>ANNÉE</td>
            <td colspan="2">ÉTABLISSEMENT</td>
        </tr>

        <tr>
            <td class="center">
                {{ $etudiant->niveauBac }}
            </td>

            <td class="center">
                {{ $etudiant->anneeBac }}
            </td>

            <td colspan="2" class="center">
                {{ $etudiant->etablissementBac }}
            </td>
        </tr>

    </table>

    <br>

    <table class="border">

        <tr>
            <td colspan="4" class="center bold">
                ÉTUDES SUPÉRIEURES
            </td>
        </tr>

        <tr class="bold center">
            <td>ÉTABLISSEMENT</td>
            <td>ANNÉE</td>
            <td>DISCIPLINE</td>
            <td>NIVEAU</td>
        </tr>

        <tr>
            <td class="center">
                {{ $etudiant->etablissementES }}
            </td>

            <td class="center">
                {{ $etudiant->anneeES }}
            </td>

            <td  class="center">
                {{ $etudiant->disciplineES }}
            </td>

            <td class="center">
                {{ $etudiant->niveauES }}
            </td>
        </tr>

    </table>

    <br>

    <table>
        <tr>
            <td class="small">
                NB : Les frais d'inscription ne sont pas remboursables.
            </td>
        </tr>
    </table>

    <br><br>

    <table>
        <tr>
            <td width="50%">
                Je soussigné(e),
                <strong>
                    {{ $etudiant->nom }} {{ $etudiant->prenom }}
                </strong>

                certifie que les renseignements fournis ci-dessus
                sont sincères et corrects.
            </td>

            <td width="50%"></td>
        </tr>
    </table>

    <br><br><br>

    <table>
        <tr>

            <td width="50%" class="center">
                ___________________________
                <br>
                Administration
            </td>

            <td width="50%" class="center">
                ___________________________
                <br>
                Signature du postulant(e)
            </td>

        </tr>
    </table>

    <br><br>

    <table>
        <tr>
            <td width="33%" class="center">
                (+509) 3239-6060 / 3744-9090
            </td>

            <td width="33%" class="center">
                contact@ugnh.edu.ht
            </td>

            <td width="33%" class="center">
                www.ugnh.edu.ht
            </td>
        </tr>
    </table>

    @if(!$loop->last)
        <div style="page-break-after: always;"></div>
    @endif

    @endforeach
</body>
</html>


{{-- @extends('layouts.basePdf')

@section('titre')
    {{ $titre }}
@endsection

@section('contenu')



@endsection --}}