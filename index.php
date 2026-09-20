<?php
$hargaMobil   = null;
$dpPersen     = null;
$tenorTahun   = null;
$hasResult    = false;
$error        = '';

$bungaPersen  = 20; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hargaRaw   = preg_replace('/[^0-9]/', '', $_POST['harga_mobil'] ?? '');
    $dpPersen   = (float) ($_POST['dp'] ?? 0);
    $tenorTahun = (int) ($_POST['tenor'] ?? 0);

    if ($hargaRaw === '' || (float) $hargaRaw <= 0) {
        $error = 'Masukkan harga mobil terlebih dahulu.';
    } elseif ($tenorTahun < 1 || $tenorTahun > 5) {
        $error = 'Pilih tenor cicilan.';
    } else {
        $hargaMobil = (float) $hargaRaw;

        $nominalDP     = $hargaMobil * ($dpPersen / 100);
        $pokokPinjaman = $hargaMobil - $nominalDP;
        $nominalBunga  = $hargaMobil * ($bungaPersen / 100); // bunga flat dari harga mobil
        $totalBayar    = $pokokPinjaman + $nominalBunga;
        $tenorBulan    = $tenorTahun * 12;
        $angsuranBulan = $totalBayar / $tenorBulan;

        $hasResult = true;
    }
}

