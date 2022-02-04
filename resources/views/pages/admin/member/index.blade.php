@extends('layouts.admin')

@section('title')
    Member
@endsection

@push('addon-style')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

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
            <h1>Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Member</li>
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
                <h3 class="card-title">Data Member</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-primary">
                      + Member
                    </button>
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Member</th>
                        <th class="text-center">Tipe Member</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">No HP</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Alamat</th> 
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($members as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->code }}</td>
                          <td class="text-center">
                            @if (($item->type) == 1)
                              <span class="badge badge-success">Gold</span>
                            @else
                              <span class="badge badge-primary">Silver</span>
                            @endif
                          </td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->phone }}</td>
                          <td class="text-center">
                            @if (($item->gender ) === 1)
                              <span class="badge badge-success">Laki-laki</span>
                            @elseif (($item->gender ) === 2)
                              <span class="badge badge-primary">Perempuan</span>
                            @else
                              <span class="badge badge-danger">Others</span>
                            @endif 
                          </td>
                          <td>{{ $item->address }}</td>
                          <td>{{ $item->description }}</td>
                          <td>
                            <a href="{{ route('member.edit', $item->id) }}" class="btn btn-xs btn-info">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('member.destroy', $item->id) }}" method="POST" class="d-inline">
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

  @include('pages.admin.member.modal')
@endsection

@push('addon-script')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
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
