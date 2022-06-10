@extends('layout.main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary float-right mb-3 btn-sm mr-3 px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>   
        <div class="table-responsive">
            <table class="table table-" id="dataTable"  cellspacing="0" > 
                
                    
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NamaGuru</th>
                        <th>Nik Guru</th>
                        <th>MataPelajaran</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama_guru }}</td>
                        <td>{{ $row->nik_guru }}</td>
                        <td>{{ $row->mapel->nama_mapel }}</td>
                        <td>{{ $row->user->username }}</td>
                        <td>{{ $row->user->password }}</td>
                        <td>
                            {{-- <button type="button" class="btn btn-warning  btn-sm px-3 mr-1" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                Edit
                            </button>    --}}
                            <a href="/editguru/{{ $row->id }}" class="btn btn-warning btn-sm mb-1 d-block">Edit</a>
                            <a href="/deleteguru/{{ $row->id }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/tambahguru" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_guru" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control @error('nama_guru') @enderror" id="nama_guru" 
                        name="nama_guru">
                        @error('nama_guru')
                            <div class="invalid-feedback">
                                {{ $messege }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nik_guru" class="form-label">NIK Guru</label>
                        <input type="text" class="form-control @error('nik_guru') @enderror" id="nik_guru"
                        name="nik_guru">
                        @error('nik_guru')
                            <div class="invalid-feedback">
                                {{ $messege }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                        <input list="browsers2" name="mapel_id" class="form-control @error('mapel_id') @enderror" id="mapel_id">
                        @foreach($mapel as $datamapel)
                        <datalist id="browsers2">
                              <option value="{{$datamapel->id}}">{{$datamapel->nama_mapel}}</option>
                        @endforeach
                        @error('mapel_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Username</label>
                        <input list="browsers" name="user_id"  class="form-control @error('user_id') @enderror" id="user_id">
                        @foreach($user as $data)
                        <datalist id="browsers">
                              <option value="{{$data->id}}">{{$data->username}}</option>
                        @endforeach
                        @error('user_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mengedit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updateguru/{{ $data->id }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Guku</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="nama_guru">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">NIK Guru</label>
                        <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp"
                            name="nik_guru">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp"
                            name="mata_pelajaran">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail4" class="form-label">mapelname</label>
                        <input type="text" class="form-control" id="exampleInputEmail4" aria-describedby="emailHelp"
                            name="username">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail5" class="form-label">Password</label>
                        <input type="text" class="form-control" id="exampleInputEmail5" aria-describedby="emailHelp"
                            name="password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}