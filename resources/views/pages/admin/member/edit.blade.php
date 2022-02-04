@extends('layouts.admin')

@section('title')
    Edit Member
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Member - {{ $item->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $item->name }}</li>
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
              <form action="{{ route('member.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Member</label>
                        <input
                          type="text"
                          name="code"
                          class="form-control"
                          placeholder="Kode Member"
                          value="{{ $item->code }}"
                          required
                          readonly
                        />
                      </div>
                      <!-- /.Kode Member --> 
                      <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" class="form-control" name="name" placeholder="Edit Nama Supplier" value="{{ $item->name }}">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Edit Email" value="{{ $item->email }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" name="phone" placeholder="Edit No HP" value="{{ $item->phone }}">
                      </div>
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <!-- select -->
                        <select class="form-control" name="gender">
                          <option value="{{ $item->gender }}">
                            @if (($item->gender) == 1)
                              <b>--Laki-laki--</b> 
                            @else
                              <b>--Perempuan--</b>
                            @endif
                          </option>
                          <option value="1">Laki-laki</option>
                          <option value="2">Perempuan</option>
                        </select>
                      </div>
                      <!-- /.Jenis Kelamin -->
                      <div class="form-group">
                        <label>Tipe Member</label>
                        <!-- select -->
                        <select class="form-control" name="type">
                          <option value="{{ $item->type }}">
                            @if (($item->type) == 1)
                              Gold 
                            @else
                              Silver
                            @endif
                          </option>
                          <option value="1">Gold</option>
                          <option value="2">Silver</option>
                        </select>
                      </div>
                      <!-- /.Tipe Member -->
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="address" placeholder="Edit Alamat Toko" value="{{ $item->address }}">
                      </div>
                      <label>Keterangan</label>
                      <textarea class="form-control" rows="3" placeholder="Keterangan" name="description">{{ $item->description }}</textarea>
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