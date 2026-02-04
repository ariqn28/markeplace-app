import './bootstrap';
import { renderProdukChart, renderOrderChart } from './chart';

// Ambil data dari Blade (window global)
document.addEventListener('DOMContentLoaded', () => {
    if (window.categoryNames && window.productCounts) {
        renderProdukChart(window.categoryNames, window.productCounts);
    }
    if (window.orderCategoryNames && window.orderCounts) {
        renderOrderChart(window.orderCategoryNames, window.orderCounts);
    }
});
