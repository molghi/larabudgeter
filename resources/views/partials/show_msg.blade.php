@if (session('success'))
    <div class="success-msg py-2 px-4 text-[limegreen] border border-[limegreen] rounded absolute top-[15px] transition left-[50%] opacity-0 -translate-y-[100px] -translate-x-1/2 transform">
        {{ session('success') }}
    </div>

    <script>
        // show success msg nicely and then hide
        const successMsg = document.querySelector('.success-msg');
        setTimeout(() => {
            successMsg.classList.remove('opacity-0');
            successMsg.classList.remove('-translate-y-[100px]');
        }, 300)
        setTimeout(() => {
            successMsg.classList.add('opacity-0');
            successMsg.classList.add('-translate-y-[100px]');
        }, 5000)
        setTimeout(() => { successMsg.remove(); }, 5500)
    </script>
@endif