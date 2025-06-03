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
<body class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">

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
        <div class="w-1.5 h-6 bg-blue-600 rounded"></div>
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Pendaftaran</h2>
      </div>

      <div class="mb-4">
        <div class="bg-white shadow rounded-lg p-4">
          <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Semua Pendaftar Dari Semua Jurusan</h3>
          <p class="text-2xl sm:text-3xl font-bold text-blue-700">
            {{ number_format($totalPendaftar, 0, ',', '.') }}
          </p>
        </div>
      </div>

      <!-- Pendaftaran 2025 -->
      <div class="mb-10">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-800">Pendaftaran Tahun 2025</h3>
          <a href="{{ route('SPMB.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
            Lihat Semua
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        </div>
        <div class="overflow-x-auto shadow rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white border-b-4 border-blue-500">
              <tr>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Tahun</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jurusan</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Hari Ini</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Kemarin</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($recentPendaftaran2025 ?? [] as $index => $item)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['tahun'] ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['jurusan'] ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ number_format($item['jumlah'] ?? 0, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($item['hari_ini'] ?? 0, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($item['kemarin'] ?? 0, 0, ',', '.') }}</td>
              </tr>
              @endforeach
              @if($sum ?? false)
              <tr class="bg-gray-50 font-semibold">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" colspan="3">Total</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format(array_sum(array_column($recentPendaftaran2025 ?? [], 'jumlah')), 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format(array_sum(array_column($recentPendaftaran2025 ?? [], 'hari_ini')), 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format(array_sum(array_column($recentPendaftaran2025 ?? [], 'kemarin')), 0, ',', '.') }}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

<!-- Pendaftaran 2024 -->
<div class="mb-10">
  <div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-semibold text-gray-800">Pendaftaran Tahun 2024</h3>
    <a href="{{ route('SPMB.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
      Lihat Semua
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </a>
  </div>
  <div class="overflow-x-auto shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-white border-b-4 border-blue-500">
        <tr>
          <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
          <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
          <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Tahun</th>
          <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Total</th>
          <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Hari Ini</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @foreach($recentPendaftaran2024 ?? [] as $index => $item)
        <tr class="hover:bg-gray-50 transition-colors">
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            @php
              // Indonesian month names
              $monthNames = [
                1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
              ];
              $date = new DateTime($item['created_at'] ?? 'now');
              $month = $date->format('n'); // Numeric month without leading zeros
              $day = $date->format('j');   // Day without leading zeros
              echo $day . ' ' . $monthNames[$month]; // Format as "15 Juni"
            @endphp
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['tahun'] ?? '-' }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ number_format($item['jumlah'] ?? 0, 0, ',', '.') }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($item['hari_ini'] ?? 0, 0, ',', '.') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
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

      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Data Wawancara Terbaru</h3>
        <a href="{{ route('wawancara.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
          Lihat Semua
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>
      <div class="overflow-x-auto shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-white border-b-4 border-green-500">
            <tr>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Tahun</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jurusan</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Dinyatakan</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Hari Ini</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Kemarin</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($recentWawancara ?? [] as $index => $item)
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['tahun'] ?? '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['jurusan'] ?? '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item['kondisi'] ?? '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ number_format($item['jumlah'] ?? 0, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($item['hari_ini'] ?? 0, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($item['kemarin'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $color }}">
              {{ ucfirst($status->status_pembayaran) }}
            </span>
            <p class="mt-2 text-2xl sm:text-3xl font-bold text-blue-600">
              {{ number_format($status->total ?? 0, 0, ',', '.') }}
            </p>
          </div>
        @endforeach
      </div>

      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Data Pembayaran Terbaru</h3>
        <a href="{{ route('pembayaran.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
          Lihat Semua
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>
      <div class="overflow-x-auto shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-white border-b-4 border-purple-500">
            <tr>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Tahun</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jurusan</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($recentPembayaran ?? [] as $index => $item)
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['tahun'] ?? '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['jurusan'] ?? '-' }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                @php
                  $statusColor = match(strtolower($item['status_pembayaran'])) {
                    'lunas' => 'bg-green-100 text-green-800',
                    'belum bayar' => 'bg-red-100 text-red-800',
                    'cicil' => 'bg-yellow-100 text-yellow-800',
                    default => 'bg-gray-100 text-gray-800',
                  };
                @endphp
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                  {{ ucfirst($item['status_pembayaran'] ?? '-') }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ number_format($item['jumlah'] ?? 0, 0, ',', '.') }}</td>
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
