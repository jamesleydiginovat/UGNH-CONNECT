<div class="w-full h-full bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-5">

    <!-- HEADER -->
    <div class="flex items-start justify-between mb-6">

        <div class="flex items-center gap-4">

            <!-- ICON -->
            <div class="w-14 h-14 rounded-2xl bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-indigo-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 13h4v8H3zm7-6h4v14h-4zm7-4h4v18h-4z"/>
                </svg>

            </div>

            <!-- TITLE -->
            <div>

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Cours par niveau
                </h2>

                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    Répartition du nombre de cours par niveau
                </p>

            </div>

        </div>

        <!-- MENU -->
        <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="currentColor"
                viewBox="0 0 24 24">

                <path d="M12 7a2 2 0 110-4 2 2 0 010 4zm0 7a2 2 0 110-4 2 2 0 010 4zm0 7a2 2 0 110-4 2 2 0 010 4z"/>
            </svg>

        </button>

    </div>

    <!-- CHART -->
    <div class="relative h-[500px]">

        <canvas id="courseChart"></canvas>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('livewire:init', () => {

    const rawData = @json($data);

    /*
    |--------------------------------------------------------------------------
    | Transformer les labels
    |--------------------------------------------------------------------------
    */

    const labels = Object.keys(rawData).map(item => `Niveau:${item}`);

    const values = Object.values(rawData);

    /*
    |--------------------------------------------------------------------------
    | Canvas
    |--------------------------------------------------------------------------
    */

    const canvas = document.getElementById('courseChart');

    if (!canvas) return;

    /*
    |--------------------------------------------------------------------------
    | Destroy ancien chart
    |--------------------------------------------------------------------------
    */

    if (window.courseChartInstance) {
        window.courseChartInstance.destroy();
    }

    /*
    |--------------------------------------------------------------------------
    | Couleurs pastel modernes
    |--------------------------------------------------------------------------
    */

    const borderColors = [
        '#ff6384',
        '#ff9f40',
        '#ffcd56',
        '#4bc0c0',
        '#36a2eb',
        '#9966ff',
        '#c9cbcf'
    ];

    const backgroundColors = [
        'rgba(255,99,132,0.18)',
        'rgba(255,159,64,0.18)',
        'rgba(255,205,86,0.18)',
        'rgba(75,192,192,0.18)',
        'rgba(54,162,235,0.18)',
        'rgba(153,102,255,0.18)',
        'rgba(201,203,207,0.18)'
    ];

    /*
    |--------------------------------------------------------------------------
    | Plugin labels au dessus des barres
    |--------------------------------------------------------------------------
    */

    const valuePlugin = {

        id: 'valuePlugin',

        afterDatasetsDraw(chart) {

            const { ctx } = chart;

            chart.data.datasets.forEach((dataset, i) => {

                const meta = chart.getDatasetMeta(i);

                meta.data.forEach((bar, index) => {

                    const value = dataset.data[index];

                    ctx.fillStyle = '#374151';

                    ctx.font = 'bold 14px sans-serif';

                    ctx.textAlign = 'center';

                    ctx.fillText(
                        value,
                        bar.x,
                        bar.y - 10
                    );
                });
            });
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Chart
    |--------------------------------------------------------------------------
    */

    window.courseChartInstance = new Chart(canvas, {

        type: 'bar',

        data: {

            labels: labels,

            datasets: [{

                label: 'Nombre de cours',

                data: values,

                backgroundColor: backgroundColors,

                borderColor: borderColors,

                borderWidth: 2,

                borderRadius: 0,

                maxBarThickness: 70
            }]
        },

        plugins: [valuePlugin],

        options: {

            responsive: true,

            maintainAspectRatio: false,

            animation: {
                duration: 1200
            },

            plugins: {

                legend: {

                    position: 'top',

                    labels: {

                        color: '#4B5563',

                        font: {
                            size: 14
                        },

                        boxWidth: 50
                    }
                },

                tooltip: {

                    backgroundColor: '#111827',

                    titleColor: '#ffffff',

                    bodyColor: '#ffffff',

                    padding: 12,

                    cornerRadius: 8
                }
            },

            scales: {

                x: {

                    grid: {

                        color: 'rgba(0,0,0,0.06)',

                        borderDash: [5, 5]
                    },

                    ticks: {

                        color: '#374151',

                        font: {
                            size: 14
                        }
                    }
                },

                y: {

                    beginAtZero: true,

                    grid: {

                        color: 'rgba(0,0,0,0.08)',

                        borderDash: [5, 5]
                    },

                    ticks: {

                        precision: 0,

                        color: '#6B7280',

                        font: {
                            size: 13
                        }
                    }
                }
            }
        }
    });

});
</script>