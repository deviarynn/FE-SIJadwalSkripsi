<!DOCTYPE html>
<html>
<head>
    <title>Detail Mahasiswa {{ $unduhMahasiswa->npm ?? 'N/A' }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', sans-serif;
            margin: 40px;
            color: #333;
            line-height: 1.6;
        }
        h1 {
            color: #2c3e50;
            font-size: 28px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Menghilangkan spasi antar sel */
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 12px 15px; /* Padding di dalam sel */
            border: 1px solid #ddd; /* Border tipis untuk sel */
            text-align: left;
            vertical-align: top;
        }
        table th {
            background-color: #f8f8f8; /* Warna latar belakang untuk header */
            color: #555;
            font-weight: 600;
            width: 30%; /* Berikan lebar tetap untuk kolom label */
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9; /* Warna latar belakang bergantian untuk baris */
        }
        table tr:hover {
            background-color: #f1f1f1; /* Efek hover (mungkin tidak terlalu terlihat di PDF, tapi baik untuk kebiasaan) */
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Data Mahasiswa</h1>

        <table>
            <tbody>
                <tr>
                    <th>NPM</th>
                    <td>{{ $unduhMahasiswa->npm ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>{{ $unduhMahasiswa->nama_mahasiswa ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>{{ $unduhMahasiswa->program_studi ?? 'N/A' }}</td>
                </tr><tr>
                    <th>Judul Skripsi</th>
                    <td>{{ $unduhMahasiswa->judul_skripsi ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $unduhMahasiswa->email ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Dokumen ini dihasilkan secara otomatis oleh Sistem Informasi Kehadiran.</p>
            <p>&copy; {{ date('Y') }} Aplikasi Anda</p>
        </div>
    </div>
</body>
</html>