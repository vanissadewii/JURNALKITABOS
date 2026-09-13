<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Persetujuan Dispen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Figtree', sans-serif; }</style>
</head>
<body class="bg-[#F8F5F1] text-[#3F2924] flex min-h-screen items-center justify-center p-5">

<div class="w-full max-w-md rounded-lg bg-white p-6 shadow-sm">

    <h2 class="text-[15px] font-bold text-[#3F2924]">Persetujuan Surat Dispen</h2>
    <p class="mt-1 text-[10px] text-[#795548]">No. Surat: {{ $dispen->nomor_surat }}</p>

    @if (session('success'))
        <div class="mt-4 rounded-md bg-[#E8F5E9] px-4 py-3 text-[10px] text-[#258A3E]">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-4 space-y-2 rounded-md bg-[#FAF8F5] p-4">
        <p class="text-[10px]"><span class="font-semibold">Nama:</span> {{ $dispen->siswa->nama }}</p>
        <p class="text-[10px]"><span class="font-semibold">Kelas:</span> {{ $dispen->kelas->tingkat }} {{ $dispen->kelas->jurusan }} {{ $dispen->kelas->rombel }}</p>
        <p class="text-[10px]"><span class="font-semibold">Tanggal:</span> {{ $dispen->tanggal->format('d/m/Y') }}</p>
        <p class="text-[10px]"><span class="font-semibold">Jam:</span> {{ $dispen->labelJam() }}</p>
        <p class="text-[10px]"><span class="font-semibold">Alasan:</span> {{ $dispen->alasan }}</p>
        <p class="text-[10px]"><span class="font-semibold">Diajukan oleh:</span> {{ $dispen->guruPiket->name ?? '-' }}</p>
    </div>

    @if ($dispen->status === 'menunggu')
        <div class="mt-5 flex gap-3">
            <form method="POST" action="{{ route('dispen.approval.setuju', $dispen->token_approval) }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full rounded-md bg-[#258A3E] px-4 py-2 text-[10px] font-semibold text-white hover:bg-[#1F7434]">
                    Setujui
                </button>
            </form>
            <form method="POST" action="{{ route('dispen.approval.tolak', $dispen->token_approval) }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full rounded-md bg-[#E53935] px-4 py-2 text-[10px] font-semibold text-white hover:bg-[#C62828]">
                    Tolak
                </button>
            </form>
        </div>
    @else
        <div class="mt-5 rounded-md px-4 py-3 text-center text-[10px] font-semibold
            {{ $dispen->status === 'disetujui' ? 'bg-[#E8F5E9] text-[#258A3E]' : 'bg-[#FFEBEE] text-[#E53935]' }}">
            Surat ini sudah {{ $dispen->status }}.
        </div>
    @endif

</div>

</body>
</html>