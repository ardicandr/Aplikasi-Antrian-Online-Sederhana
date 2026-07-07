<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Panel Antrian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-10 text-right">
                    <form action="{{ route('queue.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded shadow">
                            + Tambah Antrian Baru
                        </button>
                    </form>
                </div>

                <div class="text-center mb-12">
                    <h3 class="text-lg font-medium text-gray-500 uppercase tracking-widest">Sedang Dipanggil</h3>
                    <div class="text-8xl font-black text-blue-600 my-4">
                        {{ $current ? $current->queue_number : '-' }}
                    </div>
                    
                    <div class="flex justify-center gap-4 mt-6">
     
                        <form action="{{ route('queue.prev') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg transition">
                                PREV (Kembali)
                            </button>
                        </form>

    
                        <form action="{{ route('queue.next') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-800 text-white font-bold py-3 px-10 rounded-lg shadow-lg transition">
                                NEXT (Panggil Selanjutnya)
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-10 border-gray-100">

  
                <h3 class="text-lg font-bold mb-4 text-gray-700">Daftar Tunggu (Waiting List)</h3>
                <div class="overflow-hidden border rounded-lg">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase">No. Antrian</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase">Waktu Ambil</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($list as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-4 font-bold text-gray-800">{{ $item->queue_number }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">{{ $item->created_at->format('H:i:s') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-10 px-4 text-center text-gray-400 italic">Tidak ada antrian menunggu.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>