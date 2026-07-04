<?php
// ============================================
// Mengembalikan nama hari (Indonesia) dari sebuah tanggal
// ============================================
function nama_hari($tanggal) {
    $hari_array = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
    return $hari_array[date('w', strtotime($tanggal))];
}

// ============================================
// Slot jam kedatangan per hari (kapasitas 5 orang/hari)
// ============================================
function jam_slots() {
    return ['08:00:00', '09:30:00', '11:00:00', '13:00:00', '14:30:00'];
}

// ============================================
// Mencari jadwal (hari, tanggal, jam) otomatis untuk pendaftar baru.
// Kapasitas 1 hari maksimal 5 orang. Jika sudah penuh -> maju ke hari berikutnya.
// Pencarian dimulai H+1 dari tanggal pendaftaran.
// ============================================
function assign_jadwal($conn, $tgl_daftar) {
    $slots = jam_slots();
    $tanggal = date('Y-m-d', strtotime($tgl_daftar . ' +1 day'));

    while (true) {
        $result = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM pendaftar WHERE tanggal = '$tanggal'");
        $row = mysqli_fetch_assoc($result);

        if ((int)$row['jml'] < 5) {
            $jam  = $slots[(int)$row['jml']];
            $hari = nama_hari($tanggal);
            return ['hari' => $hari, 'tanggal' => $tanggal, 'jam' => $jam];
        }
        // hari ini penuh (>=5 orang) -> maju ke hari berikutnya
        $tanggal = date('Y-m-d', strtotime($tanggal . ' +1 day'));
    }
}

// ============================================
// Format tanggal Indonesia untuk tampilan, cth: 06 Juli 2026
// ============================================
function format_tanggal($tanggal) {
    $bulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    $d = date('d', strtotime($tanggal));
    $m = (int)date('m', strtotime($tanggal));
    $y = date('Y', strtotime($tanggal));
    return "$d {$bulan[$m]} $y";
}

// ============================================
// Format rupiah, cth: Rp 355.000
// ============================================
function format_rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>
