<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Data Wawancara</title>
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

  <main class="max-w-6xl mx-auto mt-6 bg-white shadow-md rounded p-4">
    <h2 class="text-xl font-semibold mb-4">Tambah Data Wawancara</h2>

    <form action="{{ route('wawancara.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
      @csrf
      <select name="tahun" class="border rounded px-3 py-2 w-full" required>
        <option value="" disabled selected>Pilih Tahun</option>
        <option value="2025">2025</option>
        <option value="2024">2024</option>
      </select>

      <select name="jurusan" class="border rounded px-3 py-2 w-full" required>
        <option value="" disabled selected>Pilih Jurusan</option>
        <option value="RPL">RPL</option>
        <option value="TKJ">TKJ</option>
        <option value="DKV">DKV</option>
        <option value="LPB">LPB</option>
        <option value="TOI">TOI</option>
      </select>

      <select name="kondisi" class="border rounded px-3 py-2 w-full" required>
        <option value="" disabled selected>Dinyatakan</option>
        <option value="Lolos">Lolos</option>
        <option value="Mundur">Mundur</option>
      </select>

      <input type="number" name="jumlah" placeholder="Jumlah Wawancara" class="border rounded px-3 py-2 w-full" min="1" required>
      <input type="number" name="hari_ini" placeholder="Hari Ini" class="border rounded px-3 py-2 w-full" min="0" required>
      <input type="number" name="kemarin" placeholder="Kemarin" class="border rounded px-3 py-2 w-full" min="0" required>

      <div class="sm:col-span-2 md:col-span-3">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded w-full sm:w-auto">
          Tambah
        </button>
      </div>
    </form>

    <section class="mt-8">
      <h2 class="text-lg font-semibold mb-2">Data Tersimpan</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-left border border-gray-300">
          <thead class="bg-gray-200">
            <tr>
              <th class="border px-4 py-2">Tahun</th>
              <th class="border px-4 py-2">Jurusan</th>
              <th class="border px-4 py-2">Dinyatakan</th>
              <th class="border px-4 py-2">Jumlah</th>
              <th class="border px-4 py-2">Hari Ini</th>
              <th class="border px-4 py-2">Kemarin</th>
              <th class="border px-4 py-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($wawancaras as $data)
            <tr>
              <td class="border px-4 py-2">{{ $data->tahun }}</td>
              <td class="border px-4 py-2">{{ $data->jurusan }}</td>
              <td class="border px-4 py-2">{{ $data->kondisi }}</td>
              <td class="border px-4 py-2">{{ $data->jumlah }}</td>
              <td class="border px-4 py-2">{{ $data->hari_ini }}</td>
              <td class="border px-4 py-2">{{ $data->kemarin }}</td>
              <td class="border px-4 py-2">
                <form action="{{ route('wawancara.destroy', ['wawancara' => $data->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="text-center text-sm text-gray-600 mt-6 mb-4 px-4">
    <a href="https://www.smkpluspnb.sch.id/" class="hover:text-blue-600 transition">SMK PLUS PELITA NUSANTARA © 2025 Devaccto IT. <span class="text-blue-600 underline">Powered by PENUS</span></a>
  </footer>
</body>
</html>
