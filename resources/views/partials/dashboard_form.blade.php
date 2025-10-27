@php
    date_default_timezone_set('Etc/GMT-4');
    $mode = !empty($flag) && $flag ? 'edit' : 'add';
@endphp

<div class="border border-[var(--accent)] rounded">
  <div class="p-4 bg-black text-[var(--accent)] rounded">

    <h4 class="mb-3 text-center text-xl font-bold text-[var(--accent3)]">{{ ucwords($mode) }} Entry</h4>

    <form action="{{ $mode === 'add' ? route('entry.create') : route('entry.update', $entry['id']) }}" method="POST" class="space-y-4">
      @csrf

      @if ($mode === 'edit')
        @method('PUT')
      @endif

      <div>
        <label for="amount" class="block text-[var(--accent2)] font-bold">Amount <span class="text-red-400">*</span></label>
        <input name="amount" id="amount" type="number" placeholder="Enter amount" class="w-full p-2 border border-[var(--accent2)] rounded bg-black text-[var(--accent)]" {{ $mode === 'edit' ? 'autofocus="true"' : ''}} value="{{ $mode === 'edit' ? $entry['amount'] : '' }}">
        @error('amount')
            <div class="text-[red] text-sm p-2">{{$message}}</div>
        @enderror
      </div>

      <div>
        <label for="category" class="block text-[var(--accent2)] font-bold">Category <span class="text-red-400">*</span></label>
        <select name="category" id="category" class="w-full p-2 border border-[var(--accent2)] rounded bg-black text-[var(--accent2)]">
          <option disabled selected>Select category</option>
          @foreach ($categories as $c)
            <option value="{{ strtolower($c) }}" {{ $mode === 'edit' && $entry['category'] === strtolower($c) ? 'selected' : '' }}>{{ $c }}</option>
          @endforeach
        </select>
        @error('category')
            <div class="text-[red] text-sm p-2">{{$message}}</div>
        @enderror
      </div>

      <div>
        <label for="date" class="block text-[var(--accent2)] font-bold">Date <span class="text-red-400">*</span></label>
        <input name="date" id="date" type="date" class="w-full p-2 border border-[var(--accent2)] rounded bg-black text-[var(--accent2)]"
            value="{{ $mode === 'add' ? date('Y-m-d') : date('Y-m-d', strtotime($entry['date'])) }}">
        @error('date')
            <div class="text-[red] text-sm p-2">{{$message}}</div>
        @enderror
    </div>

      <div>
        <label for="notes" class="block text-[var(--accent2)] font-bold">Notes (optional)</label>
        <input name="note" id="notes" type="text" placeholder="Enter notes" class="w-full p-2 border border-[var(--accent2)] rounded bg-black text-[var(--accent)]" value="{{ $mode === 'edit' ? $entry['note'] : '' }}">
        @error('note')
            <div class="text-[red] text-sm p-2">{{$message}}</div>
        @enderror
      </div>

      <button class="w-full py-2 border border-[var(--accent)] transition rounded hover:text-black hover:bg-[var(--accent)]">
        {{ ucwords($mode) }}
      </button>
    </form>

  </div>
</div>
