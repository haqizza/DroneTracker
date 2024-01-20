<div class="flex w-[20%] flex-col gap-[1rem] overflow-y-scroll rounded-[20px] scrollbar-hide">
    <a href="/predict" class="rounded-[20px] bg-[#222831] hover:bg-[#2c3440] py-[0.5rem] px-[1rem] text-center font-bold">
        Predict Page
    </a>
    <div class="rounded-[20px] bg-[#222831] p-[1rem]">
        <div class="flex flex-col gap-[0.75rem]">
            <h5 class="text-center text-[15px] font-[500] uppercase">Jarak Tempuh</h5>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="start">Koordinat Awal</label>
                <span id="start" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">
                    @isset($oldest)
                        {{ $oldest->latitude }}, {{ $oldest->longitude }}
                    @endisset
                </span>
            </div>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="end">Koordinat Akhir</label>
                <span id="end" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">
                    @isset($latest)
                        <p id="latend">{{ $latest->latitude }}</p>,
                        <p id="lngend">{{ $latest->longitude }}</p>
                    @endisset
                </span>
            </div>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="travelDistance">Jarak Tempuh</label>
                <span id="travelDistance" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">
                </span>
            </div>
        </div>
    </div>
    <div class="rounded-[20px] bg-[#222831] p-[1rem]">
        <div class="flex flex-col gap-[0.75rem]">
            <h5 class="text-center text-[15px] font-[500] uppercase">Waktu Tempuh</h5>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="waktu_awal">Waktu Awal</label>
                <span id="waktu_awal"
                    class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ !empty($oldest->created_at) ? date('D, d F Y H:i:s', strtotime($oldest->created_at)) : null }}</span>
            </div>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="waktu_akhir">Waktu Akhir</label>
                <span id="waktu_akhir"
                    class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ !empty($latest->created_at) ? date('D, d F Y H:i:s', strtotime($latest->created_at)) : null }}</span>
            </div>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="waktu">Total Waktu Tempuh</label>
                <span id="waktu" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">
                    @if ($waktu >= 60 and $waktu < 3600)
                        {{ number_format($waktu / 60, 2) }} Menit
                    @elseif ($waktu >= 3600)
                        {{ number_Format($waktu / 3600, 2) }} Jam
                    @else
                        {{ $waktu }} Detik
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="rounded-[20px] bg-[#222831] p-[1rem]">
        <div class="flex flex-col gap-[0.75rem]">
            <h5 class="text-center text-[15px] font-[500] uppercase">Penggunaan Daya</h5>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="volt_start">Voltase Awal</label>
                <span id="volt_start" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ $oldest->voltage ?? '' }}</span>
            </div>
            <div class="fix flex flex-col gap-[0.25rem]">
                <label class="mx-[0.25rem] text-[13px] uppercase" for="volt_end">Voltase Akhir</label>
                <span id="volt_end" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ $latest->voltage ?? '' }}</span>
            </div>
        </div>
    </div>
    <!-- <div class="rounded-[20px] bg-[#222831] p-[1rem]">
        <div class="flex flex-col"></div>
    </div>
    <div class="rounded-[20px] bg-[#222831] p-[1rem]">
        <div class="flex flex-col"></div>
    </div> -->
</div>
