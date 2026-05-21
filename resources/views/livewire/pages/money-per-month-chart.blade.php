<div class="p-1 rounded-sm   h-full">
    <h2 class="text-lg font-semibold mb-2 dark:text-gray-50">
        Transactions par mois
    </h2>

    <div class="relative h-[90%] flex justify-center items-center">
        <canvas id="moneyChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('livewire:init', () => {

    const months = @json($months);
    const totals = @json($totals);

    const ctx = document.getElementById('moneyChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: months,
            datasets: [{
                label: 'Total transactions',
                data: totals,
                backgroundColor: [
                    'rgba(52, 152, 219, 0.7)',
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(155, 89, 182, 0.7)',
                    'rgba(241, 196, 15, 0.7)',
                    'rgba(231, 76, 60, 0.7)',
                    'rgba(26, 188, 156, 0.7)',
                    'rgba(52, 73, 94, 0.7)',
                    'rgba(230, 126, 34, 0.7)',
                    'rgba(149, 165, 166, 0.7)',
                    'rgba(41, 128, 185, 0.7)',
                    'rgba(39, 174, 96, 0.7)',
                    'rgba(142, 68, 173, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,

            // 🔥 ANIMATION AJOUTÉE
            animation: {
                animateRotate: true,      // rotation du pie
                animateScale: true,       // effet de zoom au chargement
                duration: 1400,           // durée animation
                easing: 'easeOutQuart'    // fluidité
            },

            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

});
</script>