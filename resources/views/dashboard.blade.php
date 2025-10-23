@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="text-center m-10">dashboard</div>
    
    {{-- show success msg --}}
    @include('partials.show_msg')
@endsection