@php
    $badge = match ($s->status) {
        'Berlangsung' => ['Sedang Berjalan', 'bg-[#FFFDE7] text-[#F57F17]'],
        'Selesai' => ['Selesai', 'bg-[#E8F5E9] text-[#2E7D32]'],
        default => ['Belum Dimulai', 'bg-[#F5F5F5] text-[#7A6A60]'],
    };

    $teksJam = $s->jam_ke_mulai === $s->jam_ke_sampai
        ? "Jam ke-{$s->jam_ke_mulai}"
        : "Jam ke-{$s->jam_ke_mulai} sampai ke-{$s->jam_ke_sampai}";
@endphp

<div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[18px] md:p-5
            flex flex-col gap-4 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">

    <div class="flex justify-between items-start sm:items-center gap-3">
        <div>
            <div class="font-['Poppins'] font-bold text-base sm:text-lg text-[#3E3028]">{{ $s->mapel }}</div>
            <div class="font-['Inter'] font-semibold text-xs sm:text-sm text-[#7A6A60] mt-0.5">{{ $s->guru }}</div>
        </div>
        <span class="text-[10px] sm:text-[11px] font-semibold px-2 sm:px-2.5 py-1 rounded-md whitespace-nowrap {{ $badge[1] }}">
            {{ $badge[0] }}
        </span>
    </div>

    <hr class="border-t border-[#E5D8CC] w-full m-0">

    <div class="flex items-center gap-1.5 text-[13px] text-[#7A6A60] font-['Inter']">
        <svg class="shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7A6A60" stroke-width="2">
            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
        </svg>
        <span>{{ $s->jam_mulai }} – {{ $s->jam_selesai }} ({{ $teksJam }})</span>
    </div>
</div>