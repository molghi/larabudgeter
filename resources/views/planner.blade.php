@php
    date_default_timezone_set('Etc/GMT-4');

    $months_to_show = 4;

    $months_final_days = [];
    $months_first_days_offset = [];
    $month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $weekday_names = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ];
    $month_nums_to_show = [];
    $years_to_show = [];

    for ($i = 0; $i < $months_to_show; $i++) {
        $month = date('m') + $i;
        $year = $month > 12 ? date('Y') + 1 : date('Y');
        $month = $month > 12 ? $month-12 : $month;
        array_push($month_nums_to_show, $month);
        array_push($years_to_show, $year);
        array_push($months_final_days, date('d',strtotime("last day of {$month_names[$month-1]} ${year}")));
        array_push($months_first_days_offset, date('w', strtotime("first day of {$month_names[$month-1]} ${year}")));
    }

    $date_now = date('d');
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="max-w-5xl mx-auto mt-8 text-center text-[var(--accent3)]"><u>To add entry</u>: click on a day. &nbsp;  | &nbsp;  <u>To edit entry</u>: click it once.  &nbsp; | &nbsp;  <u>To delete entry</u>: double-click it.</div>
    @include('partials.planner_months')
    @include('partials.planner_forms')
@endsection