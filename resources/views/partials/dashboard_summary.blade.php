@php
    $periods = [];
    $periodsShort = [];
    $year_now = date('Y');
    $month_now = date('m');
    for ($i = 0; $i < 12; $i++) {
        $entry = 'Month ' . ($i+1) . ' of ' . $year_now;
        if ($i+1 == $month_now) $entry .= ' — NOW';
        array_push($periods, $entry);
        $month = $i+1;
        array_push($periodsShort, "$year_now-$month");
    }

    $category_colors = [
        'entertainment' => 'SpringGreen',
        'food' => 'IndianRed',
        'transport' => 'indigo',
    ];
@endphp


<div class="max-w-5xl mx-auto border border-[var(--accent)] rounded mt-6 mb-8">
  <div class="p-4 bg-black text-[var(--accent2)] rounded">
    
    <h4 class="mb-3 text-center text-xl font-bold text-[var(--accent3)]">Spending Summary</h4>

    <div class="flex justify-between items-center mb-4">
      <div>
        <div class="mb-2">
          <strong class="inline-block min-w-[125px] text-[var(--accent2)]">Total Income:</strong>
          <span class="text-lime-400">{{ $currency_sign }} {{ $total_income }}</span>
        </div>
        <div>
          <strong class="inline-block min-w-[125px] text-[var(--accent2)]">Total Expense:</strong>
          <span class="text-orange-400">{{ $currency_sign }} {{ $total_expense }}</span>
        </div>
      </div>
      <div>
        <strong class="mr-2 text-[var(--accent2)]">Select Period:</strong>
        <select class="period-select bg-black border border-[var(--accent2)] text-[var(--accent2)] rounded px-2 py-1">
            @foreach ($periods as $k => $v)
                {{-- <option value="{{ $periodsShort[$k] }}" {{ $k+1 == $month_now ? 'selected' : '' }}>{{ $v }}</option> --}}
                <option value="{{ $periodsShort[$k] }}" {{ $periodsShort[$k] == $shown_period ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        </select>
      </div>
    </div>

    <h5 class="text-md mb-2"><span class="text-[var(--accent)]">Chart:</span> Distribution of Expenses by Category</h5>

    <div class="bg-[#111] rounded p-6">
      <div class="flex items-center justify-center h-full mb-4">
        <!-- chart -->
        @if ($total_expense > 0)
            @foreach ($categories_summary as $k => $v)
                @if ($k !== 'income')
                 <div class="h-[10px] bg-[{{ $category_colors[$k] }}] w-[{{ ($v/$total_expense)*100 }}%]"></div>
                @endif
            @endforeach
        @endif
      </div>
      <ol class="font-bold m-0">
        <!-- legend -->
        @if ($total_expense > 0)
        <ol class="list-decimal list-inside">
            @foreach ($categories_summary as $k => $v)
                @if ($k !== 'income')
                 <li class="text-[{{ $category_colors[$k] }}]">{{$k}} ({{$currency_sign}} {{$v}})</li>
                @endif
            @endforeach
        </ol>
        @endif
      </ol>
    </div>

  </div>
</div>



<script>
    const periodSelect = document.querySelector('.period-select');
    periodSelect.addEventListener('change', function(e) {
        const selectedPeriod = e.target.value;
        location.href = `/dashboard/period/${selectedPeriod}`;
    })

    function submitPostForm(formAction) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = formAction;
        document.body.appendChild(form);
        form.submit();
    }
</script>