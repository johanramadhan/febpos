<div class="modal fade" id="modal-primary">
  <div class="modal-dialog modal-xl">
    <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="modal-content bg-default">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="card card-primary">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Supplier</label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Nama Supplier"
                            required
                          />
                        </div>
                        <!-- /.Nama Supplier -->             
                        <div class="form-group">
                          <label>Email</label>
                          <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Email"
                          />
                        </div>
                        <!-- /.Email -->           
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>No HP</label>
                          <input
                            type="number"
                            name="phone"
                            class="form-control"
                            placeholder="Nomor HP"
                            required
                          />
                        </div>
                        <!-- /.Nomor HP -->
                        <div class="form-group">
                          <label>Alamat</label>
                          <input
                            type="text"
                            name="address"
                            class="form-control"
                            placeholder="Alamat Toko"
                            required
                          />
                        </div>
                        <!-- /.address -->
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Keterangan</label>
                          <textarea class="form-control" rows="3" placeholder="Keterangan" name="description"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->