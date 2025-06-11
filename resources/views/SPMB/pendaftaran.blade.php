<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Data Pendaftaran - Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
      <h1 class="text-xl sm:text-2xl font-bold text-gray-900">SMK PLUS PELITA NUSANTARA</h1>
    </div>
  </header>

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-blue-700 to-indigo-700 shadow overflow-x-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex space-x-4 py-3 min-w-max">
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
             class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-white hover:text-blue-700 transition whitespace-nowrap">
            {{ $item['label'] }}
          </a>
        @endforeach
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto mt-6 bg-white shadow-md rounded p-4 flex-grow">
    <h2 class="text-xl font-semibold mb-4">Tambah Data Pendaftaran</h2>

<!-- Form wrapper dengan dynamic styling -->
<div id="form-wrapper" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-4 transition-all">
  <form action="{{ route('siswa.store') }}" method="POST" class="contents">
    @csrf

    <!-- Tahun -->
    <div class="col-span-6 sm:col-span-3 md:col-span-2">
      <select id="tahun" name="tahun" class="border rounded px-2 py-1 w-full" required>
        <option value="" disabled selected>Pilih Tahun</option>
        <option value="2025">2025</option>
        <option value="2024">2024</option>
      </select>
    </div>

    <!-- Jurusan -->
    <div class="col-span-6 sm:col-span-3 md:col-span-2">
      <select id="jurusan" name="jurusan" class="border rounded px-2 py-1 w-full" required>
        <option value="" disabled selected>Pilih Jurusan</option>
        <option value="RPL">RPL</option>
        <option value="TKJ">TKJ</option>
        <option value="DKV">DKV</option>
        <option value="LPB">LPB</option>
        <option value="TOI">TOI</option>
      </select>
    </div>

    <!-- Jumlah -->
    <div class="col-span-6 sm:col-span-3 md:col-span-1">
      <input type="number" name="jumlah" placeholder="Total Pendaftar" class="border rounded px-2 py-1 w-full" min="1" required />
    </div>

    <!-- Hari Ini -->
    <div class="col-span-6 sm:col-span-3 md:col-span-1">
      <input type="number" name="hari_ini" placeholder="Hari Ini" class="border rounded px-2 py-1 w-full" min="0" required />
    </div>

    <!-- Kemarin -->
    <div class="col-span-6 sm:col-span-3 md:col-span-2">
      <input type="number" id="kemarin" name="kemarin" placeholder="Kemarin" class="border rounded px-2 py-1 w-full" min="0" required />
    </div>

    <!-- Tombol Submit -->
    <div class="col-span-6">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full sm:w-auto">Tambah</button>
    </div>

    <!-- Peringatan Tahun 2024 -->
    <div id="warning-2024" class="col-span-6 text-red-700 font-semibold hidden">
      ⚠ Tahun 2024: Jurusan & Kemarin dinonaktifkan (tidak perlu diisi).
    </div>
  </form>
</div>



    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="mt-4 text-green-600 font-medium">
        {{ session('success') }}
      </div>
    @endif

    <!-- Tabel -->
    <section class="mt-8 overflow-x-auto">
      <h2 class="text-lg font-semibold mb-2">Data Tersimpan</h2>
      <table class="table-auto w-full text-left border border-gray-300 min-w-[600px]">
        <thead class="bg-gray-200">
          <tr>
            <th class="border px-2 py-1">Tahun</th>
            <th class="border px-2 py-1">Jurusan</th>
            <th class="border px-2 py-1">Total Pendaftar</th>
            <th class="border px-2 py-1">Hari Ini</th>
            <th class="border px-2 py-1">Kemarin</th>
            <th class="border px-2 py-1">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data_siswa as $item)
            <tr>
              <td class="border px-2 py-1">{{ $item->tahun }}</td>
              <td class="border px-2 py-1">{{ $item->jurusan }}</td>
              <td class="border px-2 py-1">{{ $item->jumlah }}</td>
              <td class="border px-2 py-1">{{ $item->hari_ini }}</td>
              <td class="border px-2 py-1">{{ $item->kemarin }}</td>
              <td class="border px-2 py-1">
                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-2">Belum ada data.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-600 mt-6 mb-4 px-4">
      <a href="https://www.smkpluspnb.sch.id/" class="hover:text-blue-600 transition">
        SMK PLUS PELITA NUSANTARA © 2025 Devaccto IT. <span class="text-blue-600 underline">Powered by PENUS</span>
      </a>
    </footer>
  </main>

  <!-- Script -->
  <script>
    const tahunSelect = document.getElementById('tahun');
    const jurusanSelect = document.getElementById('jurusan');
    const kemarinInput = document.getElementById('kemarin');
    const warning2024 = document.getElementById('warning-2024');

    function toggleFields() {
      const is2024 = tahunSelect.value === '2024';

      jurusanSelect.disabled = is2024;
      kemarinInput.disabled = is2024;

      warning2024.classList.toggle('hidden', !is2024);
    }

    tahunSelect.addEventListener('change', toggleFields);
    window.addEventListener('load', toggleFields);
  </script>

</body>
</html>
