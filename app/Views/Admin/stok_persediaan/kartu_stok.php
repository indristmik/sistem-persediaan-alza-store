<?php
/** @var array $varian */
/** @var array $riwayat */
/** @var int $sisa_stok */
/** @var mixed $tgl_mulai */
/** @var mixed $tgl_selesai */

$periodeText = 'Semua Periode';
if (!empty($tgl_mulai) && !empty($tgl_selesai)) {
    $periodeText = date('d/m/Y', strtotime($tgl_mulai)) . ' s/d ' . date('d/m/Y', strtotime($tgl_selesai));
} elseif (!empty($tgl_mulai)) {
    $periodeText = 'Mulai ' . date('d/m/Y', strtotime($tgl_mulai));
} elseif (!empty($tgl_selesai)) {
    $periodeText = 'Sampai ' . date('d/m/Y', strtotime($tgl_selesai));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Stok - <?= esc($varian['kode_sku']); ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
            font-size: 12px;
            margin: 24px;
        }
        .no-print {
            margin-bottom: 18px;
            display: flex;
            gap: 8px;
        }
        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
        }
        .btn-primary { background: #2952ff; color: #fff; }
        .btn-secondary { background: #e9ecef; color: #333; }

        .kop {
            text-align: center;
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 16px;
        }
        .kop h2 { margin: 0; font-size: 18px; letter-spacing: 0.5px; }
        .kop p { margin: 4px 0 0; font-size: 12px; color: #555; }

        .info-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .info-grid td {
            padding: 4px 6px;
            vertical-align: top;
        }
        .info-label { color: #555; width: 140px; }
        .info-val { font-weight: 600; }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        table.data th, table.data td {
            border: 1px solid #999;
            padding: 7px 8px;
        }
        table.data th {
            background: #f1f3f5;
            text-align: left;
            font-weight: 700;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .masuk { color: #198754; font-weight: 700; }
        .keluar { color: #dc3545; font-weight: 700; }

        .ttd-wrap {
            display: flex;
            justify-content: flex-end;
            margin-top: 28px;
        }
        .ttd-box {
            text-align: center;
            width: 220px;
        }
        .ttd-space { height: 64px; }

        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button class="btn btn-primary" onclick="window.print()">Cetak / Simpan PDF</button>
        <button class="btn btn-secondary" onclick="tutupAtauKembali()">Kembali</button>
    </div>

    <div class="kop">
        <h2>ALZA.STORE</h2>
        <p>KARTU STOK PERSEDIAAN BARANG (RIWAYAT MUTASI SKU)</p>
    </div>

    <table class="info-grid">
        <tr>
            <td class="info-label">Kode SKU</td>
            <td class="info-val">: <?= esc($varian['kode_sku']); ?></td>
            <td class="info-label">Periode</td>
            <td class="info-val">: <?= esc($periodeText); ?></td>
        </tr>
        <tr>
            <td class="info-label">Produk & Warna</td>
            <td class="info-val">: <?= esc($varian['nama_produk']); ?><?= !empty($varian['warna']) ? ' — ' . esc($varian['warna']) : ''; ?></td>
            <td class="info-label">Stok Minimum</td>
            <td class="info-val">: <?= (int) $varian['stok_minimum']; ?> pcs</td>
        </tr>
        <tr>
            <td class="info-label">Kategori / Ukuran</td>
            <td class="info-val">: <?= esc($varian['nama_kategori'] ?? '-'); ?> / Ukuran <?= esc($varian['ukuran']); ?></td>
            <td class="info-label">Sisa Stok Aktual</td>
            <td class="info-val">: <?= (int) $sisa_stok; ?> pcs</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="16%">Tanggal & Waktu</th>
                <th width="15%">Jenis Mutasi</th>
                <th>Kode Transaksi & Keterangan</th>
                <th class="text-center" width="10%">Masuk (+)</th>
                <th class="text-center" width="10%">Keluar (-)</th>
                <th class="text-center" width="12%">Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($riwayat)) : ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada riwayat pergerakan stok pada periode ini.</td>
                </tr>
            <?php else : ?>
                <?php
                $no = 1;
                $saldoBerjalan = 0;
                foreach ($riwayat as $r) :
                    $qty = (int) $r['jumlah'];
                    $saldoBerjalan += $qty;
                    $isRetur = !empty($r['id_retur']);
                    $jenis = $isRetur ? 'Retur Masuk' : ($qty > 0 ? 'Barang Masuk' : 'Barang Keluar');
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($r['tanggal_pergerakan'])); ?></td>
                    <td><?= $jenis; ?></td>
                    <td><?= esc($r['keterangan']); ?></td>
                    <td class="text-center <?= $qty > 0 ? 'masuk' : ''; ?>">
                        <?= $qty > 0 ? '+' . $qty : '-'; ?>
                    </td>
                    <td class="text-center <?= $qty < 0 ? 'keluar' : ''; ?>">
                        <?= $qty < 0 ? $qty : '-'; ?>
                    </td>
                    <td class="text-center"><strong><?= $saldoBerjalan; ?> pcs</strong></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="ttd-wrap">
        <div class="ttd-box">
            <div>Pekalongan, <?= date('d/m/Y'); ?></div>
            <div>Admin Gudang</div>
            <div class="ttd-space"></div>
            <div><strong>( _______________________ )</strong></div>
        </div>
    </div>

    <script>
        function tutupAtauKembali() {
            if (window.opener) {
                window.close();
            } else if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/Admin/StokPersediaan/kartuStok/<?= $varian['id_varian']; ?>';
            }
        }
    </script>

</body>
</html>