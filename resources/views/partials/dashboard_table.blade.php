<div class="flex-1">
  <div class="p-4 pt-0 bg-black text-[var(--accent2)] rounded">

    <h4 class="mb-3 text-center text-xl font-bold text-[var(--accent3)]">Entries</h4>

    <table class="w-full border border-[var(--accent)] text-[var(--accent)] rounded">
      <thead class="bg-black/80">
        <tr>
          <th class="py-2 px-3 text-green-500 text-left">Amount</th>
          <th class="py-2 px-3 text-green-500 text-left">Category</th>
          <th class="py-2 px-3 text-green-500 text-left">Date</th>
          <th class="py-2 px-3 text-green-500 text-left">Notes</th>
          <th class="py-2 px-3 text-green-500 text-left">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-[var(--accent)]">
        @if (count($entries) > 0)
            @foreach($entries as $entry)
                <tr class="entry text-sm text-[var(--accent2)] hover:bg-[#111]" data-id="{{$entry->id}}">
                    <td class="entry__amount py-3 px-3 {{ $entry->category !== 'income' ? 'text-[coral]' : 'text-[limegreen]' }}">{{$currency_sign}} {{$entry->amount}}</td>
                    <td class="entry__category py-2 px-3">{{$entry->category}}</td>
                    <td class="entry__date py-2 px-3">{{substr($entry->date, 0, 10)}}</td>
                    <td style="width: 200px;" class="py-2 px-3">
                        <span class="entry__note text-sm">{{$entry->note}}</span>
                    </td>
                    <td class="align-middle">
                        <button class="opacity-50 hover:opacity-100 transition border border-[var(--accent2)] px-1 rounded text-sm btn-edit">Edit</button>
                        <form class="inline-block" action="{{ route('entry.delete', $entry->id) }}" METHOD="POST">
                            @csrf
                            @method("DELETE")
                            <button onclick="return confirm('Are you sure you want to delete this entry?\nThis action cannot be undone.')" type="submit" class="opacity-50 hover:opacity-100 transition border border-[red] text-[red] px-1 rounded text-sm btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else 
            <tr>
                <td colspan="5" class="italic text-center py-4 text-[var(--accent2)]">Your entries will show here.</td>
            </tr>
        @endif
      </tbody>
    </table>

  </div>
</div>
