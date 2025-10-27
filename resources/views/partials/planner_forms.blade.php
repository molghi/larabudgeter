<div class="max-w-5xl mx-auto grid grid-cols-4 gap-8">
    {{-- SET CURRENT BALANCE --}}
    <form method="POST" class="flex flex-col gap-2 max-w-[170px]">
        <div class="flex flex-col gap-2 mb-2">
            <label for="balance" class="block text-[var(--accent2)] text-sm cursor-pointer">Set current balance</label>
            <input type="number" step="0.1" id="balance" name="balance"
                class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
        </div>
        <div>
            <button type="submit" class="px-4 py-2 border border-[var(--accent)] rounded hover:bg-[var(--accent)] hover:text-black transition">Set</button>
        </div>
    </form>

    {{-- ADD OR EDIT ENTRY FORM --}}
    <div class="col-span-3 hidden">
        <div class="flex justify-between items-start max-w-[230px]">
            <h4 class="mb-3 text-xl font-bold text-[var(--accent2)]">Add Entry</h4>
            <button type="button" title="Close form" class="px-2 bg-red-500 text-black rounded opacity-70 transition hover:opacity-50" title="Close form">×</button>
        </div>

        <form method="POST" class="grid grid-cols-3 gap-x-8 gap-y-6">
            @csrf 
            <div>
                {{-- TITLE --}}
                <label for="title" class="block text-[var(--accent2)] font-bold">Title <span class="text-red-400">*</span></label>
                <input id="title" name="title" required autofocus type="text"
                    class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
            </div>
            <div>
                {{-- AMOUNT --}}
                <label for="amount" class="block text-[var(--accent2)] font-bold">Amount <span class="text-red-400">*</span></label>
                <input id="amount" name="amount" required type="number" step="0.1"
                    class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
            </div>
            <div>
                {{-- WHEN --}}
                <label for="day" class="block text-[var(--accent2)] font-bold">When</label>
                <input id="day" name="when" type="date" readonly
                    class="w-full p-2 border border-[var(--accent)] rounded bg-black text-[var(--accent)] opacity-50 cursor-not-allowed"
                    value="2025-11-30">
            </div>
            {{-- ACTION BTN --}}
            <button type="submit" class="w-full py-2 border border-[var(--accent)] rounded hover:bg-[var(--accent)] hover:text-black transition">Add</button>
        </form>
    </div>

</div>