<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            text-align: center;
            background-image: url('shell.jpg');
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        form {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            display: inline-block;
            padding: 20px;
            margin-top: 25vh;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #1a73e8;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        select {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #1a73e8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #155ab2;
        }

        .btn {
            text-align: center;
        }

        .output {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-top: 25vh;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #333;
        }

        .output h2 {
            color: #1a73e8;
            font-size: 24px;
        }

        .output p {
            font-size: 18px;
            color: #555;
        }

        .output strong {
            color: #000;
        }
    </style>
</head>
<body>
    <?php
    class Shell {
        public $total, $jumlah, $jenis, $harga, $ppn = 0.1, $subtotal, $ppn2;
    
        function __construct($jumlah, $jenis) {
            switch ($jenis) {
                case "supershell":
                    $this->harga = 15000;
                    break;
                case "shellvpower":
                    $this->harga = 16000;
                    break;
                case "shellvpowerdiesel":
                    $this->harga = 18000;
                    break;
                case "shellvpowernitro":
                    $this->harga = 17000;
                    break;
            }
            $this->subtotal = $this->harga * $jumlah;
            $this->ppn2 = $this->subtotal * $this->ppn;
            $this->total = $this->subtotal + $this->ppn2;
        }
    }
    
    class Beli extends Shell {
        public function __construct($jumlah, $jenis) {
            parent::__construct($jumlah, $jenis);
        }
    }
    
    if(isset($_POST['beli'])) {
        $jumlah = $_POST['inputLiter'];
        $jenis = $_POST['bensin'];
        $shell = new Beli($jumlah, $jenis);
        
        $jenisBahanBakar = str_replace(
            ['supershell', 'shellvpower', 'shellvpowerdiesel', 'shellvpowernitro'],
            ['Super Shell', 'Shell V Power', 'Shell V Power Diesel', 'Shell V Power Nitro'],
            $jenis
        );
        
        echo "<div class='output'>";
        echo "<h2>Bukti Transaksi Pembelian</h2>";
        echo "<p>Jenis Bahan Bakar : " . $jenisBahanBakar . "</p>";
        echo "<p>Jumlah liter : $jumlah L</p>";
        echo "<p>Harga Per Liter : Rp " . number_format($shell->harga, 0, ',', '.') . "</p>";
        echo "<p>Subtotal : Rp " . number_format($shell->subtotal, 0, ',', '.') . "</p>";
        echo "<p>PPN (10%) : Rp " . number_format($shell->ppn2, 0, ',', '.') . "</p>";
        echo "<hr>";
        echo "Total Harga : Rp " . number_format($shell->total, 0, ',', '.');
        echo "</div>";
    } else {
        ?>
        <form action="" method="POST">
            <h2>Masukan Jumlah Liter</h2>
            <input type="text" placeholder="Masukan Jumlah Liter" name="inputLiter" id="inputLiter" required>
            
            <h2>Pilih Tipe Bahan Bakar</h2>
            <div class="btn">
                <select name="bensin" id="bensin">
                    <option value="supershell">Super Shell</option>
                    <option value="shellvpower">Shell V Power</option>
                    <option value="shellvpowerdiesel">Shell V Power Diesel</option>
                    <option value="shellvpowernitro">Shell V Power Nitro</option>
                </select>
                <button type="submit" name="beli">Beli</button>
            </div>
        </form>
        <?php
    }
    ?>
</body>
</html>