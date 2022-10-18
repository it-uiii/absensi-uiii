@extends('layouts.welcome')
@section('title')
    Home - {{ config('app.name') }}
@endsection
@section('content')
    @if ($libur)
        <div class="text-center">
            <p>Absen Libur (Hari Libur Nasional {{ $holiday }})</p>
        </div>
    @else
        @if (date('l') == "Saturday" || date('l') == "Sunday")
            <div class="text-center">
                <p>Absen Libur</p>
            </div>
        @else
            @if ($present)
                @if ($present->keterangan == 'Alpha')
                    <div class="text-center">
                        @if (strtotime(date('H:i:s')) >= strtotime(config('absensi.jam_masuk') .' -3 hours') && strtotime(date('H:i:s')) <= strtotime(config('absensi.jam_pulang')))
                            <p>Silahkan Check-in</p>
                            <form action="{{ route('kehadiran.check-in') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-primary" type="submit">Check-in</button>
                            </form>
                        @else
                            <p>Check-in Belum Tersedia</p>
                        @endif
                    </div>
                @elseif($present->keterangan == 'Cuti')
                    <div class="text-center">
                        <p>Anda Sedang Cuti</p>
                    </div>
                @elseif($present->keterangan == 'Full Board')
                    <div class="text-center">
                        <p>Anda Sedang FullBoard</p>
                    </div>
                @elseif($present->keterangan == 'Dinas Luar (Perjadin)')
                    <div class="text-center">
                        <p>Anda Sedang Dinas Luar (Perjadin)</p>
                    </div>
                @elseif($present->keterangan == 'Full Day')
                    <div class="text-center">
                        <p>Anda Sedang FullDay</p>
                    </div>
                @elseif($present->keterangan == 'Work From Home')
                    <div class="text-center">
                        <p>Anda Sedang WFH</p>
                    </div>
                @elseif($present->keterangan == 'Sakit')
                    <div class="text-center">
                        <p>Anda Sedang Sakit</p>
                    </div>
                @else
                    <div class="text-center">
                        <p>
                            Check-in hari ini pukul : ({{ ($present->jam_masuk) }})
                        </p>
                        @if ($present->jam_keluar)
                            <p>Check-out hari ini pukul : ({{ $present->jam_keluar }})</p>
                        @else
                            @if (strtotime('now') >= strtotime(config('absensi.jam_pulang')))
                                <p>Jika pekerjaan telah selesai silahkan check-out</p>
                                <form action="{{ route('kehadiran.check-out', ['kehadiran' => $present]) }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="patch">
                                    <button type="submit" class="btn btn-primary show_confirm" data-toggle="tooltip">check-out</button>
                                </form>
                            @elseif ((\Carbon\Carbon::parse($present->jam_masuk)->diffInMinutes(\Carbon\Carbon::parse(date('H:i:s')))) >= 1)
                                <p>Jika pekerjaan telah selesai silahkan check-out</p>
                                <form action="{{ route('kehadiran.check-out', ['kehadiran' => $present]) }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="patch">
                                    <button type="submit" class="btn btn-primary show_confirm" data-toggle="tooltip">check-out</button>
                                </form>
                            @else
                                <p>Check-out Belum Tersedia</p>
                            @endif
                        @endif
                    </div>
                @endif
            @else
                <div class="text-center">
                    @if (strtotime(date('H:i:s')) >= strtotime(config('absensi.jam_masuk') . ' -3 hours') && strtotime(date('H:i:s')) <= strtotime(config('absensi.jam_pulang')))
                        <p>Silahkan Check-in</p>
                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button class="btn btn-primary" type="submit">Check-in</button>
                        </form>
                    @else
                        <p>Check-in Belum Tersedia</p>
                    @endif
                </div>
            @endif
        @endif
    @endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure checkout?",
            text: "You won't be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirm) => {
        if (confirm) {
            form.submit();
        }
        });
    });
</script>
@endsection
