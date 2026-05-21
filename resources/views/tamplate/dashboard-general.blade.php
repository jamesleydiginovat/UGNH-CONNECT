@extends('layouts.app')

@section('topBarre')
        <livewire:inclus.top-barre />
@endsection

@section('main')
        @php
            $role = Auth::user()->roles->first()->nom ?? '';

            $isAdmin = $role == "Administrateur";
            $isSecretaireGenerale = $role == "Secrétaire générale";
            $doyenFaculte = $role == "Doyen de faculté";
            $VicedoyenFaculte = $role == "Vice-doyen de faculté";
            $SecretaireFaculte = $role == "Secretaire faculte";
            $Comptable = $role == "Comptable";
            $Secrétaireadjoint = $role == "Secrétaire adjoint";
            
        @endphp
        @if ($isAdmin || $isSecretaireGenerale || $Secrétaireadjoint )
                <livewire:pages.dashboard-general />
        @elseif($doyenFaculte || $VicedoyenFaculte || $SecretaireFaculte)
                <livewire:pages.dashboard-faculte />
        @elseif($Comptable)
                <livewire:pages.dashboard-comptable />
        @endif

        
        
@endsection