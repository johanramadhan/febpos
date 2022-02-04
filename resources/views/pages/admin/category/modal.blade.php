<div class="modal fade" id="modal-primary">
  <div class="modal-dialog modal-xl">
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="modal-content bg-default">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kategori</h4>
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
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Kategori</label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Nama Kategori"
                            required
                          />
                        </div>
                        <!-- /.Nama Kategori -->             
                        <div class="form-group">
                          <label>Icon</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input
                                type="file"
                                class="custom-file-input"
                                name="photo"
                                required
                              />
                              <label
                                class="custom-file-label"
                                for="exampleInputFile"
                                >Pilih Icon</label
                              >
                            </div>
                          </div>
                        </div>
                        <!-- /.Nama Icon -->             
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