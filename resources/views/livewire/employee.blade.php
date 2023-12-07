<div class="container">
    <!-- START FORM -->
    @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    @endif


    <!-- AKHIR FORM -->

    <!-- START DATA -->

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h1>Data Pegawai</h1>
        <div class="row mb-3 mt-3">
            <div class="col-6">
                <input type="text"class='form-control mb-3' placeholder="Search...." wire:model.live='search_nama'>
            </div>
            <div class="col-6 d-flex flex-row-reverse">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah"> +
                    Tambah Data Pegawai</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-4">Nama</th>
                    <th class="col-md-3">Email</th>
                    <th class="col-md-2">Alamat</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataEmployee as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->alamat }}</td>
                        <td>
                            <a wire:click='edit({{ $value->id }})' class="btn btn-warning btn-sm">Edit</a>
                            <a wire:click='delete_confirm({{ $value->id }})' class="btn btn-danger btn-sm"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">Del</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $dataEmployee->links() }}
    </div>
    <!-- AKHIR DATA -->

    {{-- Modal Input data --}}
    <div class="modal fade" id="modal-tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal-tambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" wire:model='nama'>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" wire:model='email'>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" wire:model='alamat'>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="submit"
                        wire:click='clear()'>CLOSE</button>
                    @if ($updatedData == false)
                        <button type="button" class="btn btn-primary" name="submit"
                            wire:click='store()'>SIMPAN</button>
                    @else
                        <button type="button" class="btn btn-primary" name="submit"
                            wire:click='update()'>UPDATE</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        wire:click='delete()'>Ya</button>
                </div>
            </div>
        </div>
    </div>

</div>
