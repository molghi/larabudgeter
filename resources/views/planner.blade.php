@php
    $months_to_show = 3;
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="text-center my-10">Expense Planner: show {{$months_to_show}} months</div>
@endsection