@extends('layouts.landing.app')
@section('content')
    <!-- Products Start -->
    @if (Session::has('alert'))
        <div class="px-xl-5 mb-3">
            <div class="alert alert-{{ Session::get('alert') }}">
                {{ Session::get('message') }}
            </div>
        </div>
    @endif
    @if (!$detail)
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Semua Produk</span></h2>
            </div>
            <form action="" class="px-xl-5 mb-3">
                <div class="input-group">
                    <input type="text" class="form-control search-input" placeholder="Cari Produk">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
            <div id="product-list" class="row row-cols-md-5 row-cols-2 px-xl-5 pb-3">
            </div>
            <div class="d-flex justify-content-end">
                <nav class="px-xl-5 mb-5" aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link page-prev" href="#" data-page="prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link page-1" data-stay="true" data-page="1" href="#">1</a>
                        </li>
                        <li class="page-item"><a class="page-link page-2" data-stay="false" data-page="2"
                                href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link page-3" data-stay="false" data-page="3"
                                href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link page-next" href="#" data-page="next" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    @else
        <div class="container-fluid py-5">
            <div class="row px-xl-5">
                <div class="col-lg-5 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border">
                            @foreach ($product->ImageAll as $index => $item)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img class="w-100 h-100" src="{{ asset('products') }}/{{ $item->image }}"
                                        alt="Image">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-7 pb-5">
                    <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                        <small class="pt-1">({{ $product->Category->name }})</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">Rp. {{ number_format($product->harga, 0) }}</h3>
                    <form action="{{ route('add.cart') }}" method="post">
                        @csrf
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" name="jumlah" class="form-control bg-secondary text-center" value="1">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="id_product" value="{{ $product->id }}">
                            <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Tambah ke
                                keranjang</button>
                        </div>
                    </form>
                    <h4 class="mb-3">Produk Deskripsi</h4>
                    <p>
                        {{ $product->description }}
                    </p>
                </div>

            </div>
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Produk Lainnya</span></h2>
            </div>
            <div id="product-list" class="row row-cols-md-5 row-cols-2 px-xl-5 pb-3">
            </div>
        </div>
    @endif
    <!-- Products End -->


    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">{{ $settings['judul'] }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->



    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Testimoni</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach ($testimoni as $item)
                        <div class="vendor-item border p-4">
                            <img src="{{ asset('testimoni') }}/{{ $item->image }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keranjang Saya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (Session::has('cart'))
                        <form action="{{ route('add.cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="empty" value="true">
                            <button class="btn btn-danger w-100 mb-3">Kosongkan Keranjang</button>
                        </form>
                        <div class="row mx-1">
                            @foreach (Session::get('cart') as $item)
                                {{-- <div class="card product-item border-0 mb-4">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('products') }}/{{ $item['image'] }}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate text-muted mb-0">{{ $item['category'] }}</h6>
                                        <h6 class="text-truncate mb-3">{{ $item['name'] }}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>Rp. {{ number_format($item['harga'], 0) }}</h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border text-center">
                                        <h6 class="text-center mx-auto">
                                            Jumlah : {{ $item['jumlah'] }}
                                        </h6>
                                    </div>
                                </div> --}}
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{ asset('products') }}/{{ $item['image'] }}" width="100%"
                                                alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item['name'] }}</h5>
                                                <p class="card-text">{{ $item['category'] }}</p>
                                                <p class="card-text">Rp. {{ number_format($item['harga'], 0) }}</p>
                                                <p class="card-text"><small class="text-muted">Jumlah :
                                                        {{ $item['jumlah'] }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        KERANJANG KOSONG
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    @if (Session::has('cart'))
                        <form action="{{ route('add.cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="checkout" value="true">
                            <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <form id="cart" action="{{ route('add.cart') }}" method="post">
        @csrf
        <input type="hidden" id="id_product" name="id_product">
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        var input_category = null;
        $(document).on('click', '.navbar-vert', function(){
            $('#btn-parent').trigger('click')
            $('.kategori-text').html($(this).attr('data-name'))
            input_category = $(this).attr('data-id')
            fetchProducts({})
        })
        const fetchProducts = async ({
            search = null,
            page = 1
        }) => {
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $('#product-list').html(`
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <circle cx="50" cy="50" fill="none" stroke="#d19c97" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </circle>
            </svg>
            `)

            await $.ajax({
                url: "{{ route('fetch.products') }}",
                type: "GET",
                data: {
                    search: search,
                    page: page,
                    category: input_category
                }
            }).then((resp) => {
                let data = resp.data.data
                if (data.length < 1) {
                    $('#product-list').html('<h6 class="text-center my-3">PRODUK TIDAK DITEMUKAN!</h6>')
                } else {
                    $('#product-list').html('')
                }
                data.map((row, index) => {
                    $('#product-list').append(`
                    <div class="col">
                        <div class="card product-item border-0 h-100 pb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{ asset('products') }}/${row.image != null ? row.image.image : null}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate text-muted mb-0">${row.category.name}</h6>
                                <h6 class="text-truncate mb-3">${row.name}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>Rp. ${numberWithCommas(row.harga)}</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{ url('detail') }}/${row.id}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                        Detail</a>
                                <a href="#" data-id="${row.id}" onclick="addToCart(event, ${row.id})" class="btn btn-cart btn-sm text-dark p-0"><i
                                        class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    `)

                })
            }).catch((err) => {
                console.log(err)

                $('#product-list').html(
                    '<h6 class="text-center my-3">TERJADI KESALAHAN SAAT MENGAMBIL DATA PRODUK!</h6>')
            })
        }

        fetchProducts({})
        let search = ''
        $('.search-input').on('keyup', function() {
            search = $(this).val()
            fetchProducts({
                search: $(this).val()
            })

            $('.page-1').html(1)
            $('.page-1').attr('data-page', 1)
            $('.page-2').html(2)
            $('.page-2').attr('data-page', 2)
            $('.page-3').html(3)
            $('.page-3').attr('data-page', 3)
        })

        $('.page-link').on('click', function(e) {
            e.preventDefault()
            let page = $(this).attr('data-page')
            let check = page

            if (page == 'prev') {
                page = parseInt($('.page-1').attr('data-page')) - ($('.page-1').attr('data-page') != "1" ? 1 : 0)
            } else if (page == 'next') {
                page = parseInt($('.page-1').attr('data-page')) + 1
            }

            fetchProducts({
                search: search,
                page: page
            })
            if ($(this).attr('data-stay') == "false" || ['prev', 'next'].includes(check)) {
                if (check == 'prev') {
                    if ($('.page-1').attr('data-page') != "1") {
                        $('.page-1').html(parseInt($('.page-1').attr('data-page')) - 1)
                        $('.page-1').attr('data-page', parseInt($('.page-1').attr('data-page')) - 1)
                        $('.page-2').html(parseInt($('.page-2').attr('data-page')) - 1)
                        $('.page-2').attr('data-page', parseInt($('.page-2').attr('data-page')) - 1)
                        $('.page-3').html(parseInt($('.page-3').attr('data-page')) - 1)
                        $('.page-3').attr('data-page', parseInt($('.page-3').attr('data-page')) - 1)
                    }
                } else {
                    $('.page-1').html(parseInt($('.page-1').attr('data-page')) + 1)
                    $('.page-1').attr('data-page', parseInt($('.page-1').attr('data-page')) + 1)
                    $('.page-2').html(parseInt($('.page-2').attr('data-page')) + 1)
                    $('.page-2').attr('data-page', parseInt($('.page-2').attr('data-page')) + 1)
                    $('.page-3').html(parseInt($('.page-3').attr('data-page')) + 1)
                    $('.page-3').attr('data-page', parseInt($('.page-3').attr('data-page')) + 1)
                }
            }
        })

        function addToCart(e, id) {
            e.preventDefault()

            $('#id_product').val(id)
            $('#cart').submit()
        }
    </script>
@endsection
