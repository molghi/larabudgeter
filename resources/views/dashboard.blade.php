@php
    $categories = [
        'Income',
        'Food',
        'Rent',
        'Utilities',
        'Transport',
        'Medical',
        'Shopping',
        'Travel',
        'Education',
        'Savings',
        'Entertainment',
        'Other',
    ];

    use App\Http\Controllers\EntryController;
    $entries = EntryController::read();

    $currency_sign = '₾';

    $total_income = EntryController::total_income();
    $total_expense = EntryController::total_expense();
    $categories_summary = EntryController::categorize_incomes();
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    @include('partials.dashboard_summary')
    <div class="flex gap-8 max-w-5xl mx-auto">
        @include('partials.dashboard_form')
        @include('partials.dashboard_table')
    </div>
    
    {{-- show success msg --}}
    @include('partials.show_msg')
@endsection