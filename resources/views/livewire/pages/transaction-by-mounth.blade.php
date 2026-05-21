<div class="p-1 rounded-sm h-full">
    <div class="flex items-center justify-between mb-3 p-3">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-50 flex items-center gap-2">
            Transactions par mois
        </h2>

        <span class="text-xs text-gray-500 dark:text-gray-400">
            Vue analytique
        </span>
    </div>

    <div class="relative h-[90%] flex justify-center items-center">
        <canvas id="moneyChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let moneyChartInstance = null;

document.addEventListener('livewire:init', () => {

    const months = @json($months);
    const totals = @json($totals);

    const ctx = document.getElementById('moneyChart');

    if (!ctx) return;

    // 🔥 Détruire ancien chart si Livewire re-render
    if (moneyChartInstance) {
        moneyChartInstance.destroy();
    }

    moneyChartInstance = new Chart(ctx, {
        type: 'doughnut', // 🔥 CHANGÉ ICI
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

            // 🔥 trou du doughnut
            cutout: '65%',

            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1400,
                easing: 'easeOutQuart'
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