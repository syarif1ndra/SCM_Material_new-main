<!-- resources/views/user/pemasok/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Tambah Pemasok Baru</h1>

        <form action="{{ route('user.pemasok.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nama_pemasok">Nama Pemasok</label>
                <input type="text" class="form-control @error('nama_pemasok') is-invalid @enderror" id="nama_pemasok" name="nama_pemasok" value="{{ old('nama_pemasok') }}" required>
                @error('nama_pemasok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="kontak">Kontak</label>
                <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak') }}">
                @error('kontak')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="kontrak_id">Kontrak</label>
                <select class="form-control @error('kontrak_id') is-invalid @enderror" id="kontrak_id" name="kontrak_id" required>
                    <option value="">Pilih Kontrak</option>
                    @foreach($kontrak as $item)
                        <option value="{{ $item->id }}" {{ old('kontrak_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_kontrak }}</option>
                    @endforeach
                </select>
                @error('kontrak_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="rating_pemasok">Rating Pemasok</label>
                <input type="number" class="form-control @error('rating_pemasok') is-invalid @enderror" id="rating_pemasok" name="rating_pemasok" value="{{ old('rating_pemasok') }}" min="0" max="5">
                @error('rating_pemasok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('user.pemasok.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
