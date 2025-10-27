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

    $shown_period = session('period') ? session('period') : date('Y-m');
    use App\Http\Controllers\EntryController;
    $entries = EntryController::read($shown_period);

    $currency_sign = '₾';

    $total_income = EntryController::total_income($shown_period);
    $total_expense = EntryController::total_expense($shown_period);
    $categories_summary = EntryController::categorize_incomes($shown_period);
@endphp

@extends('layouts.app')

@section('title', $title ?? 'Dashboard | Your Budgeter')

@section('content')
    @include('partials.dashboard_summary')
    <div class="flex gap-8 max-w-5xl mx-auto">
        @include('partials.dashboard_form')
        @include('partials.dashboard_table')
    </div>
    
    {{-- show success msg --}}
    @include('partials.show_msg')
@endsection