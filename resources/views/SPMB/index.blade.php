<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SPMB PENUS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
  <div class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900">SMK PLUS PELITA NUSANTARA</h1>
      </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-blue-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-8">
          <a href="{{ route('dashboard') }}" class="bg-blue-800 text-white px-3 py-2 text-sm font-medium">Home</a>
          <a href="{{ route('SPMB.pendaftaran') }}" class="text-white px-3 py-2 text-sm font-medium">Pendaftaran</a>
          <a href="{{ route('wawancara.index') }}" class="text-white px-3 py-2 text-sm font-medium">Wawancara</a>
          <a href="#" class="text-white px-3 py-2 text-sm font-medium">Pembayaran</a>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
      <!-- Statistik Utama -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900">Total Pendaftar</h3>
          <p class="mt-2 text-3xl font-bold text-blue-600">
            {{ number_format($totalPendaftar, 0, ',', '.') }}
          </p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900">Pendaftar Hari Ini</h3>
          <p class="mt-2 text-3xl font-bold text-green-600">
            {{ number_format($pendaftarHariIni, 0, ',', '.') }}
          </p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900">Pendaftar Kemarin</h3>
          <p class="mt-2 text-3xl font-bold text-orange-600">
            {{ number_format($pendaftarKemarin, 0, ',', '.') }}
          </p>
        </div>
      </div>

      <!-- Tabel Ringkasan -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">Data Pendaftaran Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jurusan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hari Ini</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kemarin</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($recentPendaftaran as $index => $data)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->tahun }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->jurusan }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($data->hari_ini, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($data->kemarin, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                  {{ number_format($data->hari_ini + $data->kemarin, 0, ',', '.') }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
          </a>
        </div>
      </div>
    </main>


    <footer class="bg-white border-t border-gray-200 mt-8">
      <div class="max-w-7xl mx-auto px-4 py-4 text-center text-sm text-gray-500">
        PENUS © 2025 Devaccto IT. <span class="text-blue-600 underline">Powered by PENUS</span>
      </div>
    </footer>
  </div>
</body>
</html>
