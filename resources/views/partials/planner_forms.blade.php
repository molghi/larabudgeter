@php
    $mode = 'show';
    if (!empty($edit_entry) && $edit_entry) $mode = 'edit';
    if (!empty($date) && $date) $mode = 'add';

    $form_action = '#';
    if ($mode === 'add') $form_action = route('expense.create');
    if ($mode === 'edit') $form_action = route('expense.update', $edit_entry['id']);
@endphp

<div class="max-w-5xl mx-auto grid grid-cols-4 gap-8">
    {{-- SET CURRENT BALANCE --}}
    <form action="{{ route('balance.set') }}" method="POST" class="flex flex-col gap-2 max-w-[170px]">
        @csrf
        <div class="flex flex-col gap-2 mb-2">
            <label for="balance" class="block text-[var(--accent2)] text-sm cursor-pointer">Set current balance</label>
            <input type="number" step="0.1" id="balance" name="balance"
                value="{{ !empty($current_balance) && $current_balance ? $current_balance : '' }}"
                class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
        </div>
        <div>
            <button type="submit" class="px-4 py-2 border border-[var(--accent)] rounded hover:bg-[var(--accent)] hover:text-black transition">Set</button>
        </div>
        @error ('balance')
            <div class="text-[red] p-2 border border-[red] my-3">{{$message}}</div>
        @enderror
    </form>

    {{-- ADD OR EDIT ENTRY FORM --}}
    <div class="add-edit-form col-span-3 {{ $mode === 'show' ? 'hidden' : '' }}">
        <div class="flex justify-between items-start max-w-[230px]">
            <h4 class="mb-3 text-xl font-bold text-[var(--accent2)]">{{ucwords($mode)}} Entry</h4>
            <button type="button" title="Close form" class="px-2 bg-red-500 text-black rounded opacity-70 transition hover:opacity-50" title="Close form">×</button>
        </div>

        <form action="{{ $form_action }}" method="POST" class="grid grid-cols-3 gap-x-8 gap-y-6">
            @csrf 

            @if ($mode === 'edit')
                @method("PUT")
            @endif

            <div>
                {{-- TITLE --}}
                <label for="title" class="block text-[var(--accent2)] font-bold">Title <span class="text-red-400">*</span></label>
                <input id="title" name="title" required autofocus type="text"
                    value="{{ $mode === 'edit' ? $edit_entry->title : '' }}"
                    class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
            </div>
            <div>
                {{-- AMOUNT --}}
                <label for="amount" class="block text-[var(--accent2)] font-bold">Amount <span class="text-red-400">*</span></label>
                <input id="amount" name="amount" required type="number" step="0.1"
                    value="{{ $mode === 'edit' ? $edit_entry->amount : '' }}"
                    class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
            </div>
            <div>
                {{-- WHEN --}}
                <label for="day" class="block text-[var(--accent2)] font-bold">When</label>
                <input id="day" name="when" type="date" {{ $mode === 'add' ? 'readonly' : "" }}
                    class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)]  {{ $mode === 'add' ? 'opacity-50 cursor-not-allowed' : "" }}"
                    @php
                        $val = $mode === 'edit' ? $edit_entry->when : '';
                        if ($mode === 'add') $val = date('Y-m-d', strtotime($date));
                    @endphp
                    value="{{ $val }}"
                    >
            </div>
            {{-- ACTION BTN --}}
            <button type="submit" class="w-full py-2 border border-[var(--accent)] rounded hover:bg-[var(--accent)] hover:text-black transition">{{ucwords($mode)}}</button>
        </form>
    </div>

</div>