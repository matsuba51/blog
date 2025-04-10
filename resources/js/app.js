// ハンバーガーメニューのトグル
document.addEventListener('DOMContentLoaded', function() {
  const navbarToggler = document.getElementById('navbar-toggler');
  if (navbarToggler) {
    navbarToggler.addEventListener('click', function() {
      const menu = document.getElementById('navbar-menu');
      menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    });
  }
});

// 日ごとの投稿数
import Chart from 'chart.js/auto';

document.addEventListener("DOMContentLoaded", function () {
    const chartCanvas = document.getElementById("chartCanvas");

    if (chartCanvas) {
        const chartData = JSON.parse(chartCanvas.dataset.chart); // data属性から読み込み
        const ctx = chartCanvas.getContext("2d");

        new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: '日ごとの投稿数',
                        font: { size: 18 },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return '投稿数: ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: { display: true, text: '日付' }
                    },
                    y: {
                        title: { display: true, text: '投稿数' },
                        beginAtZero: true,
                        suggestedMax: 20,
                        ticks: {
                            stepSize: 5,
                            max: 20,
                        }
                    }
                }
            }
        });
    }
});
