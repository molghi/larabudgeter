<div class="max-w-md mx-auto p-4 bg-black text-[var(--accent)] rounded mt-10">

    {{-- Tab Switcher --}}
  <div class="tabs flex border-b border-[var(--accent)] mb-8">
    <div class="tab flex-1 cursor-pointer text-center py-2 transition border-b-2 border-[var(--accent)] font-bold">Sign Up</div>
    <div class="tab flex-1 cursor-pointer text-center py-2 transition opacity-50 hover:opacity-100">Log In</div>
  </div>

  {{-- Sign Up Form --}}
  <form action="{{ route('user.signup') }}" method="POST" class="signup-form flex flex-col gap-8">
    @csrf
    <input type="email" placeholder="Email" name="email" autofocus="true" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <input type="password" placeholder="Password" name="password" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <input type="password" placeholder="Repeat Password" name="password_confirmation" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <button class="w-full py-2 border border-[aqua] text-[aqua] rounded transition hover:bg-[aqua] hover:text-black">Sign Up</button>
    
    @error ('email')
        <div class="py-4 text-sm text-[red]"><span class="font-bold">Error: </span>{{ $message }}</div>
    @enderror
    @error ('password')
        <div class="py-4 text-sm text-[red]"><span class="font-bold">Error: </span>{{ $message }}</div>
    @enderror
  </form>

  {{-- Log In Form --}}
  <form action="{{ route('user.login') }}" method="POST" class="login-form flex flex-col gap-8 hidden">
    @csrf
    <input type="email" placeholder="Email" name="email" autofocus="true" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <input type="password" placeholder="Password" name="password" class="w-full p-2 px-3 border border-[var(--accent)] rounded bg-black text-[var(--accent)]">
    <button class="w-full py-2 border border-[limegreen] text-[limegreen] rounded transition hover:bg-[limegreen] hover:text-black">Log In</button>

    @error ('email-login')
        <div class="py-4 text-sm text-[red]"><span class="font-bold">Error: </span>{{ $message }}</div>
    @enderror
  </form>

</div>


{{-- Switch Tabs Functionality --}}
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
            document.querySelector('.login-form input').focus();
        }
    })
</script>