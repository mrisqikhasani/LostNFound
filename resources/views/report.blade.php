@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Barang Temuan</h1>

<div class="overflow-x-auto bg-white p-4 rounded shadow">
    <table id="reportsTable" class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left font-medium">Foto</th>
                <th class="px-4 py-2 text-left font-medium">Nama barang temuan</th>
                <th class="px-4 py-2 text-left font-medium">Lokasi</th>
                <th class="px-4 py-2 text-left font-medium">Region Kampus</th>
                <th class="px-4 py-2 text-left font-medium">Tanggal Ditemukan</th>
                <th class="px-4 py-2 text-left font-medium">Status</th>
                <th class="px-4 py-2 text-left font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach ($reports as $report)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">
                        <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto" class="h-16 w-16 object-cover rounded">
                    </td>
                    <td class="px-4 py-2 font-semibold">
                        {{ $report->nama_barang_temuan }}
                    </td>
                    <td>{{ $report->lokasi_temuan }}</td>
                    <td>{{ $report->region_kampus }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->waktu_ditemukan)->format('d M Y H:i') }}</td>
                    <td>
                        @if($report->status === 'waiting')
                            <span class="text-yellow-500 font-semibold">Waiting</span>
                        @elseif($report->status === 'claimed')
                            <span class="text-green-500 font-semibold">Claimed</span>
                        @else
                            <span class="text-gray-500">{{ ucfirst($report->status) }}</span>
                        @endif
                    </td>
                    <td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#reportsTable').DataTable({
            responsive: true,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ data",
                info: "Show _START_ until _END_ of _TOTAL_ data",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                },
                zeroRecords: "Data tidak ditemukan",
            }
        });
    });
</script>
@endsection
