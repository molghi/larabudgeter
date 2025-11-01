@php
    $entries_dates = []; // entries months
    $entries_full_dates = [];
    if (count($entries) > 0) {
        for ($i = 0; $i < count($entries); $i++) {
            $month = explode('-', $entries[$i]['when'])[1];
            array_push($entries_dates, '-' . $month . '-');
            array_push($entries_full_dates, $entries[$i]['when']);
        }
    } 

    if (!function_exists('get_time_between'))
    {    // must wrap in this IF cuz otherwise every time Blade view is rendered, PHP tries to redeclare func (throws an error)
        function get_time_between ($second_date) {
            $first_date = time();   // now in sec
            $second_date = strtotime($second_date);   // date-time in sec
            $diff_raw = $second_date - $first_date;
            $diff_days = floor($diff_raw / 60 / 60 / 24) + 1;   // adding 1 to compensate
            if ((int) $diff_days === 0) {
                return 'today';
            } elseif ((int) $diff_days < 0) {
                $word = $diff_days == 1 || $diff_days == -1 ? " " . 'day' : ' ' . 'days';
                return abs($diff_days) . $word . ' ago';
            }
            else {
                $word = $diff_days == 1 || $diff_days == -1 ? " " . 'day' : ' ' . 'days';
                return 'in ' . abs($diff_days) . $word;
            }
        }
    }

    $available_balance = $current_balance ? $current_balance : 0;

    $entries = $entries->sortBy('when');
@endphp

<div class="months flex justify-between gap-8 max-w-5xl mx-auto my-12">
    @foreach ($months_final_days as $k => $final_day)
    <div class="month-wrapper">
        <div class="font-bold mb-4 text-xl text-center text-[var(--accent2)]">Month {{ $month_nums_to_show[$k] }} of {{ $years_to_show[$k] }}</div>
        {{-- MONTH DAYS --}}
        <div class="month grid grid-cols-7 min-h-[252px] mb-8">
            @for ($i = 0; $i < 7; $i++)
                <div class="day text-sm pointer-events-none text-[var(--accent3)] text-center p-2">{{ substr($weekday_names[$i], 0, 2) }}</div>
            @endfor
            @for ($i = 0; $i < $months_first_days_offset[$k]; $i++)
                <div class="day pointer-events-none opacity-30 text-center p-2"></div>
            @endfor
            @for ($i = 0; $i < $final_day; $i++)
                @php
                $current_date = $years_to_show[$k] . '-' . $month_nums_to_show[$k] . '-' . ($i+1);
                @endphp
                <div class="day text-sm text-center p-2 transition hover:opacity-100 hover:bg-[var(--accent)] hover:text-[var(--bg)] cursor-pointer {{ $k === 0 && $i+1 < $date_now ? 'opacity-20' : '' }} {{ in_array($current_date, $entries_full_dates) ? 'bg-[gold] text-[black]' : '' }}" 
                        data-day="{{ $current_date }}">
                    {{ $i+1 }}
                </div>
            @endfor
        </div>

        {{-- TABLE --}}
        <div class="month-table">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="font-normal text-sm border">Title</th>
                        <th class="font-normal text-sm border">Amount</th>
                        <th class="font-normal text-sm border">When</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($entries) > 0)
                    @foreach ($entries as $key => $entry)
                            {{--  render under appropriate month --}}
                            @if ($month_nums_to_show[$k] == date('m', strtotime($entry['when'])))
                                <tr class="table-entry cursor-pointer hover:bg-[#222] active:opacity-60" data-when="{{$entry->when}}" data-id="{{$entry->id}}">
                                    <td class="font-normal pl-[5px] text-[12px] border">{{$entry->title}}</td>
                                    <td class="font-normal text-sm border text-center">{{$entry->amount}}</td>
                                    <td class="font-normal text-[12px] border text-center" title="{{$entry->when}}">{{get_time_between($entry->when)}}</td>
                                </tr>
                            @else 
                                @if ($key === 0 && !in_array("-$month_nums_to_show[$k]-", $entries_dates)) {{-- to print it only once --}}
                                    <tr>
                                        <td colspan="3" class="italic text-sm border text-center text-[gray]">Nothing here yet</td>
                                    </tr>
                                @endif
                                @if($month_nums_to_show[0] === $month_nums_to_show[$k] && $key === 0) {{-- print balance in month 1 --}}
                                    <tr class="opacity-50 hover:opacity-100 transition italic" title="To change your initial balance, use the form below.">
                                        <td class="font-normal pl-[5px] text-[12px] border">Balance</td>
                                        <td class="font-normal text-sm border pl-6" colspan="2">{{ $current_balance }}</td>
                                    </tr>
                                @endif
                            @endif
                    @endforeach
                        @php
                            // count current monthly sum
                            $month_sum = 0;
                            $current_month = '-' . $month_nums_to_show[$k] . '-';
                            foreach($entries as $entry) {
                                if (str_contains($entry['when'], $current_month)) {
                                    $month_sum += $entry['amount'];
                                }
                            }
                            $available_balance += $month_sum;
                        @endphp
                        <tr class="opacity-50 hover:opacity-100 transition italic">
                            <td class="font-normal pl-[5px] text-[12px] border">Remains</td>
                            <td class="font-normal text-sm border pl-7" colspan="2">{{ $available_balance }}</td>
                        </tr>
                    @else 
                        <tr>
                            <td colspan="3" class="italic text-sm border text-center text-[gray]">Nothing here yet</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

@include('partials.planner_scripts')