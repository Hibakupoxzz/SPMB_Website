<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - SPMB SMK PLUS PELITA NUSANTARA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <header class="bg-white shadow p-4">
    <h1 class="text-2xl font-bold">SMK PLUS PELITA NUSANTARA</h1>
  </header>

  <nav class="bg-blue-700 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3">
      <ul class="flex flex-wrap gap-4 text-sm md:text-base">
        <li><a href="{{ route('SPMB.index') }}" class="hover:underline">Home</a></li>
        <li><a href="{{ route('SPMB.pendaftaran') }}" class="hover:underline">Pendaftaran</a></li>
        <li><a href="{{ route('wawancara.index') }}" class="hover:underline">Wawancara</a></li>
        <li><a href="#" class="hover:underline">Diterima</a></li>
        <li><a href="#" class="hover:underline">Pembayaran</a></li>
        <li><a href="#" class="hover:underline">Lunas</a></li>
        <li><a href="#" class="hover:underline">Cicil</a></li>
        <li><a href="#" class="hover:underline">Belum Bayar</a></li>
        <li><a href="#" class="hover:underline">Mundur</a></li>
        <li><a href="#" class="hover:underline">Siswa</a></li>
      </ul>
    </div>
  </nav>

  <main class="p-4 max-w-5xl mx-auto">
    <h2 class="text-xl font-semibold mt-4 mb-4">Data Pendaftar</h2>
    <table class="table-auto w-full text-left border border-gray-300">
      <thead class="bg-gray-200">
        <tr>
          <th rowspan="2" class="border px-2 py-1">Jurusan</th>
          <th rowspan="2" class="border px-2 py-1">TOTAL</th>
          <th rowspan="2" class="border px-2 py-1">HARI INI</th>
          <th rowspan="2" class="border px-2 py-1">KEMARIN</th>
          <th colspan="2" class="border px-2 py-1 text-center">2025</th>
          <th colspan="2" class="border px-2 py-1 text-center">2024</th>
        </tr>
        <tr>
          <th class="border px-2 py-1">TOTAL</th>
          <th class="border px-2 py-1">HARI INI</th>
          <th class="border px-2 py-1">TOTAL</th>
          <th class="border px-2 py-1">HARI INI</th>
        </tr>
      </thead>
      <tbody>
        <tr class="bg-white">
          <td class="border px-2 py-1 font-semibold">Semua Jurusan</td>
          <td class="border px-2 py-1">{{ $jumlahPendaftaran }}</td>
          <td class="border px-2 py-1">{{ $pendaftaranHariIni }}</td>
          <td class="border px-2 py-1">{{ $pendaftaranKemarin }}</td>
          <td class="border px-2 py-1">{{ $pendaftaran2025 }}</td>
          <td class="border px-2 py-1">{{ $pendaftaran2025HariIni }}</td>
          <td class="border px-2 py-1">{{ $pendaftaran2024 }}</td>
          <td class="border px-2 py-1">{{ $pendaftaran2024HariIni }}</td>
        </tr>

        @foreach($perJurusan as $jurusan)
        <tr class="bg-gray-50">
          <td class="border px-2 py-1">{{ $jurusan->jurusan }}</td>
          <td class="border px-2 py-1">{{ $jurusan->total }}</td>
          <td class="border px-2 py-1">-</td>
          <td class="border px-2 py-1">-</td>
          <td class="border px-2 py-1">-</td>
          <td class="border px-2 py-1">-</td>
          <td class="border px-2 py-1">-</td>
          <td class="border px-2 py-1">-</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </main>

  <footer class="text-center text-sm text-gray-600 mt-6 mb-4">
    PENUS © 2025 Devaccto IT. <span class="text-blue-600 underline">Powered by PENUS</span>
  </footer>
</body>
</html>