function rp($n) {
    return 'Rp' . number_format((float) $n, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autova finance — Kalkulator Angsuran Mobil</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="gambar/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Inter:wght@400;500;600&family=Roboto+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-oto py-3 sticky-top">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#beranda">

          <span class="brand-mark">
            <img src="gambar/logo.png" alt="Logo Autova FINANCE">
          </span>

          <span class="brand-text">
            <span class="brand-name d-block">Autova FINANCE</span>
            <span class="brand-sub">Kredit &amp; Asuransi Kendaraan</span>
          </span>

        </a>
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
          <i class="bi bi-list text-white fs-2"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Perusahaan</a></li>
            <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="hero" id="beranda">
      <video class="hero-video" autoplay muted loop playsinline poster="https://assets.mixkit.co/videos/52427/52427-thumb-360-0.jpg">
        <source src="https://assets.mixkit.co/videos/52427/52427-360.mp4" type="video/mp4">
      </video>
      <div class="hero-overlay"></div>
      <div class="container position-relative">
        <div class="row justify-content-center">
          <div class="col-lg-9 text-center">
            <h1 class="mx-auto">Ambil mobil impian dengan cicilan yang jelas dari awal.</h1>
            <p class="lead mt-3 mx-auto">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas maxime natus sit minima sunt corrupti necessitatibus, omnis iusto, pariatur tempore, quia accusamus cumque. Repellendus nostrum ad ab quam possimus modi!</p>
            <div class="d-flex gap-3 mt-4 justify-content-center">
              <a href="#kalkulator" class="btn-gold">Hitung Angsuran</a>
              <a href="#tentang" class="btn-outline-cream">Tentang Perusahaan</a>
            </div>
            <div class="hero-stats justify-content-center">
              <div>
                <div class="stat-num">20%</div>
                <div class="stat-label">Bunga flat tahunan</div>
              </div>
              <div>
                <div class="stat-num">1–5</div>
                <div class="stat-label">Tahun tenor</div>
              </div>
              <div>
                <div class="stat-num">24/7</div>
                <div class="stat-label">Layanan klaim asuransi</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section class="section-about" id="tentang">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="about-panel">
              <h2>Tentang Perusahaan</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas maxime natus sit minima sunt corrupti necessitatibus, omnis iusto, pariatur tempore, quia accusamus cumque. Repellendus nostrum ad ab quam possimus modi!</p>
              <div class="feature-row">
                <i class="bi bi-bank2"></i>
                <div>
                  <strong>Pembiayaan resmi</strong>
                  <div class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                </div>
              </div>
              <div class="feature-row">
                <i class="bi bi-shield-check"></i>
                <div>
                  <strong>Perlindungan asuransi</strong>
                  <div class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                </div>
              </div>
              <div class="feature-row">
                <i class="bi bi-speedometer2"></i>
                <div>
                  <strong>Simulasi transparan</strong>
                  <div class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="gambar-panel">
              <img src="gambar/autova_ilus2.png" alt="Ilustrasi armada kendaraan mitra autova FINANCE">
              <div class="caption-overlay">
                <span>Ilustrasi mitra AUTOVA FINANCE</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-calc" id="kalkulator">
      <div class="container">
        <div class="calc-heading mb-4">
          <h2>Kalkulator Angsuran Mobil</h2>
          <p>Masukkan harga mobil, uang muka, dan tenor untuk melihat estimasi cicilan bulanan Anda.</p>
        </div>

        <div class="row g-4">
          <div class="col-lg-6">
            <div class="dashboard">
              <form method="post" action="#kalkulator">
                <div class="mb-3">
                  <label for="harga_mobil_display">Harga Mobil</label>
                  <div class="input-group">
                    <span class="input-group-text input-group-text-oto">Rp</span>
                    <input type="text" inputmode="numeric" class="form-control" id="harga_mobil_display" placeholder="100.000.000" required
                      value="<?= $hargaMobil ? number_format($hargaMobil,0,',','.') : '' ?>">
                    <input type="hidden" name="harga_mobil" id="harga_mobil">
                  </div>
                </div>

                <div class="mb-3">
                  <label for="dp">Uang Muka (DP)</label>
                  <select class="form-select" id="dp" name="dp" required>
                    <?php
                        $pilihanDP = [10, 20, 30, 40, 50];
                    ?>

                    <?php foreach ($pilihanDP as $opt): ?>
                        <option value="<?= $opt ?>" <?= $dpPersen == $opt ? 'selected' : '' ?>>
                            <?= $opt ?>%
                        </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="d-block">Tenor</label>
                  <?php for ($t = 1; $t <= 5; $t++): ?>
                    <div class="tenor-option">
                        <input
                            type="radio"
                            name="tenor"
                            id="tenor<?= $t ?>"
                            value="<?= $t ?>"
                            <?= $tenorTahun == $t ? 'checked' : '' ?>
                            required
                        >
                        <label for="tenor<?= $t ?>"><?= $t ?> Th</label>
                    </div>
                <?php endfor; ?>
                </div>

                <div class="small" style="color:#8FA1B3;">
                  <i class="bi bi-info-circle me-1"></i>Bunga flat <?= $bungaPersen ?>% dari harga mobil, berlaku untuk seluruh tenor.
                </div>

                <button type="submit" class="btn-hitung"><i class="bi bi-calculator me-2"></i>Hitung Angsuran</button>
              </form>

              <?php if ($error): ?>
                <div class="alert-oto"><i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($error) ?></div>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-lg-6">
            <?php if ($hasResult): ?>
              <div class="result-card">
                <div class="result-head">
                  <span class="display-font">Simulasi Kredit Anda</span>
                  <span class="badge-ok">Estimasi</span>
                </div>
                <div class="result-body">
                  <div class="result-row"><span>Harga Mobil</span><span class="val"><?= rp($hargaMobil) ?></span></div>
                  <div class="result-row"><span>DP (<?= $dpPersen ?>%)</span><span class="val"><?= rp($hargaMobil * $dpPersen / 100) ?></span></div>
                  <div class="result-row"><span>Tenor</span><span class="val"><?= $tenorTahun ?> Tahun (<?= $tenorTahun * 12 ?> Bulan)</span></div>
                  <div class="result-row"><span>Bunga Flat</span><span class="val"><?= $bungaPersen ?>%</span></div>

                  <div class="result-total">
                    <span class="label">Jumlah Angsuran / Bulan</span>
                    <span class="amount"><?= rp($angsuranBulan) ?></span>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <div class="dashboard d-flex flex-column align-items-center justify-content-center text-center h-100" style="min-height:340px;">
                <i class="bi bi-clipboard2-data" style="font-size:2.6rem;color:var(--gold-400);"></i>
                <p class="mt-3 mb-0" style="color:#AEBECD;">Hasil simulasi angsuran akan tampil di sini ya setelah Kamu menekan tombol Hitung Angsuran.</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <footer id="kontak">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-4">
            <h5>AUTOVA FINANCE</h5>
            <p class="small mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas maxime natus sit minima sunt corrupti necessitatibus, omnis iusto, pariatur tempore, quia accusamus cumque. Repellendus nostrum ad ab quam possimus modi!</p>
          </div>
          <div class="col-lg-4">
            <h5>Kontak</h5>
            <p class="small mb-1"><i class="bi bi-geo-alt me-2"></i>Jl. wlulu Raya No. 20, Jakarta</p>
            <p class="small mb-1"><i class="bi bi-telephone me-2"></i>(021) 555-0192</p>
            <p class="small"><i class="bi bi-envelope me-2"></i>halo@autova.com</p>
          </div>
          <div class="col-lg-4">
            <h5>Ikuti Kami</h5>
            <div class="social mt-2">
              <i class="bi bi-facebook"></i>
              <i class="bi bi-instagram"></i>
              <i class="bi bi-linkedin"></i>
              <i class="bi bi-youtube"></i>
            </div>
          </div>
        </div>
            
        <div class="copyright">
          <span>© <?= date('Y') ?> Autova FINANCE.</span>
          <span class="small">Created by Rizky</span>
        </div>
      </div>
    </footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        const display = document.getElementById('harga_mobil_display');
        const hidden  = document.getElementById('harga_mobil');

        function formatRibuan(value) {
            const angka = value.replace(/\D/g, '');
                    
            hidden.value = angka;
                    
            if (angka === '') {
                return '';
            }
                    
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        if (display) {
          hidden.value = display.value.replace(/\D/g, '');
          display.addEventListener('input', (e) => {
            e.target.value = formatRibuan(e.target.value);
          });
        }
    </script>
</body>
</html>