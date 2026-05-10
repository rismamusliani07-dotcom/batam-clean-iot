<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batam-Clean IoT Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        scroll-behavior: smooth;
        font-size: 14px;
    }

    .full-section {
        min-height: auto;
        padding: 45px 0;
        border-bottom: 1px solid #eee;
    }

    .navbar {
        background-color: #1a5928 !important;
        padding: 10px 0;
    }

    .navbar-brand {
        font-size: 18px;
    }

    .nav-link {
        font-size: 13px;
    }

    .card-eco {
        border-left: 5px solid #1a5928;
    }

    .card-body {
        padding: 18px;
    }

    .map-box {
        height: 250px;
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
    }

    h1.display-4 {
        font-size: 2.4rem;
    }

    h2 {
        font-size: 1.8rem;
    }

    h4 {
        font-size: 1.2rem;
    }

    .table {
        font-size: 14px;
    }

    .btn-lg {
        padding: 10px 18px;
        font-size: 14px;
    }
</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">BATAM-CLEAN IoT</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-uppercase small fw-bold">
                    <li class="nav-item"><a class="nav-link" href="#edukasi">Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#monitoring">Monitoring & Peta</a></li>
                    <li class="nav-item"><a class="nav-link" href="#armada">Daftar Truk</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-warning text-dark ms-lg-3" href="#laporan">Lapor Warga</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="edukasi" class="full-section bg-light">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold text-success">
                    Kurangi Plastik,
                    <br>
                    Jaga Batam Tetap Asri!
                </h1>

                <p class="lead mt-4">
                    Sampah yang kita buang hari ini adalah warisan buruk untuk masa depan.
                    Mari mulai memilah sampah dari rumah.
                </p>

                <div class="card card-eco p-3 mt-4 shadow-sm bg-white">

                    <h5>
                        <span class="badge bg-success">
                            Notes untuk Warga
                        </span>
                    </h5>

                    <p class="mb-0 text-muted">
                        Gunakan kantong belanja kain saat ke pasar.
                        Botol plastik bekas bisa dijadikan pot tanaman atau dikumpulkan
                        ke bank sampah terdekat untuk mengurangi beban kontainer utama.
                    </p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="p-4 bg-white rounded shadow-sm border">

                    <h4 class="fw-bold mb-3">
                        Cara Penanganan Sampah
                    </h4>

                    <ol class="list-group list-group-numbered list-group-flush">

                        <li class="list-group-item">
                            Pisahkan sampah Organik (sisa makanan) dan Anorganik.
                        </li>

                        <li class="list-group-item">
                            Remas botol plastik agar tidak memakan ruang di kontainer.
                        </li>
                        <li class="list-group-item">
                            Jangan membuang sampah cair atau bahan kimia ke bak umum.
                        </li>

                        <li class="list-group-item text-danger fw-bold">
                            HINDARI membakar sampah karena merusak kualitas udara Batam.
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>

