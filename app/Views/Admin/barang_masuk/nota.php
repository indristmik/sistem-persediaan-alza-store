<?php
/** @var array $header */
/** @var array $items */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Pembayaran Maklun - <?= esc($header['nomor_referensi']); ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
            font-size: 13px;
            margin: 24px;
            background: #f8f9fa;
        }
        .no-print {
            max-width: 760px;
            margin: 0 auto 16px;
            display: flex;
            justify-content: flex-end;
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

        .nota-box {
            max-width: 760px;
            margin: auto;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 28px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #222;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .header h2 {
            margin: 0;
            font-size: 19px;
            letter-spacing: 0.5px;
        }
        .header small {
            color: #555;
            display: inline-block;
            margin-top: 3px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .info-label { color: #555; width: 130px; }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .detail-table th, .detail-table td {
            border: 1px solid #999;
            padding: 8px 10px;
        }
        .detail-table th {
            background: #f1f3f5;
            text-align: left;
            font-weight: 700;
        }
        .detail-table tfoot td {
            background: #f8f9fa;
            font-weight: 700;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .keterangan-box {
            background: #f8f9fa;
            border-left: 3px solid #2952ff;
            padding: 8px 12px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .ttd {
            display: flex;
            justify-content: space-between;
            margin-top: 36px;
            text-align: center;
        }
        .ttd div { width: 42%; }
        .ttd p { margin: 4px 0; }
        .ttd-space { height: 68px; }

        @media print {
            body {
                margin: 0;
                background: #fff;
            }
            .no-print { display: none; }
            .nota-box {
                border: none;
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button class="btn btn-primary" onclick="window.print()">Cetak / Simpan PDF</button>
        <button class="btn btn-secondary" onclick="tutupAtauKembali()">Kembali</button>
    </div>

    <div class="nota-box">
        <div class="header">
            <div>
                <h2>ALZA.STORE</h2>
                <small>Resi Serah Terima &amp; Pembayaran Jasa Maklun</small>
            </div>
            <div class="text-right">
                <strong>No. Ref: <?= esc($header['nomor_referensi']); ?></strong><br>
                <small>Tanggal: <?= date('d/m/Y H:i', strtotime($header['tanggal_masuk'])); ?></small>
            </div>
        </div>

        <table class="info-table">
            <tr>
                <td class="info-label">Mitra Penjahit</td>
                <td width="16">:</td>
                <td><strong><?= esc($header['nama_penjahit'] ?? '-'); ?></strong></td>
            </tr>
            <tr>
                <td class="info-label">No. Telepon</td>
                <td>:</td>
                <td><?= esc($header['no_telepon'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td class="info-label">Alamat</td>
                <td>:</td>
                <td><?= esc($header['alamat'] ?? '-'); ?></td>
            </tr>
        </table>

        <table class="detail-table">
            <thead>
                <tr>
                    <th width="6%" class="text-center">No</th>
                    <th width="16%">Kode SKU</th>
                    <th>Produk &amp; Ukuran</th>
                    <th width="12%" class="text-center">Jumlah</th>
                    <th width="16%" class="text-right">Tarif / pcs</th>
                    <th width="18%" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalQty = 0;
                $grandTotal = 0;
                foreach ($items as $item) :
                    $totalQty   += $item['jumlah'];
                    $grandTotal += $item['total_biaya'];
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= esc($item['kode_sku']); ?></td>
                    <td>
                        <?= esc($item['nama_produk']); ?> — Ukuran <?= esc($item['ukuran']); ?>
                        <?= $item['warna'] ? '(' . esc($item['warna']) . ')' : ''; ?>
                    </td>
                    <td class="text-center"><?= (int) $item['jumlah']; ?> pcs</td>
                    <td class="text-right">Rp <?= number_format($item['biaya_produksi'], 0, ',', '.'); ?></td>
                    <td class="text-right">Rp <?= number_format($item['total_biaya'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">TOTAL</td>
                    <td class="text-center"><?= (int) $totalQty; ?> pcs</td>
                    <td></td>
                    <td class="text-right">Rp <?= number_format($grandTotal, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>

        <?php if (!empty($header['keterangan'])) : ?>
            <div class="keterangan-box">
                <strong>Keterangan:</strong> <?= esc($header['keterangan']); ?>
            </div>
        <?php endif; ?>

        <div class="ttd">
            <div>
                <p>Diserahkan Oleh (Penjahit),</p>
                <div class="ttd-space"></div>
                <p><strong>( <?= esc($header['nama_penjahit'] ?? '....................'); ?> )</strong></p>
            </div>
            <div>
                <p>Pekalongan, <?= date('d/m/Y'); ?></p>
                <p>Diterima Oleh (Admin ALZA.STORE),</p>
                <div class="ttd-space"></div>
                <p><strong>( _______________________ )</strong></p>
            </div>
        </div>
    </div>

    <script>
        function tutupAtauKembali() {
            if (window.opener) {
                window.close();
            } else if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/Admin/BarangMasuk';
            }
        }
    </script>

</body>
</html>