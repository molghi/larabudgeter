<div class="months flex justify-between gap-8 max-w-5xl mx-auto my-12">
    @foreach ($months_final_days as $k => $final_day)
    <div class="month-wrapper">
        <div class="font-bold mb-4 text-xl text-center text-[var(--accent2)]">Month {{ $month_nums_to_show[$k] }} of {{ $years_to_show[$k] }}</div>
        
        <div class="month grid grid-cols-7 min-h-[252px] mb-8">
            @for ($i = 0; $i < 7; $i++)
                <div class="day text-sm pointer-events-none text-[var(--accent3)] text-center p-2">{{ substr($weekday_names[$i], 0, 2) }}</div>
            @endfor
            @for ($i = 0; $i < $months_first_days_offset[$k]; $i++)
                <div class="day pointer-events-none opacity-30 text-center p-2"></div>
            @endfor
            @for ($i = 0; $i < $final_day; $i++)
                <div class="day text-sm text-center p-2 transition hover:opacity-100 hover:bg-[var(--accent)] hover:text-[var(--bg)] cursor-pointer {{$k === 0 && $i+1 < $date_now ? 'opacity-20' : ''}}" data-day="{{$years_to_show[$k]}}-{{$month_nums_to_show[$k]}}-{{$i+1}}">
                    {{ $i+1 }}
                </div>
            @endfor
        </div>

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
                    <tr>
                        <td colspan="3" class="italic text-sm border text-center text-[gray]">Nothing here yet</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>