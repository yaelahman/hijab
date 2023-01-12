@extends('layouts/app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">About US</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About US</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        @if (Session::has('alert'))
            <div class="alert alert-{{ Session::get('alert') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        {{-- <div class="card">
            <div class="card-body">
                {!! $settings->text !!}
            </div>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Setting About Us</h4>
                <form action="{{ route('aboutus.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ $settings->title }}</label>
                        <textarea id="konten" name="kolom" class="form-control" name="konten" rows="20"
                            cols="50">{{ $settings->text }}</textarea>
                        <input type="hidden" name="id" value="{{ $settings->id }}">
                    </div>
                    <button type="submit" class="btn btn-warning w-100 mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        var konten = document.getElementById("konten");
        CKEDITOR.replace(konten, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;
    </script>
    <script type="text/javascript">
        $('.button-delete').click(function() {
            var id = $(this).attr('data-id');
            var form = $('#form-delete');
            form.attr('action', "{{ url('/admin/category') }}/" + id);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    form.submit()
                }
            })
        });
    </script>
@endsection
