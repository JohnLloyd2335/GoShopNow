@extends('customer.layouts.header-footer')
@section('title', 'My Orders')
@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="d-flex mb-2">
    <h6 class="mb-0">
        <a href="{{ route('home') }}" class="text-white-50">Home</a>
        <span class="text-white-50 mx-2"> > </span>
        <a href="{{ route('orders.index') }}" class="text-white-50">Orders</a>
    </h6>
</nav>
<!-- Breadcrumb -->
@endsection
@section('content')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<div class="container py-5">
  @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
  @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
  <div class="my-4">
      <h3>Orders</h3>
      <table class="table table-bordered w-100" id="orderDataTable">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Items</th>
                  <th>Amount</th>
                  <th>Payment Status</th>
                  <th>Order Status</th>
                  <th>Order Date</th>
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
  $('#orderDataTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('orders.index') }}",
      columns: [
          {data: 'id', name: 'orders.id'},
          {data: 'order_items', name: 'order_items', orderable: false, searchable: true},
          {data: 'amount', name: 'amount', orderable: false, searchable: false},
          {data: 'payment_status', name: 'payment_status', orderable: false, searchable: true},
          {data: 'status', name: 'order.status'},
          {data: 'order_date', name: 'order.date'},
          {data: 'actions', name: 'actions'}
          // {data: 'brand.name', name: 'brand.name'},
          // {data: 'name', name: 'products.name'},
          // {data: 'image', name: 'image', orderable: false, searchable: false},
          // {data: 'price', name: 'products.price'},
          // {data: 'stock', name: 'stock', orderable: false, searchable: false},
          // {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});
</script>

@endsection