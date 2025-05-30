<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pembayaran - SPMB</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <header class="bg-white shadow p-4">
    <h1 class="text-2xl font-bold text-center">SMK PLUS PELITA NUSANTARA</h1>
  </header>

<nav class="bg-blue-700 text-white shadow-md">
  <div class="max-w-7xl mx-auto px-4 py-3">
    <ul class="flex flex-wrap justify-center gap-4 text-center md:text-base">
      <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
      <li><a href="{{ route('SPMB.pendaftaran') }}" class="hover:underline">Pendaftaran</a></li>
      <li><a href="{{ route('wawancara.index') }}" class="hover:underline">Wawancara</a></li>
      <li><a href="{{ route('pembayaran.index') }}" class="hover:underline">Pembayaran</a></li>
    </ul>
  </div>
</nav>

<main class="max-w-5xl mx-auto mt-6 bg-white shadow-md rounded p-4">
  <h2 class="text-xl font-semibold mb-4">Tambah Data Pembayaran</h2>

  <form action="{{ route('pembayaran.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
    @csrf
    <select name="tahun" class="border rounded px-2 py-1" required>
      <option value="" disabled selected>Pilih Tahun</option>
      <option value="2025">2025</option>
      <option value="2024">2024</option>
    </select>

    <select name="jurusan" class="border rounded px-2 py-1" required>
      <option value="" disabled selected>Pilih Jurusan</option>
      <option value="RPL">RPL</option>
      <option value="TKJ">TKJ</option>
      <option value="DKV">DKV</option>
      <option value="LPB">LPB</option>
      <option value="TOI">TOI</option>
    </select>

    <select name="status_pembayaran" class="border rounded px-2 py-1" required>
      <option value="" disabled selected>Status Pembayaran</option>
      <option value="Lunas">Lunas</option>
      <option value="Cicil">Cicil</option>
      <option value="Belum Bayar">Belum Bayar</option>
    </select>

    <input type="number" name="jumlah" placeholder="Jumlah Siswa" class="border rounded px-2 py-1" min="1" required />

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah</button>
  </form>

  @if(session('success'))
    <div class="mt-4 text-green-600 font-medium">
      {{ session('success') }}
    </div>
  @endif

  <section class="mt-8">
    <h2 class="text-lg font-semibold mb-2">Data Tersimpan</h2>
    <table class="table-auto w-full text-left border border-gray-300">
      <thead class="bg-gray-200">
        <tr>
          <th class="border px-2 py-1">Tahun</th>
          <th class="border px-2 py-1">Jurusan</th>
          <th class="border px-2 py-1">Status</th>
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
                <button class="text-red-600">Hapus</button>
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
  </section>
</main>
