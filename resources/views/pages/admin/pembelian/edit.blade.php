@extends('layouts.admin')

@section('title')
    Edit Product
@endsection

@push('addon-style')
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
            <h1>Edit Product - {{ $item->name_product }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $item->name_product }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('product.update', $item->id_produk) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Product</label>
                        <input
                          type="text"
                          name="code"
                          class="form-control"
                          placeholder="Kode Product"
                          value="{{ $item->code }}"
                          required
                          readonly
                        />
                      </div>
                      <!-- /.Kode Product --> 
                      <div class="form-group">
                        <label>Nama Product*</label>
                        <input type="text" class="form-control" name="name_product" placeholder="Edit Nama Product" value="{{ $item->name_product }}" required>
                      </div>
                      <!-- /.Name Product -->
                      <div class="form-group">
                        <label>Kategori*</label>
                        <select name="categories_id" class="form-control select2" required>
                          <option value="{{ $item->categories_id }}">-- {{ $item->category->name }} --</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>                            
                      </div>
                      <!-- /.Kategori -->
                      <div class="form-group">
                        <label>Satuan Product*</label>
                        <select name="satuan" class="form-control select2" required>
                          <option value="{{ $item->satuan }}">-- {{ $item->satuan }} --</option>
                          @include('pages.satuan')
                        </select>                            
                      </div>
                      <!-- /.Satuan Product -->
                      <div class="form-group">
                        <label>Satuan Berat*</label>
                        <select name="satuan_berat" class="form-control select2" required>
                          <option value="{{ $item->satuan_berat }}">-- {{ $item->satuan_berat }} --</option>
                          <option value="gram">Gram</option>
                          <option value="kilogram">Kilogram</option>
                        </select>                            
                      </div>
                      <!-- /.Satuan Berat -->
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Diskon</label>
                        <div class="input-group">
                          <input
                            type="number"
                            name="diskon"
                            class="form-control"
                            placeholder="Diskon"
                            value="{{ $item->diskon }}"
                          />
                          <div class="input-group-prepend">
                            <span class="input-group-text">%</span>
                          </div>
                        </div>
                      </div>
                      <!-- /.Diskon -->
                      <div class="form-group">
                        <label>Harga Beli*</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input
                            type="number"
                            name="harga_beli"
                            class="form-control"
                            placeholder="Harga Beli"
                            value="{{ $item->harga_beli }}"
                            required
                          />
                        </div>
                      </div>
                      <!-- /.Harga Beli -->
                      <div class="form-group">
                        <label>Harga Jual*</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input
                            type="number"
                            name="harga_jual"
                            class="form-control"
                            placeholder="Harga Jual"
                            value="{{ $item->harga_jual }}"
                            required
                          />
                        </div>
                      </div>
                      <!-- /.Harga Jual -->
                      <div class="form-group">
                        <label>Merek*</label>
                        <input type="text" class="form-control" name="merk" placeholder="Edit Merek" value="{{ $item->merk }}" required>
                      </div>
                      <!-- /.Merek -->
                      <div class="form-group">
                        <label>Stok*</label>
                        <input type="number" class="form-control" name="stok" placeholder="Edit Stok" value="{{ $item->stok }}" required>
                      </div>
                      <!-- /.Stok -->
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="{{ route('member.index') }}" class="btn btn-default">Kembali</a>
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
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