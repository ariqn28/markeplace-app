@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pesanan #{{ $order->id }}</h2>

    <p><strong>Status:</strong> {{ $order->status }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <p><strong>Tanggal Order:</strong> {{ $order->order_date }}</p>

    <h4>Produk yang Dibeli:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
</div>
@endsection