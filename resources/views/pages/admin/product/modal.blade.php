<div class="modal fade" id="modal-primary">
  <div class="modal-dialog modal-xl">
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="modal-content bg-default">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Product</h4>
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
                          <label>Kode Product</label>
                          <input
                            type="text"
                            name="code"
                            class="form-control"
                            placeholder="Kode Product"
                            value="{{ $code }}"
                            required
                            readonly
                          />
                        </div>
                        <!-- /.Kode Product -->             
                        <div class="form-group">
                          <label>Nama Product*</label>
                          <input
                            name="name_product"
                            id="name_product"
                            class="form-control"
                            placeholder="Nama Product"
                            required
                          />
                        </div>
                        <!-- /.Nama Product -->             
                        <div class="form-group">
                          <label>Kategori*</label>
                          <select name="categories_id" class="form-control select2" required>
                            <option>--Pilih Kategori--</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>                            
                        </div>
                        <!-- /.Kategori -->           
                        <div class="form-group">
                          <label>Satuan Product*</label>
                          <select name="satuan" class="form-control select2" required>
                            <option>--Pilih Satuan Product--</option>
                            @include('pages.satuan')
                          </select>                            
                        </div>
                        <!-- /.Satuan Product -->           
                        <div class="form-group">
                          <label>Satuan Berat*</label>
                          <select name="satuan_berat" class="form-control select2" required>
                            <option>--Pilih Satuan Berat--</option>
                            <option value="gram">Gram</option>
                            <option value="kilogram">Kilogram</option>
                          </select>                            
                        </div>
                        <!-- /.Satuan Product -->           
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
                              value="0"
                            />
                            <div class="input-group-prepend">
                              <span class="input-group-text">%</span>
                            </div>
                          </div>
                        </div>
                        <!-- /.Diskon -->
                        <div class="form-group">
                          <label>Harga Beli*</label>
                          <input
                            type="number"
                            name="harga_beli"
                            class="form-control"
                            placeholder="Harga Beli"
                            required
                          />
                        </div>
                        <!-- /.Harga Beli -->
                        <div class="form-group">
                          <label>Harga Jual</label>
                          <input
                            type="number"
                            name="harga_jual"
                            class="form-control"
                            placeholder="Harga Jual"
                            required
                          />
                        </div>
                        <!-- /.Harga Jual -->
                        <div class="form-group">
                          <label>Merek*</label>
                          <input
                            name="merk"
                            type="text"
                            class="form-control"
                            placeholder="Merek"
                            required
                          />
                        </div>
                        <!-- /.Merek --> 
                        <div class="form-group">
                          <label>Stok*</label>
                          <input
                            type="number"
                            name="stok"
                            class="form-control"
                            placeholder="Stok"
                            required
                          />
                        </div>
                        <!-- /.Stok -->
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