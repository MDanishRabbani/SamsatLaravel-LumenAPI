<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PIN</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            padding: 30px 20px;
            text-align: center;
        }

        .content p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .pin-code {
            display: inline-block;
            background-color: #f4f4f9;
            color: #333;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 3px;
            padding: 10px 20px;
            border-radius: 8px;
            border: 2px dashed #4CAF50;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            padding: 15px 30px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            padding: 20px;
            background-color: #f4f4f9;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Header -->
        <div class="header">
            🔐 Konfirmasi PIN Login
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo,</p>
            <p>Berikut adalah kode PIN Anda untuk login:</p>

            <div class="pin-code">{{ $pin }}</div>

            <p>Silakan gunakan PIN ini untuk masuk ke akun Anda. Gunakan PIN ini untuk login ke Aplikasi Seudati. Simpan dan Jaga PIN ini.</p>

            <!-- <a href="https://example.com/login" class="btn">Login Sekarang</a> -->
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Jika Anda tidak meminta PIN ini, abaikan pesan ini.</p>
            <p>© 2024 Seudati Aceh. Semua hak dilindungi.</p>
        </div>
    </div>

</body>
</html>
