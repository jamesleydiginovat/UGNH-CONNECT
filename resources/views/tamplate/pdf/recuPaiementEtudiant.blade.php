@extends('layouts.baseRecuPaiment')

@section('contenu')

<style>
.section{
    display: flex;
    width: 100%;
    flex-direction: column;
    gap: 5px;
}

.grandDiv{
    background-color: white;
    color: black;
}

.header {
    padding-bottom: 5px;
    border-bottom: solid 1px black;
}

.page {
    width: 100%;
    height: 99mm;
    box-sizing: border-box;
    font-family: 'Times New Roman', Times, serif;
}

.sigle{
    font-size: 20px;
    font-weight: bold;
}

.definition{
    font-size: 20px;
    font-weight: bold;
}

.logo{
    width: 100%;
}

.ugnh-name{
    text-align: center;
}

.ugnh-name p {
    margin: 0;
    padding: 0;
    line-height: 1;
}

.information{
    border-left: solid 10px black;
    padding-left: 5px;
}

.information p{
    margin: 0;
    padding: 0;
    line-height: 1;
    font-size: 12px;
}

.signature{
    text-align: center;
    line-height: 1;
}

.image{
    width: 50px;
    height: 50px;
}

table {
    border-collapse: collapse;
}

td {
    padding: 3px 3px;
    vertical-align: top;
}

table p {
    margin: 0;
    padding: 0;
    line-height: 1;
}

.span {
    display: inline-block;
    font-weight: bold;
}

.bold{
    font-weight: bold;
}

</style>

<table class="header" width="100%">

    <tr>

        <td width="10%" align="left">

            <div class="logo">
                <img
                    class="image"
                    src="{{ public_path('images/logoUGNH.png') }}"
                >
            </div>

        </td>

        <td width="60%" align="center">

            <div class="ugnh-name">

                <p class="sigle">UGNH</p>

                <p class="definition">
                    Universite du Grand Nord d'Haiti
                </p>

                <p class="slogan">
                    La science au service du developpement
                </p>

            </div>

        </td>

        <td width="30%" align="left">

            <div class="information">

                <p>142, rue 7A, HT1110 - Cap-Haitien, Haiti</p>

                <p>Téls. : (509) 3238-6060 / 3744-9090</p>

                <p>Site Web : www.ugnh.edu.ht</p>

                <p>E-mail : contact@ugnh.edu.ht</p>

            </div>

        </td>

    </tr>

</table>

<table width="100%">

    <tr>

        <td width="50%" align="left">

            <p>
                Faculte:
                <span class="bold">
                    {{ $etudiant->faculte->first()?->nom ?? '-' }}
                </span>
            </p>

        </td>

        <td width="50%" align="right">

            <p>
                No:
                <span class="bold">
                    {{ $numeroTransaction }}
                </span>
            </p>

        </td>

    </tr>


    <tr>

        <td width="50%" align="left">

            <p>
                Recu de:
                <span class="bold">
                    {{ $matricule }}
                </span>
            </p>

        </td>

        <td width="50%" align="right">

            <p>
                Le:
                <span class="bold">
                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                </span>
            </p>

        </td>

    </tr>


    <tr>

        <td width="50%" align="left">

            <p style="font-weight: bold; text-align: center;">
                Montant en chiffres
            </p>

        </td>

        <td width="50%" align="right">

            <p style="font-weight: bold; text-align: center;">
                Montant en lettres
            </p>

        </td>

    </tr>


    <tr>

        <td width="50%" align="left">

            <p>
                Frais d'inscription:
                <span class="span">
                    _________________________
                </span>
                HTG
            </p>

        </td>

        <td width="50%" align="right">

            <p>
                <span class="span">
                    _________________________________________
                </span>
                HTG
            </p>

        </td>

    </tr>


    <tr>

        <td width="50%" align="left">

            <p>
                Frais Généraux:
                <span class="span">
                    ___________________________
                </span>
                HTG
            </p>

        </td>

        <td width="50%" align="right">

            <p>
                <span class="span">
                    _________________________________________
                </span>
                HTG
            </p>

        </td>

    </tr>


    <tr>

        <td width="50%" align="left">

            <p>
                Montant Académique:
                <span class="span">
                    {{ number_format($transaction->montant, 2) }}
                </span>
                HTG
            </p>

        </td>

        <td width="50%" align="right">

            <p>
                <span class="span">
                    _________________________________________
                </span>
                HTG
            </p>

        </td>

    </tr>


    <tr>

        <td width="50%" align="left">

            <p>
                Graduation:
                <span class="span">
                    ______________________________
                </span>
                HTG
            </p>

        </td>

        <td width="50%" align="right">

            <p>
                <span class="span">
                    _________________________________________
                </span>
                HTG
            </p>

        </td>

    </tr>


    <tr>

        <td width="50%" align="left">

            <p>
                Autres:
                <span class="span">
                    __________________________________
                </span>
                HTG
            </p>

        </td>

        <td width="50%" align="right">

            <p>
                <span class="span">
                    _________________________________________
                </span>
                HTG
            </p>

        </td>

    </tr>


    {{-- <tr>

        <td width="50%" align="left">

            <p style="font-weight: bold;">

                Total:
                <span class="span">
                    {{ number_format($transaction->montant, 2) }}
                </span>
                HTG

            </p>

        </td>

        <td width="50%" align="right">

            <p>
                <span class="span">
                    _________________________________________
                </span>
                HTG
            </p>

        </td>

    </tr> --}}


    <tr >

        <td width="50%" align="left">

            <p style="padding:1px 0px">

                Motif:
                <span class="span">
                    {{ $transaction->motif }}
                </span>

            </p>

            <p style="padding:1px 0px">

                Balance:
                <span class="span">
                    __________________________
                </span>
                HTG

            </p>

            <p style="font-weight: bold;">

                Total:
                <span class="span">
                    {{ number_format($transaction->montant, 2) }}
                </span>
                HTG

            </p>

        </td>

        <td width="50%" align="right">

            <div class="signature">

                <p>Signature</p>

                <br><br>

                <p>__________________________</p>

            </div>

        </td>

    </tr>

</table>

@endsection