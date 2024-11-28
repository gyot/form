<?php
if (!function_exists('formatTanggalSD')) {
    function formatTanggalSD($tanggalMulai, $tanggalSelesai)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $dateMulai = date_create($tanggalMulai);
        $dateSelesai = date_create($tanggalSelesai);

        $dMulai = date_format($dateMulai, "d");
        $mMulai = date_format($dateMulai, "m") - 1;
        $yMulai = date_format($dateMulai, "Y");

        $dSelesai = date_format($dateSelesai, "d");
        $mSelesai = date_format($dateSelesai, "m") - 1;
        $ySelesai = date_format($dateSelesai, "Y");

        if ($tanggalMulai === $tanggalSelesai) {
            return "{$dMulai} {$bulan[$mMulai]} {$yMulai}";
        } elseif ($mMulai === $mSelesai && $yMulai === $ySelesai) {
            return "{$dMulai} s.d. {$dSelesai} {$bulan[$mMulai]} {$yMulai}";
        } else {
            return "{$dMulai} {$bulan[$mMulai]} {$yMulai} s.d. {$dSelesai} {$bulan[$mSelesai]} {$ySelesai}";
        }
    }
}

if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $dateTanggal = date_create($tanggal);

        $dTanggal = date_format($dateTanggal, "d");
        $mTanggal = date_format($dateTanggal, "m") - 1;
        $yTanggal = date_format($dateTanggal, "Y");
        
        return "{$dTanggal} {$bulan[$mTanggal]} {$yTanggal}";
    }
}
