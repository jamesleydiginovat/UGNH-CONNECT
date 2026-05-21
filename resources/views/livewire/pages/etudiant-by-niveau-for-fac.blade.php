<script>
document.addEventListener('livewire:init', () => {

    const data = @json($data);

    const labels = Object.keys(data);   // ["Niveau 1", "Niveau 2", ...]
    const values = Object.values(data); // [12, 8, ...]

    const ctx = document.getElementById('moneyChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Étudiants par niveau',
                data: values,
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