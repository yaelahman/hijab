@extends('layouts.landing.app')
@section('content')
    <section id="faq" class="faq my-5" style="min-height: 500px;">
        <div class="container">
            <h2 class="mb-2">CARA ORDER</h2>
            <div class="card">
                <div class="card-body">
                    {!! $data->text !!}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('.easyimage img').attr('style', 'max-width: 100%')
    </script>
@endsection
