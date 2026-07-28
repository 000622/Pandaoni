@extends('layouts.admin')
@section('title', 'Pesanan - Admin Pandaoni')
@section('page-title', 'Manajemen Pesanan')
@section('page-subtitle', 'Pantau dan proses pesanan pelanggan.')

@section('content')
<form method="GET" class="mb-6">
    <select name="status" onchange="this.form.submit()" class="border rounded px-4 py-2 text-sm">
        <option value="">Semua Status</option>
        @foreach(['pending','paid','processing','shipped','completed','cancelled'] as $s)
            <option value="{{ $s }}" @selected(request('status')==$s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
</form>

<div class="bg-white rounded shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-500 tracking-wide">
            <tr>
                <th class="text-left px-6 py-3">NO. PESANAN</th>
                <th class="text-left px-6 py-3">PELANGGAN</th>
                <th class="text-left px-6 py-3">TOTAL</th>
                <th class="text-left px-6 py-3">STATUS</th>
                <th class="text-left px-6 py-3">TANGGAL</th>
                <th class="text-left px-6 py-3">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($orders as $order)
                <tr>
                    <td class="px-6 py-3 font-medium">{{ $order->order_number }}</td>
                    <td class="px-6 py-3">{{ $order->user->name }}</td>
                    <td class="px-6 py-3">{{ $order->formatted_total }}</td>
                    <td class="px-6 py-3">
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-xs">
                                @foreach(['pending','paid','processing','shipped','completed','cancelled'] as $s)
                                    <option value="{{ $s }}" @selected($order->status==$s)>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-3">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-3"><a href="#" class="underline text-xs">Detail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $orders->links() }}</div>
@endsection
