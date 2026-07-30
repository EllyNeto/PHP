{{-- @extends('layout.main')

@section('tittle', 'profile')

@section('content') --}}

@foreach ($userss as $user)
    <div class="profile-container">
        <h1>Perfil do Utilizador</h1>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>PassCrypt:</strong> {{ $user->password }}</p>
    </div>
@endforeach

{{-- @endsection --}}
