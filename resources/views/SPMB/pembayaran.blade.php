<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Pembayaran - SPMB</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Header -->
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
      <h1 class="text-2xl font-bold text-gray-900">SMK PLUS PELITA NUSANTARA</h1>
    </div>
  </header>

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-blue-700 to-indigo-700 shadow overflow-x-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex space-x-4 py-3">
        @php
        $nav = [
          ['label' => 'Home', 'route' => 'dashboard'],
          ['label' => 'Pendaftaran', 'route' => 'SPMB.pendaftaran'],
          ['label' => 'Wawancara', 'route' => 'wawancara.index'],
          ['label' => 'Pembayaran', 'route' => 'pembayaran.index'],
        ];
        @endphp
        @foreach($nav as $item)
          <a href="{{ route($item['route']) }}"
             class="text-white whitespace-nowrap px-4 py-2 rounded-md text-sm font-medium hover:bg-white hover:text-blue-700 transition">
            {{ $item['label'] }}
          </a>
        @endforeach
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto mt-6 bg-white shadow-md rounded p-4">
    <h2 class="text-xl font-semibold mb-4">Tambah Data Pembayaran</h2>

    <form action="{{ route('pembayaran.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
      @csrf
      <select name="tahun" class="border rounded px-2 py-1 w-full" required>
        <option value="" disabled selected>Pilih Tahun</option>
        <option value="2025">2025</option>
        <option value="2024">2024</option>
      </select>

      <select name="jurusan" class="border rounded px-2 py-1 w-full" required>
        <option value="" disabled selected>Pilih Jurusan</option>
        <option value="RPL">RPL</option>
        <option value="TKJ">TKJ</option>
        <option value="DKV">DKV</option>
        <option value="LPB">LPB</option>
        <option value="TOI">TOI</option>
      </select>

      <select name="status_pembayaran" class="border rounded px-2 py-1 w-full" required>
        <option value="" disabled selected>Status Pembayaran</option>
        <option value="Lunas">Lunas</option>
        <option value="Cicil">Cicil</option>
        <option value="Belum Bayar">Belum Bayar</option>
      </select>

      <input type="number" name="jumlah" placeholder="Jumlah Siswa" class="border rounded px-2 py-1 w-full" min="1" required />

      <div class="md:col-span-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full">Tambah</button>
      </div>
    </form>

    @if(session('success'))
      <div class="mt-4 text-green-600 font-medium">
        {{ session('success') }}
      </div>
    @endif

    <section class="mt-8">
      <h2 class="text-lg font-semibold mb-2">Data Tersimpan</h2>
      <div class="overflow-x-auto">
        <table class="table-auto w-full text-left border border-gray-300">
          <thead class="bg-gray-200">
            <tr>
              <th class="border px-2 py-1">Tahun</th>
              <th class="border px-2 py-1">Jurusan</th>
              <th class="border px-2 py-1">Status Pembayaran</th>
              <th class="border px-2 py-1">Jumlah</th>
              <th class="border px-2 py-1">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data_pembayaran as $item)
              <tr>
                <td class="border px-2 py-1">{{ $item->tahun }}</td>
                <td class="border px-2 py-1">{{ $item->jurusan }}</td>
                <td class="border px-2 py-1">{{ $item->status_pembayaran }}</td>
                <td class="border px-2 py-1">{{ $item->jumlah }}</td>
                <td class="border px-2 py-1">
                  <form action="{{ route('pembayaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-2">Belum ada data.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="text-center text-sm text-gray-600 mt-6 mb-4">
    <a href="https://www.smkpluspnb.sch.id/">SMK PLUS PELITA NUSANTARA © 2025 Devaccto IT. <span class="text-blue-600 underline">Powered by PENUS</span></a>
  </footer>
</body>
</html>