</section>

    <section id="monitoring" class="full-section">
    <div class="container">

        <h2 class="text-center fw-bold mb-5">
            Dashboard Monitoring 
        </h2>

        <div class="row g-4 mb-5">

            @foreach($bins as $bin)

            <div class="col-md-4">

                <div class="card shadow-sm border-0 bg-dark text-white">

                    <div class="card-body text-center">

                        <h5 class="text-warning text-uppercase">
                            {{ $bin['lokasi'] }}
                        </h5>

                        <hr class="border-secondary">

                        <h2 class="fw-bold display-6">
                            {{ $bin['kapasitas'] }}%
                        </h2>

                        <div class="progress mb-4" style="height: 12px;">

                            <div class="progress-bar {{ $bin['kapasitas'] > 80 ? 'bg-danger' : 'bg-success' }}"
                                 style="width: {{ $bin['kapasitas'] }}%">
                            </div>

                        </div>

                        <button class="btn btn-warning w-100 fw-bold"
                            onclick="updateDetail(
                                '{{ $bin['lokasi'] }}',
                                '{{ $bin['kapasitas'] }}',
                                '{{ $bin['maps_link'] }}'
                            )">

                            CEK DETAIL LOKASI

                        </button>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <!-- DETAIL LOKASI -->
        <div id="rute-detail"
             class="py-5 bg-white border rounded shadow-sm mt-5"
             style="display: none;">

            <div class="container text-center">

                <h4 class="text-muted">
                    Informasi Jalur Wilayah:
                </h4>

                <h2 id="target-lokasi"
                    class="fw-bold text-success mb-3">
                    -
                </h2>

                <div class="row justify-content-center">

                    <div class="col-md-6">

                        <div class="alert alert-info">

                            <strong>Navigasi Siap:</strong>
                            Klik tombol di bawah untuk melihat rute jalan daerah secara real-time di Google Maps.

                        </div>

                        <a id="btn-maps"
                           href="#"
                           target="_blank"
                           class="btn btn-outline-primary btn-lg shadow-sm">

                            Buka Panduan Jalan (Google Maps)

                        </a>

                        <p class="mt-3 small text-muted text-uppercase">

                            Sistem Mengoptimalkan Rute agar Truk Menghindari Kemacetan

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<script>
function updateDetail(lokasi, kapasitas, link) {

    // tampilkan panel detail
    document.getElementById('rute-detail').style.display = 'block';

    // update nama lokasi
    document.getElementById('target-lokasi').innerText =
        lokasi + " (" + kapasitas + "%)";

    // update link maps
    document.getElementById('btn-maps').href = link;

    // scroll otomatis
    window.location.hash = 'rute-detail';
}
</script>

<section id="armada" class="full-section bg-light">

    <div class="container">

        <h2 class="text-center fw-bold mb-5">
            Daftar Armada Truk Aktif
        </h2>

        <div class="table-responsive shadow-sm bg-white rounded p-3">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>No Plat</th>
                        <th>Jenis Truk</th>
                        <th>Nama Supir</th>
                        <th>Status Operasional</th>
                        <th>Kendala Kendaraan</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($trucks as $truck)

                    <tr>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $truck['plat'] }}
                            </span>
                        </td>

                        <td>{{ $truck['jenis'] }}</td>

                        <td>{{ $truck['driver'] }}</td>

                        <td>
                            <span class="text-success fw-bold">
                                ● {{ $truck['status'] }}
                            </span>
                        </td>

                        <td>
                            <span class="text-muted small">
                                Mesin Prima (Siap Tanjakan)
                            </span>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="alert alert-info mt-4">

            <strong>Info Petugas:</strong>
            Semua armada telah diperiksa untuk memastikan tidak ada kendala teknis saat menuju lokasi darurat sampah.

        </div>

    </div>

</section>
<section id="laporan" class="full-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-7 text-center mb-5">

                <h2 class="fw-bold">
                    Suara Warga Batam
                </h2>

                <p class="text-muted">
                    Jika sensor di lokasi tidak terbaca atau ada komplain terkait kebersihan,
                    silakan sampaikan di sini.
                </p>

            </div>

            <div class="col-md-8">

                <div class="card shadow border-0 p-4">

                    <form>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-bold">
                                    Nama
                                </label>

                                <input type="text"
                                       class="form-control"
                                       placeholder="Nama lengkap">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-bold">
                                    Wilayah
                                </label>

                                <input type="text"
                                       class="form-control"
                                       placeholder="Contoh: Sagulung">

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Keluhan / Saran
                            </label>

                            <textarea class="form-control"
                                      rows="5"
                                      placeholder="Tuliskan komplain atau saran Anda..."></textarea>

                        </div>

                        <button type="button"
                                class="btn btn-success btn-lg w-100"
                                onclick="alert('Terima kasih! Suara Anda telah kami terima untuk tindak lanjut.')">

                            Kirim Komplain / Saran

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

    <footer class="bg-dark text-white py-4 text-center">
        <p class="mb-0">&copy; 2026 Batam-Clean IoT - Proyek UTS Teknik Komputer</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>