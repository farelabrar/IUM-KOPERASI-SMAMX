<?php 
    @ob_start();
    session_start();
    if(empty($_SESSION['admin'])){
        echo '<script>window.location="login.php";</script>';
        exit;
    }
    require 'config.php';
    include $view;
    $lihat = new view($config);
    $toko = $lihat->toko();
    $hsl = $lihat->penjualan();
?>
<?php
$total_bayar = 0;
foreach ($hsl as $isi) {
    $total_bayar += $isi['total'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .receipt-container {
            width: 80mm;
            margin: 0 auto;
            padding: 5mm;
        }
        .receipt-header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 5mm;
            margin-bottom: 3mm;
        }
        .store-name {
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 2mm 0;
        }
        .store-address {
            margin: 0 0 2mm 0;
        }
        .receipt-info {
            margin-bottom: 3mm;
            display: flex;
            justify-content: space-between;
        }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3mm;
        }
        .receipt-table th {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 2mm 0;
            text-align: left;
        }
        .receipt-table td {
            padding: 1mm 0;
        }
        .receipt-table tr.total-row {
            border-top: 1px dashed #000;
        }
        .totals {
            margin: 3mm 0;
            text-align: right;
        }
        .receipt-footer {
            text-align: center;
            border-top: 1px dashed #000;
            padding-top: 3mm;
            margin-top: 2mm;
        }
        .column-code {width: 10%;}
        .column-item {width: 50%;}
        .column-qty {width: 15%; text-align: center;}
        .column-price {width: 25%; text-align: right;}
        .title-row {font-weight: bold;}
        .total-section {
            font-weight: bold;
        }
        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <script>window.print();</script>
    <div class="receipt-container">
        <div class="receipt-header">
            <p class="store-name"><?php echo strtoupper($toko['nama_toko']); ?></p>
            <p class="store-address"><?php echo $toko['alamat_toko']; ?></p>
        </div>
        
        <div class="receipt-info">
            <div>
                <div>Tanggal: <?php echo date("d/m/Y"); ?></div>
                <div>Waktu: <?php echo date("H:i"); ?></div>
            </div>
            <div>
                <div>Kasir: <?php echo htmlentities($_GET['nm_member']); ?></div>
                <div>No. Struk: <?php echo date('Ymd').rand(100,999); ?></div>
            </div>
        </div>
        
        <table class="receipt-table">
            <tr class="title-row">
                <th class="column-code">No</th>
                <th class="column-item">Item</th>
                <th class="column-qty">Qty</th>
                <th class="column-price">Harga</th>
            </tr>
            <?php 
            $no=1; 
            foreach($hsl as $isi){
            ?>
            <tr>
                <td class="column-code"><?php echo $no; ?></td>
                <td class="column-item"><?php echo $isi['nama_barang']; ?></td>
                <td class="column-qty"><?php echo $isi['jumlah']; ?></td>
                <td class="column-price">Rp <?php echo number_format($isi['total'], 0, ',', '.'); ?></td>
            </tr>
            <?php $no++; } ?>
        </table>
        
        <div class="totals">
            <table width="100%">
                <tr class="total-section">
                    <td align="right">Total:</td>
                    <td align="right" width="40%">Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td align="right">Bayar:</td>
                    <td align="right">Rp <?php echo number_format(htmlentities($_GET['bayar']), 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td align="right">Kembali:</td>
                    <td align="right">Rp <?php echo number_format(htmlentities($_GET['kembali']), 0, ',', '.'); ?></td>
                </tr>
            </table>
        </div>
        
        <div class="receipt-footer">
            <p>Terima Kasih Telah Berbelanja di Koperasi SMAMX!</p>
            <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
        </div>
    </div>
</body>
</html>