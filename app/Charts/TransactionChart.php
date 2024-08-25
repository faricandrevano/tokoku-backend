<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Transaction;
use App\Models\TransactionProduct;

class TransactionChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
        ->setTitle('Diagram Jumlah Penjualan Produk')
        ->setSubtitle('Periode 2023-2024')
        ->addData('Sport', [6, 2, 3, 4, 6, 5,4,6,2,3,3,5])
        ->addData('Hiking', [7, 3, 5, 2, 6, 4,3,6,3,5,4,4])
        ->addData('Training', [5,4,3,5,4,6,4,3,5,3,2,6])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December']);
    }
}
