<script>
document.addEventListener('livewire:init', () => {

    const data = @json($chartData);

    const labels = Object.keys(data);
    const values = Object.values(data);

    const ctx = document.getElementById('moneyChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Transactions par faculté',
                data: values,
                backgroundColor: [
                    'rgba(52, 152, 219, 0.7)',
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(155, 89, 182, 0.7)',
                    'rgba(241, 196, 15, 0.7)',
                    'rgba(231, 76, 60, 0.7)',
                    'rgba(26, 188, 156, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

});
</script>