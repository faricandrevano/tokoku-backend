<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
			text-align: center;
		}
		footer {
            background-color: #333;
            color: white;
            padding: 1px 1px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
	</style>
	<center>
		<div style="display: flex;">
			<div style="float: left;">
				<img src="data:image/png;base64,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" width="100px">
			</div>
			<h3>TokoKu</h3>
			<h6>Mekarsari Raya JL. KH. Mochammad, Mekarsari - Tambun Selatan</h6>
			<h6>Kabupaten Bekasi Jawa Barat 17510</h6>
			<h6>Telepon (021) 8832404, Fax (021) 88323429</h6>
		</div>
		<span style="width: 100%;height: 2px;background-color: black; display: block"></span>
		<br><br>
		
		{{-- <h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5> --}}
	</center>
	<div>
		<h6>Tanggal Cetak Laporan : {{date('d M Y')}}</h6>
		<h4 style="text-align: center">LAPORAN REKAPITULASI TRANSAKSI</h4>
	</div>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th style="background-color: rgb(190, 190, 190);">No</th>
				<th style="background-color: rgb(190, 190, 190);">Code</th>
                <th style="background-color: rgb(190, 190, 190);">Product</th>
                <th style="background-color: rgb(190, 190, 190);">Address</th>
                <th style="background-color: rgb(190, 190, 190);">Total Price</th>
                <th style="background-color: rgb(190, 190, 190);">User</th>
                <th style="background-color: rgb(190, 190, 190);">Status</th>
                <th style="background-color: rgb(190, 190, 190);">Created At</th>
				{{-- <th>Pekerjaan</th> --}}
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($transactions as $item)
			<tr>
				<td>{{ $loop->iteration }}</td>
                                        <th>
                                            {{ $item->code }}
                                        </th>
                                        <td >
                                            <ol>
                                                @foreach ($item->products as $product)
                                                    <li>
                                                        <span>{{ $product->product->name }}</span>
                                                        with <span>{{ $product->qty }}</span>
                                                        item
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>{{ $item->address }}</td>
                                        <td>Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td>{{ $item->user->name }}</td>
										<td>
                                            @if ($item->status === 'CONFIRMED' || $item->status === 'PROGRESS' || $item->status === 'WAITING')
                                                <div>
                                                    <span></span>
                                                    {{ $item->status }}
                                                </div>
                                            @elseif ($item->status === 'SUCCESS')
                                                <div>
                                                    <span></span>
                                                    {{ $item->status }}
                                                </div>
                                            @else
                                                <div></span>
                                                    {{ $item->status }}
                                                </div>
                                            @endif
                                        </td>
										<td>{{ $item->created_at }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<div style="text-align: right;">
		<p style="transform: translateX(-35px)">kepala Divisi Produk</p>
		<br><br><br>
		<p>{Faric Andrevano Sidharta}</p>
	</div>
	
	<div style="width: 100%;height: 2px;background-color: black; display: block">
    </div>
	<div style="text-align: left">Divisi Produk</div>
	<div style="text-align: right; transform: translateY(-22px)">Page 1 of 1</div>
</body>
</html>