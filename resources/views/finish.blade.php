@extends('template-mobile')
@section('content')
    @livewire('finish-visits', ['schedule' => $schedule])
@endsection
