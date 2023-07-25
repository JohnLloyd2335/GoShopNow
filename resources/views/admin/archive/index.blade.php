@extends('admin.layouts.sidebar')
@section('title', 'Archive')
@section('content')

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Manage Archive Products</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('archives.index') }}">Archive Products</a></li>
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Start Page Content -->
        <a class="btn btn-success text-light font-weight-bold" href="{{ route('products.create') }}">
            Add Product
        </a>
        <div class="mt-4">
            <table class="table table-bordered w-100" id="archiveDataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Image</th>
                       
                        <th>Price</th>
                        <th>Stock</th>
                        {{-- <th>Stock</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#archiveDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('archives.index') }}",
            columns: [
                {data: 'id', name: 'products.id'},
                {data: 'category.name', name: 'category.name'},
                {data: 'brand.name', name: 'brand.name'},
                {data: 'name', name: 'products.name'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'price', name: 'products.price'},
                {data: 'stock', name: 'stock', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

@endsection
