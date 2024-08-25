<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransactionChart1
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
        ->setTitle('Diagram Penjualan Produk')
        ->setSubtitle('Periode 2023-2024')
        ->addData('Sport', [20000,30000,45000,65000,75000,35000,55000,60000,80000,90000,80000,60000])
        ->addData('Hiking', [40000,54000,35000,55000,45000,75000,55000,80000,30000,60000,86000,60000])
        ->addData('Training', [80000,37000,55000,59000,87000,45000,35000,55000,40000,76000,55000,60000])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December']);
    }
}
