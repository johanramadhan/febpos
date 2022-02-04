@extends('layouts.admin')

@section('title')
    Pembelian
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
            <h1>Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Pembelian</li>
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
                <h3 class="card-title">Data Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-supplier">
                      + Transaksi Pembelian
                    </button>
                    @empty(! session('id_pembelian'))
                    <a href="{{ route('pembelian_detail.index') }}" class="btn btn-danger mb-2 ml-2"> Transaksi Aktif</a>
                    @endempty
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Pembelian</th>
                        <th class="text-center">Tanggal Pembelian</th>
                        <th class="text-center">Supplier</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Total Item</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center">Diskon</th> 
                        <th class="text-center">Bayar</th> 
                        <th class="text-center">Status</th> 
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($pembelians as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->code }}</td>
                          <td>{{ date('d-M-Y', strtotime($item->tgl_pembelian)) }}</td>
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
                            <a href="{{ route('pembelian.edit', $item->id_pembelian) }}" class="btn btn-xs btn-info">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('pembelian.destroy', $item->id_pembelian) }}" method="POST" class="d-inline">
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

  @include('pages.admin.pembelian.modal')
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
      $('.table-supplier').DataTable();
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
