@extends('layout')

@section('main')
<table class="table table-bordered table-hover table-striped">
    <thead class="align-middle text-center text-nowrap">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Jumlah Per Pack</th>
            <th>Satuan Per Pack</th>
            <th>Stok Minimal</th>
        </tr>
    </thead>
    <tbody id="table-body" class="align-middle">
    </tbody>
</table>
<div class="text-end w-100">
    <button id="btn-save" class="btn btn-success" onClick="saveRow();" disabled>Simpan</button>
    <button id="btn-add-row" class="btn btn-primary" onClick="addRow();">+</button>
    <button id="btn-remove-row" class="btn btn-danger" onClick="removeRow();" disabled>-</button>
</div>
@endsection

@section('script')
<script>
    let tableBody = $('#table-body');
    let totalRow = 0;

    function addRow() {
        totalRow++;

        tableBody.append(``+
        `<tr id="row-`+totalRow+`">` +
            `<th>` +
                `<p id="nomor-`+totalRow+`" class="text-center">`+totalRow+`.</p>` +
            `</th>` +
            `<td>` +
                `<input type="text" id="input-nama-`+totalRow+`" class="form-control">` +
                `<p id="nama-`+totalRow+`"></p>` +
            `</td>` +
            `<td>` +
                `<input type="number" id="input-jumlah-per-pack-`+totalRow+`" class="form-control">` +
                `<p id="jumlah-per-pack-`+totalRow+`" class="text-center"></p>` +
            `</td>` +
            `<td>` +
                `<input type="number" id="input-satuan-per-pack-`+totalRow+`" class="form-control">` +
                `<p id="satuan-per-pack-`+totalRow+`" class="text-center"></p>` +
            `</td>` +
            `<td>` +
                `<input type="number" id="input-stok-minimal-`+totalRow+`" class="form-control">` +
                `<p id="stok-minimal-`+totalRow+`" class="text-center"></p>` +
            `</td>` +
        `</tr>`);

        if (totalRow == 1) {
            $('#btn-save').removeAttr('disabled');
            $('#btn-remove-row').removeAttr('disabled');
        }
    }

    function removeRow() {
        $('#row-'+totalRow).remove();

        totalRow--;

        if (totalRow == 0) {
            $('#btn-save').attr('disabled', 'disabled');
            $('#btn-remove-row').attr('disabled', 'disabled');
        }
    }

    function saveRow() {

        for (let i = 1; i <= totalRow; i++) {
            $.ajax({
                url: "/master/bahan-baku/storeAjax",
                type: "POST",
                data: {
                    'nama-item': $('#input-nama-'+i).val(),
                    'jumlah-per-pack': $('#input-jumlah-per-pack-'+i).val(),
                    'satuan-per-pack': $('#input-satuan-per-pack-'+i).val(),
                    'stok-minimal': $('#input-stok-minimal-'+i).val()
                },
                success: function (response) {
                    if (response) {
                        alert(response.success);
                    }
                }
            });
        }
    }
</script>
@endsection
