@extends('layout')

@section('main')
    <p class="fs-3 fw-bold m-0 text-secondary">User</p>
    <p class="fs-6 m-0 text-secondary">Master / <span class="text-dark">User</span></p>

    <div class="pt-4 row">
        <div class="col-12 col-lg-6 p-0">
            <div class="card">
                <div class="card-body shadow">
                    <p class="fw-bold fs-5 m-0 text-secondary">Tambah Data User</p>
                    <div class="mt-2">
                        <form action="/master/user/store" method="POST">
                            @csrf
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" maxlength="255" required>
                            {{-- <label for="email" class="col-form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" maxlength="255" required> --}}
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" maxlength="255"
                                required>
                            <label for="role" class="col-form-label">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                @if (count($data_role) > 0)
                                    @foreach ($data_role as $data)
                                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">-- Data Role Tidak Tersedia --</option>
                                @endif
                            </select>
                            <button class="btn btn-success mt-2 w-100">Simpan</button>
                            <input type="reset" class="btn btn-danger mt-2 w-100" value="Bersihkan">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-0 py-4 table-responsive">
        <table id="table-data" class="table table-bordered table-striped table-hover">
            <thead class="align-middle text-center text-nowrap">
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    {{-- <th>Email</th> --}}
                    <th>Password</th>
                    <th>Role</th>
                    @foreach ($data_user as $data)
                        @if ($data->role != 'Owner')
                            <th>Opsi</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody class="align-middle">
                @if (count($data_user) > 0)
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($data_user as $data)
                        @if ($data->role != 'Owner')
                            <tr>
                                <td class="text-center">{{ ++$i . '.' }}</td>
                                <td>
                                    <div id="data-username-{{ $data->id }}">{{ $data->name }}</div>
                                    <input type="username" id="edit-username-{{ $data->id }}"
                                        name="edit-username-{{ $data->id }}" class="d-none form-control"
                                        value="{{ $data->name }}" maxlength="255" required>
                                </td>
                                {{-- <td>
                                    <div id="data-email-{{ $data->id }}">{{ $data->email }}</div>
                                    <input type="email" id="edit-email-{{ $data->id }}"
                                        name="edit-email-{{ $data->id }}" class="d-none form-control"
                                        value="{{ $data->email }}" maxlength="255" required>
                                </td> --}}
                                <td class="text-center">
                                    <div id="data-password-{{ $data->id }}" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 150px;">{{ $data->password }}</div>
                                    <input type="password" id="edit-password-{{ $data->id }}"
                                        name="edit-password-{{ $data->id }}" class="d-none form-control"
                                        value="{{ $data->password }}" maxlength="255" required>
                                </td>
                                <td class="text-center">
                                    <div id="data-role-{{ $data->id }}">{{ $data->role }}</div>
                                    <select name="edit-role-{{ $data->id }}" id="edit-role-{{ $data->id }}"
                                        class="d-none form-select">
                                        @if (count($data_role) > 0)
                                            @foreach ($data_role as $item)
                                                @if ($item->name == $data->role)
                                                    <option value="{{ $item->name }}" selected>{{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="">-- Data Role Tidak Tersedia --</option>
                                        @endif
                                    </select>
                                </td>
                                <td class="text-center text-nowrap">
                                    <button id="terapkan-{{ $data->id }}" class="btn btn-success d-none px-3"
                                        onclick="terapkanData({{ $data->id }})"><i
                                            class="fas fa-check"></i>&ensp;Terapkan</button>
                                    <button id="ubah-{{ $data->id }}" class="btn btn-warning px-3"
                                        onclick="ubahData({{ $data->id }})"><i
                                            class="fas fa-edit"></i>&ensp;Ubah</button>
                                    <button id="hapus-{{ $data->id }}" class="btn btn-danger px-3"
                                        onclick="hapusData({{ $data->id }})"><i
                                            class="fas fa-trash"></i>&ensp;Hapus</button>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="text-center">{{ ++$i . '.' }}</td>
                                <td>
                                    <div id="data-username-{{ $data->id }}">{{ $data->name }}</div>
                                </td>
                                {{-- <td>
                                    <div id="data-email-{{ $data->id }}">{{ $data->email }}</div>
                                </td> --}}
                                <td class="text-center">
                                    <div id="data-password-{{ $data->id }}" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 150px;">{{ $data->password }}</div>
                                </td>
                                <td class="text-center">
                                    <div id="data-role-{{ $data->id }}">{{ $data->role }}</div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function ubahData(id) {
            $('#data-username-' + id).addClass('d-none');
            // $('#data-email-' + id).addClass('d-none');
            $('#data-password-' + id).addClass('d-none');
            $('#data-role-' + id).addClass('d-none');

            $('#edit-username-' + id).removeClass('d-none');
            // $('#edit-email-' + id).removeClass('d-none');
            $('#edit-password-' + id).removeClass('d-none');
            $('#edit-role-' + id).removeClass('d-none');

            $('#ubah-' + id).addClass('d-none');
            $('#terapkan-' + id).removeClass('d-none');
        }

        function simpanData() {
            $.ajax({
                url: '/master/user/store',
                type: 'POST',
                data: {
                    name: $('#username').val(),
                    // email: $('#email').val(),
                    password: $('#password').val(),
                    role: $('#role').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    } else if (response.code == 406) {
                        alert("Pendaftaran gagal");
                    } else if (response.code == 407) {
                        alert("Akun sudah terdaftar")
                    }
                }
            })
        }

        function terapkanData(id) {
            $.ajax({
                url: '/master/user/update',
                type: 'POST',
                data: {
                    id: id,
                    name: $('#edit-username-' + id).val(),
                    // email: $('#edit-email-' + id).val(),
                    password: $('#edit-password-' + id).val(),
                    role: $('#edit-role-' + id).val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#data-username-' + id).html($('#edit-username-' + id).val());
                        // $('#data-email-' + id).html($('#edit-email-' + id).val());
                        $('#data-password-' + id).html($('#edit-password-' + id).val());
                        $('#data-role-' + id).html($('#edit-role-' + id).val());


                        $('#edit-username-' + id).addClass('d-none');
                        // $('#edit-email-' + id).addClass('d-none');
                        $('#edit-password-' + id).addClass('d-none');
                        $('#edit-role-' + id).addClass('d-none');

                        $('#data-username-' + id).removeClass('d-none');
                        // $('#data-email-' + id).removeClass('d-none');
                        $('#data-password-' + id).removeClass('d-none');
                        $('#data-role-' + id).removeClass('d-none');

                        $('#ubah-' + id).removeClass('d-none');
                        $('#terapkan-' + id).addClass('d-none');
                    }
                }
            })
        }

        function hapusData(id) {
            $.ajax({
                url: '/master/user/delete/' + id,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    }
                }
            })
        }
    </script>
@endsection
