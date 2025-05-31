<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - SPMB PENUS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen ">

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



  <!-- Main -->
  <main class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 flex-grow space-y-16">

    @php
    function statistikCard($title, $value, $color = 'text-blue-600') {
        return <<<HTML
        <div class="bg-white shadow-xl rounded-xl p-6 border-l-4 border-blue-500">
          <h3 class="text-sm font-semibold text-gray-600">{$title}</h3>
          <p class="mt-2 text-2xl sm:text-3xl font-bold {$color}">{$value}</p>
        </div>
        HTML;
    }
    @endphp

<!-- PENDAFTARAN -->
<section>
  <div class="mb-6 flex items-center gap-3">
    <div class="w-1.5 h-6 bg-orange-600 rounded"></div>
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Pendaftaran</h2>
  </div>

  <!-- Total Keseluruhan -->
  <div class="mb-4">
    <div class="bg-white shadow rounded-lg p-4">
      <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Semua Pendaftar Dari Semua Jurusan</h3>
      <p class="text-2xl sm:text-3xl font-bold text-blue-700">
        {{ number_format($totalPendaftar, 0, ',', '.') }}
      </p>
    </div>
  </div>

  <!-- Tabel -->
  <div class="overflow-x-auto">
    @include('components.dashboard-table', [
      'title' => 'Data Pendaftaran Terbaru',
      'link' => route('SPMB.index'),
      'headers' => ['No', 'Tahun', 'Jurusan', 'Total Pendaftar', 'Hari Ini', 'Kemarin'],
      'rows' => $recentPendaftaran,
      'cols' => ['tahun', 'jurusan', 'jumlah', 'hari_ini', 'kemarin'],
      'sum' => true
    ])
  </div>
</section>

<!-- WAWANCARA -->
<section>
  <div class="mb-6 flex items-center gap-3">
    <div class="w-1.5 h-6 bg-green-600 rounded"></div>
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Wawancara</h2>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    {!! statistikCard('Total Wawancara Semua Jurusan', number_format($totalWawancara ?? 0, 0, ',', '.')) !!}
    {!! statistikCard('Wawancara Hari Ini Semua Jurusan', number_format($wawancaraHariIni ?? 0, 0, ',', '.'), 'text-green-600') !!}
    {!! statistikCard('Wawancara Kemarin Semua Jurusan', number_format($wawancaraKemarin ?? 0, 0, ',', '.'), 'text-orange-500') !!}
  </div>

  <div class="overflow-x-auto">
    @include('components.dashboard-table', [
      'title' => 'Data Wawancara Terbaru',
      'link' => route('wawancara.index'),
      'headers' => ['No', 'Tahun', 'Jurusan', 'Dinyatakan', 'Jumlah', 'Hari Ini', 'Kemarin'],
      'rows' => $recentWawancara ?? [],
      'cols' => ['tahun', 'jurusan', 'kondisi', 'jumlah', 'hari_ini', 'kemarin'],
      'status' => false,
      'sum' => false,
    ])
  </div>
</section>

<!-- PEMBAYARAN -->
<section>
  <div class="mb-6 flex items-center gap-3">
    <div class="w-1.5 h-6 bg-purple-600 rounded"></div>
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Pembayaran</h2>
  </div>

  {!! statistikCard('Total Pembayaran Semua Jurusan', number_format($totalPembayaran ?? 0, 0, ',', '.')) !!}

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-6">
    @foreach($statusPembayaranStats ?? [] as $status)
      @php
      $color = match(strtolower($status->status_pembayaran)) {
        'lunas' => 'bg-green-100 text-green-800',
        'belum bayar' => 'bg-red-100 text-red-800',
        'cicil' => 'bg-yellow-100 text-yellow-800',
        default => 'bg-gray-100 text-gray-800',
      };
      @endphp
      <div class="bg-white shadow-xl rounded-xl p-6">
        <h3 class="text-sm font-medium text-gray-600 mb-1">Status:</h3>
        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $color }}">
          {{ ucfirst($status->status_pembayaran) }}
        </span>
        <p class="mt-2 text-2xl sm:text-3xl font-bold text-blue-600">
          {{ number_format($status->total ?? 0, 0, ',', '.') }}
        </p>
      </div>
    @endforeach
  </div>

  <div class="overflow-x-auto">
    @include('components.dashboard-table', [
      'title' => 'Data Pembayaran Terbaru',
      'link' => route('pembayaran.index'),
      'headers' => ['No', 'Tahun', 'Jurusan', 'Status Pembayaran', 'Jumlah'],
      'rows' => $recentPembayaran ?? [],
      'cols' => ['tahun', 'jurusan', 'status_pembayaran', 'jumlah'],
      'status' => true,
      'sum' => false,
    ])
  </div>
</section>

</main>

<!-- Footer -->
<footer class="text-center text-sm text-gray-600 mt-6 mb-4 px-4">
  <a href="https://www.smkpluspnb.sch.id/">SMK PLUS PELITA NUSANTARA © 2025 Devaccto IT. <span class="text-blue-600 underline">Powered by PENUS</span></a>
</footer>

</body>
</html>
