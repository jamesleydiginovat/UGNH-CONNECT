{{-- <div class=" p-1 rounded-sm shadow-lg">
    <h2 class="text-lg font-semibold mb-1">Cours par faculté</h2>

    <canvas id="courseChart"></canvas>
</div> --}}

<div class="p-1  rounded-sm shadow-lg h-full ">
    <h2 class="text-lg font-semibold mb-2 dark:text-gray-50 ms-5">Cours par faculté</h2>

    <div class="relative h-[85%]">
        <canvas id="courseChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('livewire:init', () => {

    const data = @json($data);

    const ctx = document.getElementById('courseChart');

    if (!ctx) {
        console.log('Canvas introuvable');
        return;
    }

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(data),
            datasets: [{
                label: 'Nombre de cours',
                data: Object.values(data),
            }]
        },
        options: {
    responsive: true,
    maintainAspectRatio: false,
    layout: {
        padding: {
            left: 20,   // 🔥 espace pour les chiffres Y
            right: 10,
            top: 10,
            bottom: 10
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                padding: 10,
                font: {
                    size: 10
                }
            }
        }
    }
}
    });

});
</script>


