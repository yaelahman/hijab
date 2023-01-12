@extends('layouts/app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Product</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <div class="text-end upgrade-btn">
                    <a href="{{ route('product.index') }}" class="btn btn-success d-none d-md-inline-block text-white">
                        <i class="fas fa-bars"></i>&nbsp;
                        List Product</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material mx-2" method="post"
                    action="{{ route('product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12 mb-0">Nama</label>
                        <div class="col-md-12">
                            <input type="text" id="name" name="name" required placeholder="Seblak"
                                value="{{ $product->name }}" class="form-control ps-0 form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 mb-0">Kategori</label>
                        <div class="col-md-12">
                            <select name="id_category" id="id_category" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $product->id_category ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 mb-0">Deskripsi</label>
                        <div class="col-md-12">
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" value="......"
                                required>{{ $product->description }}</textarea>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-md-12 mb-0">No WhatsApp</label>
                        <div class="col-md-12">
                            <input type="number" id="whatsapp" name="whatsapp" required placeholder="0857xxx"
                                value="{{ $product->whatsapp }}" class="form-control ps-0 form-control-line">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-md-12 mb-0">Harga Barang</label>
                        <div class="col-md-12">
                            <input type="number" id="harga" name="harga" required placeholder="0"
                                value="{{ $product->harga }}" class="form-control ps-0 form-control-line">
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary addImageButton"><i class="fas fa-plus"></i>&nbsp;Tambah
                        Gambar
                        Produk
                    </button>

                    <div class="file-form-list">
                        @foreach ($productImage as $index => $item)
                            <div class="row form-image-{{ $index }}">
                                <div class="col-sm-6">
                                    <div class="form-group mt-3">
                                        <div class="col-md-12">
                                            <input type="file" id="image" onchange="preview({{ $index }})"
                                                name="image[]" class="form-control ps-0 form-control-line">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="btn-group">
                                        <a href="{{ asset('products/' . $item->image) }}"
                                            class="btn btn-info mt-3 lihat-gambar-{{ $index }}" target="_blank"><i
                                                class="fas fa-eye"></i>&nbsp;Lihat
                                            Gambar</a>
                                        &nbsp;
                                        <button type="button" class="btn btn-danger mt-3"
                                            onclick="deleteFormImage({{ $index }})"><i
                                                class="fas fa-trash"></i>&nbsp;Hapus
                                            Gambar</button>
                                    </div>
                                </div>
                                <input type="hidden" name="exceptImage[]" value="{{ $item->id }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group mt-3">
                        <div class="col-sm-12 d-flex">
                            <button class="btn btn-success mx-auto mx-md-0 text-white">Save Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        let index = parseInt("{{ count($productImage) }}")
        $('.addImageButton').on('click', function() {
            $('.file-form-list').append(`
            <div class="row form-image-${index}">
                <div class="col-sm-6">
                    <div class="form-group mt-3">
                        <div class="col-md-12">
                            <input type="file" id="image" onchange="preview(${index})" name="image[]" required
                                class="form-control ps-0 form-control-line">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group">
                        <a href="#" class="btn btn-info mt-3 d-none lihat-gambar-${index}" target="_blank"><i class="fas fa-eye"></i>&nbsp;Lihat
                            Gambar</a>
                        &nbsp;
                        <button type="button" class="btn btn-danger mt-3" onclick="deleteFormImage(${index})"><i class="fas fa-trash"></i>&nbsp;Hapus
                            Gambar</button>
                    </div>
                </div>
            </div>
            `)
            index++
        })

        function preview(index) {
            console.log(event.target.files)
            $('.lihat-gambar-' + index).removeClass('d-none')
            $('.lihat-gambar-' + index).attr('href', URL.createObjectURL(event.target.files[0]))
        }

        $('#image').on('change', function(e) {
            console.log(e.target.files[0])
        })

        function deleteFormImage(indexNow) {
            $('.form-image-' + indexNow).remove()
        }
    </script>
@endsection
