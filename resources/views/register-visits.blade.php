@extends('template-mobile')
@section('content')
    @livewire('register-visits', ['schedule' => $schedule])
@endsection
