@extends('layouts/app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Checkout</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Data Checkout</h4>
                <div class="table-responsive">
                    <table id="datatable1" class="table user-table no-wrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">No.</th>
                                <th class="border-top-0">No Order</th>
                                <th class="border-top-0">Bukti</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkout as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->trx_no }}</td>
                                    <td>
                                        @if (!$row->image)
                                            BELUM MELAKUKAN PEMBAYARAN
                                        @else
                                            <a class="btn btn-primary btn-sm btn-modal-image"
                                                href="{{ asset('bukti/' . $row->image) }}" target="_blank">
                                                Lihat
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="button-delete btn btn-danger btn-sm btn-flat mr-2"
                                            data-id="{{ $row->id }}" style="color: white"><i
                                                class="fas fa-trash-alt"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form id="form-delete" action="" method="post" class="d-none">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.button-delete').click(function() {
            var id = $(this).attr('data-id');
            var form = $('#form-delete');
            form.attr('action', "{{ url('/admin/checkout') }}/" + id);

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
