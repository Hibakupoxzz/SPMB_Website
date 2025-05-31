<div class="bg-white shadow-xl rounded-xl overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-900">{{ $title }}</h2>
    @isset($link)
      <a href="{{ $link }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
    @endisset
  </div>

  <div class="overflow-auto">
    <table class="min-w-full text-sm text-left divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          @foreach ($headers as $header)
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase whitespace-nowrap">
              {{ $header }}
            </th>
          @endforeach
          @if(isset($sum) && $sum)
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Total</th>
          @endif
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-100">
        @foreach ($rows as $index => $row)
          <tr>
            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">{{ $index + 1 }}</td>

            @foreach ($cols as $key)
              @php
                $value = $row->$key ?? '';
              @endphp

              {{-- Khusus status_pembayaran pakai badge --}}
              @if(isset($status) && $status && $key === 'status_pembayaran')
                @php
                  $color = match(strtolower($value)) {
                    'lunas' => 'bg-green-100 text-green-800',
                    'belum bayar' => 'bg-red-100 text-red-800',
                    'cicil' => 'bg-yellow-100 text-yellow-800',
                    default => 'bg-gray-100 text-gray-800',
                  };
                @endphp
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs font-semibold rounded-full {{ $color }}">
                    {{ ucfirst($value) }}
                  </span>
                </td>

              {{-- Format numerik hanya untuk kolom tertentu --}}
              @elseif(in_array($key, ['hari_ini', 'kemarin', 'jumlah']))
                <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                  {{ number_format((float) $value, 0, ',', '.') }}
                </td>

              {{-- Kolom lainnya (seperti tahun, jurusan) tampil biasa --}}
              @else
                <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                  {{ $value }}
                </td>
              @endif
            @endforeach

            @if(isset($sum) && $sum)
              @php
                $totalSum = ($row->hari_ini ?? 0) + ($row->kemarin ?? 0);
              @endphp
              <td class="px-6 py-4 font-bold text-blue-600 whitespace-nowrap">
                {{ number_format($totalSum, 0, ',', '.') }}
              </td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
