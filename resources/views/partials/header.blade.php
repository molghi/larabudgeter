@php
    $user_id = Auth::id();

    $shown_page = url()->current();
    $page_dashboard = str_contains($shown_page, '/dashboard');
    $page_planner = str_contains($shown_page, '/planner');
@endphp


<header class="p-4 bg-[#111] text-[var(--accent)]">
    <div class="max-w-5xl mx-auto w-full flex flex-col sm:flex-row gap-x-8 gap-y-3 justify-between items-center">

  <div class="text-2xl font-bold">Personal Budget</div>

  <div class="flex gap-4">
    @if ($user_id && !empty($user_id))
        @if ($page_dashboard)
            <a href="/planner" class="px-4 py-2 border border-[purple] bg-[purple] rounded whitespace-nowrap transition hover:bg-[var(--accent)] hover:border-[var(--accent)] text-black">Expense Planner</a>
        @endif
        @if ($page_planner)
            <a href="/dashboard" class="px-4 py-2 border border-[purple] bg-[purple] rounded whitespace-nowrap transition hover:bg-[var(--accent)] hover:border-[var(--accent)] text-black">Dashboard</a>
        @endif
        <button class="logout px-4 py-2 border border-white text-white opacity-50 rounded whitespace-nowrap transition hover:opacity-100">Log Out</button>
    @else 
        <span class="italic">Your Easy Expense & Savings Tracker!</span>
    @endif
  </div>

 </div>
</header>


<script>
    // LOG OUT FUNCTIONALITY
    document.querySelector('.logout').addEventListener('click', () => {
        location.href = '/users/logout';
    })
</script>