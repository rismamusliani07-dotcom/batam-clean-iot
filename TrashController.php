<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrashController extends Controller
{
    /**
     * Menampilkan Dashboard Utama Batam-Clean IoT.
     */
    public function index()
    {
        // 1. Data 3 Lokasi Kontainer Utama di Batam
        // Link Google Maps diarahkan langsung ke koordinat jalan daerah tersebut
        $bins = [
            [
                'id' => 1, 
                'lokasi' => 'Sagulung (Pasar SP)', 
                'kapasitas' => 85, 
                'status' => 'Penuh',
                'maps_link' => 'https://www.google.com/maps/search/Pasar+SP+Sagulung+Batam'
            ],
            [
                'id' => 2, 
                'lokasi' => 'Odessa Batam Kota', 
                'kapasitas' => 30, 
                'status' => 'Aman',
                'maps_link' => 'https://www.google.com/maps/search/Perumahan+Odessa+Batam+Kota'
            ],
            [
                'id' => 3, 
                'lokasi' => 'Batuaji (Tembesi)', 
                'kapasitas' => 95, 
                'status' => 'Darurat',
                'maps_link' => 'https://www.google.com/maps/search/Tembesi+Batu+Aji+Batam'
            ],
        ];

        // 2. Data Daftar Truk Aktif (Manajemen Armada)
        // Disesuaikan dengan narasi "Mencegah Kendala Saat Menuju Lokasi"
        $trucks = [
            [
                'plat' => 'BP 9012 UX', 
                'jenis' => 'Compactor (Besar)', 
                'driver' => 'Pak Budi', 
                'status' => 'Sedang Mengangkut di Sagulung',
                'kondisi' => 'Prima'
            ],
            [
                'plat' => 'BP 1123 AB', 
                'jenis' => 'Arm Roll (Sedang)', 
                'driver' => 'Pak Andi', 
                'status' => 'Standby di Pool DLH',
                'kondisi' => 'Siap Operasi'
            ],
            [
                'plat' => 'BP 4456 CD', 
                'jenis' => 'Dump Truck (Kecil)', 
                'driver' => 'Ibu Siti', 
                'status' => 'Menuju Batam Kota (Odessa)',
                'kondisi' => 'Cek Ban Selesai'
            ],
        ];

        // 3. Mengirim data ke view 'dashboard.blade.php'
        return view('dashboard', compact('bins', 'trucks'));
    }

    /**
     * Fitur Tambahan: Menerima laporan dari warga (Simulasi)
     */
    public function kirimLaporan(Request $request)
    {
        // Di sini biasanya ada logika simpan ke database
        // Namun untuk UTS, kita bisa gunakan pesan sukses sementara
        return back()->with('success', 'Laporan/Saran Anda berhasil dikirim ke sistem Batam-Clean!');
    }
}