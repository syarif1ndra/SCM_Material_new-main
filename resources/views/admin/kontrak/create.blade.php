@extends('admin.dashboard')

@section('title', 'Kontrak')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kontrak Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-12">
        <h3 class="text-2xl font-semibold mb-6">Tambah Kontrak Baru</h3>

        <!-- Form untuk menambahkan kontrak baru -->
        <form action="{{ route('admin.kontrak.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="tanggal_mulai" class="block text-gray-700 font-bold mb-2">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            
            <div class="mb-4">
                <label for="tanggal_selesai" class="block text-gray-700 font-bold mb-2">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi:</label>
                <textarea name="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required></textarea>
            </div>
            
            <div class="mb-4">
                <label for="bukti_kontrak" class="block text-gray-700 font-bold mb-2">Bukti Kontrak:</label>
                <input type="file" name="bukti_kontrak" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                Tambah Kontrak
            </button>
        </form>
    </div>
</body>
</html>
@endsection