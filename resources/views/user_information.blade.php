@extends('layouts.landing.app')
@section('content')
    @if (Session::has('alert'))
        <div class="px-xl-5 mb-3">
            <div class="alert alert-{{ Session::get('alert') }}">
                {{ Session::get('message') }}
            </div>
        </div>
    @endif
    <section id="faq" class="faq my-5" style="min-height: auto;">
        <div class="container">
            <h2 class="mb-2">DATA INFORMASI PEMBELI</h2>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive my-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $row)
                                    <tr>
                                        <td>{{ $row['name'] }}</td>
                                        <td>Rp {{ number_format($row['harga'], 0) }}</td>
                                        <td>{{ $row['jumlah'] }}</td>
                                        <td>
                                            <img src="{{ asset('products') }}/{{ $row['image'] }}" height="80px"
                                                alt="">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="name" placeholder="Robertoxxx" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input type="number" name="phone" placeholder="08xxx" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="10" placeholder="Jln xxxx" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary btn-sm w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
