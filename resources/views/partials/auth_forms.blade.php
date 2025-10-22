<div class="max-w-md mx-auto p-4 bg-black text-[var(--accent)] rounded mt-10">

    {{-- Tab Switcher --}}
  <div class="flex border-b border-[var(--accent)] mb-8 tabs">
    <div class="tab flex-1 cursor-pointer text-center py-2 transition border-b-2 border-[var(--accent)] font-bold">Sign Up</div>
    <div class="tab flex-1 cursor-pointer text-center py-2 transition opacity-50 hover:opacity-100">Log In</div>
  </div>

  {{-- Sign Up Form --}}
  <form class="signup-form flex flex-col gap-8">
    <input type="email" placeholder="Email" autofocus="true" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <input type="password" placeholder="Password" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <input type="password" placeholder="Repeat Password" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <button class="w-full py-2 border border-[aqua] text-[aqua] rounded transition hover:bg-[aqua] hover:text-black">Sign Up</button>
  </form>

  {{-- Log In Form --}}
  <form class="login-form flex flex-col gap-6 hidden">
    <input type="email" placeholder="Email" autofocus="true" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <input type="password" placeholder="Password" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <button class="w-full py-2 border border-[limegreen] text-[limegreen] rounded transition hover:bg-[limegreen] hover:text-black">Log In</button>
  </form>

</div>


{{-- Switch Tabs --}}
<script>
    document.querySelector('.tabs').addEventListener('click', function(e) {
        const clickedEl = e.target;
        if (!clickedEl.classList.contains('tab')) return;
        
        document.querySelectorAll('.tab').forEach(x => {
            x.classList.remove('border-b-2', 'border-[var(--accent)]', 'font-bold');
            x.classList.add('opacity-50');
        })
        clickedEl.classList.remove('opacity-50');
        clickedEl.classList.add('border-b-2', 'border-[var(--accent)]', 'font-bold');

        if (clickedEl.textContent === 'Sign Up') {
            document.querySelector('.signup-form').classList.remove('hidden');
            document.querySelector('.login-form').classList.add('hidden');
            document.querySelector('.signup-form input').focus();
        } else {
            document.querySelector('.login-form').classList.remove('hidden');
            document.querySelector('.signup-form').classList.add('hidden');
            document.querySelector('.login-form input').focus()
        }
    })
</script>