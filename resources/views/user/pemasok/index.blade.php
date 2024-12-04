<!-- resources/views/user/pemasok/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Daftar Pemasok</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('user.pemasok.create') }}" class="btn btn-primary mb-3">Tambah Pemasok</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pemasok</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th>Kontrak</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasok as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_pemasok }}</td>
                        <td>{{ $item->alamat ?? 'Tidak ada' }}</td>
                        <td>{{ $item->kontak ?? 'Tidak ada' }}</td>
                        <td>{{ $item->kontrak->nama_kontrak ?? 'Tidak ada' }}</td>
                        <td>{{ $item->rating_pemasok }}</td>
                        <td>
                            <a href="{{ route('pemasok.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pemasok.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemasok ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
