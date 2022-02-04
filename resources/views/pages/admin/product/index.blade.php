@extends('layouts.admin')

@section('title')
    Product
@endsection

@push('addon-style')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Product</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-primary">
                      + Product
                    </button>
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Product</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Diskon</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Berat</th> 
                        <th class="text-center">Satuan Berat</th> 
                        <th class="text-center">Merek</th> 
                        <th class="text-center">Harga Modal</th>
                        <th class="text-center">Harga Jual</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($products as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->code }}</td>
                          <td class="text-center">{{ $item->category->name }}</td>
                          <td>{{ $item->name_product }}</td>
                          <td>{{ $item->diskon }}%</td>
                          <td>{{ number_format($item->stok) }}</td>
                          <td>{{ $item->satuan }}</td>
                          <td>{{ $item->berat }}</td>
                          <td>{{ $item->satuan_berat }}</td>
                          <td>{{ $item->merk }}</td>
                          <td>Rp{{ number_format($item->harga_beli) }}</td>
                          <td>Rp{{ number_format($item->harga_jual) }}</td>
                          <td>
                            <a href="{{ route('product.edit', $item->id_produk) }}" class="btn btn-xs btn-info">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('product.destroy', $item->id_produk) }}" method="POST" class="d-inline">
                              @csrf
                              @method('delete')
                              <button class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                              </button>                                    
                            </form>
                          </td>
                        </tr>
                      @empty
                          
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>          
        </div>
      </div>
    </section>
  </div>

  @include('pages.admin.product.modal')
@endsection

@push('addon-script')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endpush
