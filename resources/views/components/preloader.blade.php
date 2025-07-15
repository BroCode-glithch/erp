<!-- Preloader -->
<div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-500 bg-white">
    <div class="space-x-1 text-5xl font-extrabold text-gray-700 animate-bounce">
        <span class="wave">E</span><span class="delay-100 wave">R</span><span class="delay-200 wave">P</span><span class="delay-300 wave">.</span><span class="delay-400 wave">.</span><span class="delay-500 wave">.</span>
    </div>
</div>

<!-- Preloader Script -->
<script>
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        preloader.classList.add('opacity-0');
        setTimeout(() => preloader.style.display = 'none', 500);
    });
</script>
