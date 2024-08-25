<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\TransactionChart;
use App\Charts\TransactionChart1;
use PDF;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index(TransactionChart $transactionChart,TransactionChart1 $transactionChart1) {
        $transaksi = Transaction::all();
        return view('pages.report.index',['chart'=>$transactionChart->build(),'chart1'=>$transactionChart1->build(),'title' =>'Laporan Admin','transactions' => $transaksi]);
    }
    public function generate() {
        $transaksi = Transaction::all();
        $pdf = PDF::loadview('pages.report.generate', ['transactions'=>$transaksi]);
        return $pdf->download('laporan-transaksi.pdf');
    }
    public function lihat() {
        $transaksi = Transaction::all();
        return view('pages.report.generate',['transactions'=>$transaksi]);
    }
}
