@extends('layouts.admin')

@section('title')
    Pembelian
@endsection

@push('addon-style')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

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
            <h1>Transaksi Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Transaksi Pembelian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <hr>
                <div class="row">
                  <div class="col-12 text-right">
                    <h3>INVOICE <b>{{ $codePembelian }}</b></h3>
                  </div>
                  <div class="col-6">
                    <h1>Total (Rp)</h1>
                  </div>
                  <div class="col-6 text-right tampil-bayar"></div>
                  <div class="col-12 text-right tampil-terbilang"></div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>          
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <form action="{{ route('pembelian_detail.store') }}" class="form-forizontal" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-4">
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Supplier</label>
                         <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ $supplier->name }}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ $supplier->address }}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ $supplier->phone }}" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilih BB</label>
                        <div class="col-sm-9 input-group">
                          <input type="hidden" class="form-control" name="id_produk" id="id_produk">
                          <input type="hidden" class="form-control" name="id_pembelian" value="{{ $id_pembelian }}" readonly>
                          <input type="text" class="form-control" name="code" id="code" readonly>
                          <span class="input-group-append">
                            <button onclick="tampilProduk()" type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Qty</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" name="jumlah" id="qty" placeholder="Jumlah">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Berat Satuan</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" name="berat" id="berat" placeholder="Berat" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">                          
                          <input type="text" class="form-control" id="name_product" placeholder="Nama Produk" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="harga_beli" id="harga_beli" readonly>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success float-right"><i class="fa fa-shopping-cart"></i>Tambah</button>
                    </div>
                  </div>
                </div>
                {{-- /.row --}}
              </form>
            </div>
            {{-- /.card --}}
          </div>
          {{-- .col-lg-12 --}}
        </div>
        {{-- /.row --}}
        <div class="row">
          <div class="col-lg-9">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-pembelian">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center" width="15%">Kode Produk</th>
                        <th class="text-center">Nama Item</th>
                        <th class="text-center" width="8%">Jumlah</th>
                        <th class="text-center">Harga Beli</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
              @csrf
              <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
              <input type="hidden" name="total" id="total">
              <input type="hidden" name="total_item" id="total_item">
              <input type="hidden" name="totalBerat" id="totalBerat">
              <input type="hidden" name="bayar" id="bayar">

              <div class="card">
                <div class="card-body">
                  {{-- User --}}
                  <div class="form-group row">
                    <label for="totalrp" class="col-lg-3 control-label">User</label>
                    <div class="col-lg-9">
                      <select class="form-control select2bs4" name="users_id" style="width: 100%;" required>
                        <option>--Pilih User--</option>
                        @foreach ($users as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  {{-- Tanggal Pembelian --}}
                  <div class="form-group row">
                    <label class="col-lg-3 control-label">Tanggal Pembelian</label>
                    <div class="col-lg-9">
                      <div class="input-group date" id="reservationdate" date-target-input="nearest">
                        <input type="text" 
                        class="form-control datetimepicker-input"  
                        data-inputmask-alias="datetime" 
                        data-inputmask-inputformat="dd/mm/yyyy" 
                        data-mask 
                        data-target="#reservationdate"
                        name="tgl_pembelian"
                        id="tgl_pembelian"
                        value="{{ date('Y-m-d') }}"
                        required/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- Total Pembelian  --}}
                  <div class="form-group row">
                    <label for="totalrp" class="col-lg-3 control-label">Total</label>
                    <div class="col-lg-9">
                        <input type="text" id="totalrp" class="form-control" readonly>
                    </div>
                  </div>
                  {{-- Diskon Pembelian --}}
                  <div class="form-group row">
                    <label for="diskon" class="col-lg-3 control-label">Diskon</label>
                    <div class="col-lg-9">
                        <input type="number" name="diskon" id="diskon" class="form-control" value="{{ $diskon }}">
                    </div>
                  </div>
                  {{-- Bayar --}}
                  <div class="form-group row">
                    <label for="bayar" class="col-lg-3 control-label">Bayar</label>
                    <div class="col-lg-9">
                        <input type="text" id="bayarrp" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-md float-right btn-simpan"><i class="fa fa-save"></i> Simpan Transaksi</button>
              </div>
            </form>
          </div>

        </div>
      </div>
      {{-- ./container-fluid --}}
    </section>
  </div>

  @includeIf('pages.admin.pembelian-detail.product')

@endsection

@push('addon-script')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
  <!-- date-range-picker -->
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

  <script>
    let table, table1;

    $(function () {
      $('body').addClass('sidebar-collapse');

      table = $('.table-pembelian').DataTable({
        processing: true,
        autoWidth: false,
        dom: 'Brt',
        bSort: false,
        ajax: {
              url: '{{ route('pembelian_detail.data', $id_pembelian) }}',
        },
        columns: [
            {class: 'text-center', data: 'DT_RowIndex', searchable: false, sortable: false},
            {class: 'text-center', data: 'codeProduk'},
            {class: 'text-center', data: 'namaProduk'},
            {class: 'text-center', data: 'jumlah'},
            {class: 'text-right', data: 'harga_beli'},
            {class: 'text-right', data: 'subtotal'},
            {class: 'text-center', data: 'aksi', searchable: false, sortable: false},
        ]
      })

      .on('draw.dt', function () {
          loadForm($('#diskon').val());
      });

      
      //Date range picker
      $('#reservationdate').datetimepicker({
          format: 'YYYY-MM-DD',
          autoclose: true
      });

      table1 = $('.table-produk').DataTable();

      $(document).on('input', '.quantity', function () {
            let id = $(this).data('id');
            let jumlah = parseInt($(this).val());
            
            if (jumlah < 1) {
                $(this).val(1);
                alert('Jumlah tidak boleh kurang dari 1');
                return;
            }
            if (jumlah > 10000) {
                $(this).val(10000);
                alert('Jumlah tidak boleh lebih dari 10.000');
                return;
            }

            $.post(`{{ url('/admin/data-transaction/pembelian_detail') }}/${id}`, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'put',
                'jumlah': jumlah
            })
            .done(response => {
                $(this).on('mouseout', function () {
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                });
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data jumlah');
                return;
            });
      });

      $(document).on('input', '#diskon', function () {
          if ($(this).val() == "") {
              $(this).val(0).select();
          }

          loadForm($(this).val());
      });

      $('.btn-simpan').on('click', function () {
            $('.form-pembelian').submit();
      });

    });

    function tampilProduk() {
      $('#modal-produk').modal('show');
    }

    function hideProduk() {
      $('#modal-produk').modal('hide');
    }

    function pilihProduk(id, code, name_prouct, harga_beli) {
        $('#id_produk').val(id);
        $('#code').val(code);
        $('#name_product').val(name_prouct);
        $('#harga_beli').val(harga_beli);
        $('#qty').val(1);
        hideProduk();
    }

    function deleteData(url) {
      if (confirm('Yakin ingin menghapus data terpilih?')) {
        $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
          })
          .done((response) => {
              table.ajax.reload();
          })
          .fail((errors) => {
              alert('Tidak dapat menghapus data');
              return;
          });
      }
    }

    function loadForm(diskon = 0) {
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());

        $.get(`{{ url('admin/data-transaction/pembelian_detail/loadform') }}/${diskon}/${$('.total').text()}`)
            .done(response => {
                $('#totalrp').val('Rp'+ response.totalrp);
                $('#bayarrp').val('Rp'+ response.bayarrp);
                $('#bayar').val(response.bayar);
                $('.tampil-bayar').text('Rp. '+ response.bayarrp);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data2');
                return;
            })
    }


  </script>
@endpush
