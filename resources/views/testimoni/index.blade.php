@extends('layouts/app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Testimoni</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Testimoni</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <div class="text-end upgrade-btn">
                    <a href="{{ route('testimoni.create') }}" class="btn btn-success d-none d-md-inline-block text-white">
                        <i class="fas fa-plus"></i>&nbsp;
                        Add Testimoni</a>
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
                <h4 class="card-title mb-3">Data Testimoni</h4>
                <div class="table-responsive">
                    <table id="datatable1" class="table user-table no-wrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">No.</th>
                                <th class="border-top-0" width="10%">Image Testimoni</th>
                                <th class="border-top-0">Order</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimoni as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm btn-modal-image"
                                            href="{{ asset('testimoni/' . $row->image) }}" target="_blank">
                                            Lihat
                                        </a>
                                    </td>
                                    <td>{{ $row->order }}</td>
                                    <td>
                                        <span
                                            class="btn btn-{{ $row->status == 1 ? 'success' : 'danger' }} btn-sm btn-flat"
                                            style="color: white; font-size: 12px">
                                            {{ $row->status == 1 ? 'ACTIVE' : 'NON-ACTIVE' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('testimoni.edit', ['testimoni' => $row->id]) }}"
                                            class="btn btn-warning btn-sm btn-flat mr-2"><i class="fas fa-pencil-alt"></i>
                                            Edit</a>
                                        <button class="button-delete btn btn-danger btn-sm btn-flat mr-2"
                                            data-id="{{ $row->id }}" style="color: white"><i
                                                class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
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
            form.attr('action', "{{ url('/admin/testimoni') }}/" + id);

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
