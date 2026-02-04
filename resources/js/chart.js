import Chart from 'chart.js/auto';

/**
 * Render grafik produk per kategori (bar chart)
 * @param {Array} categoryNames - label kategori
 * @param {Array} productCounts - jumlah produk per kategori
 */
export function renderProdukChart(categoryNames = [], productCounts = []) {
    const ctx = document.getElementById('chartProduk');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: categoryNames,
            datasets: [{
                label: 'Jumlah Produk',
                data: productCounts,
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Distribusi Produk per Kategori' }
            },
            scales: { y: { beginAtZero: true } }
        }
    });
}

/**
 * Render grafik order per kategori (pie chart)
 * @param {Array} orderCategoryNames - label kategori order
 * @param {Array} orderCounts - jumlah order per kategori
 */
export function renderOrderChart(orderCategoryNames = [], orderCounts = []) {
    const ctx = document.getElementById('chartOrder');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: orderCategoryNames,
            datasets: [{
                label: 'Jumlah Order',
                data: orderCounts,
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(34, 197, 94, 0.7)',
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(234, 179, 8, 0.7)',
                    'rgba(168, 85, 247, 0.7)'
                ],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'right' },
                title: { display: true, text: 'Distribusi Order per Kategori' }
            }
        }
    });
}
