@extends('layouts.landing.app')
@section('content')
    <section id="faq" class="faq my-5" style="min-height: auto;">
        <div class="container">
            <h2 class="mb-2">UPLOAD BUKTI {{ $checkout->trx_no }}</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('checkout.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_checkout" value="{{ $checkout->id }}">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="image" onchange="preview(1)" accept="image/*"
                                    class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <a href="#" class="btn btn-info mb-3 d-none lihat-gambar-1" target="_blank"><i
                                class="fas fa-eye"></i>&nbsp;Lihat
                            Gambar</a>
                        <br>
                        <button class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        function preview(index) {
            console.log(event.target.files)
            $('.lihat-gambar-' + index).removeClass('d-none')
            $('.lihat-gambar-' + index).attr('href', URL.createObjectURL(event.target.files[0]))
        }

        $('#image').on('change', function(e) {
            console.log(e.target.files[0])
        })
    </script>
@endsection
