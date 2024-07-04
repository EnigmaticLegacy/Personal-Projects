@extends('layouts.master')

@section('body')
@if ($message = Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
    {{$errors->first()}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif ($message = Session::has('no_download'))
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        {{ session('no_download') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="my-4 border rounded">
    <div class="modal-header">
        <h1 class="fw-bold">Upload File</h1>
    </div>

    <form action="upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="mb-3" id="item-report">
                <label for="csvitm" class="form-label">Input Item Report CSV File</label>
                <div class="row file-input" id="lb0">
                    <input class="form-control col-md-10" type="file" id="csvitm[0]" accept=".csv" name="csvitm[0]">
                    <button type="button" name="additm" id="additm" class="btn btn-outline-primary col-md-1 mx-lg-5">Add</button>
                </div>
            </div>
            <div class="mb-3" id="report1">
                <label for="csvrpt" class="form-label">Input Report1 CSV File</label>
                <div class="row file-input" id="pl0">
                    <input class="form-control col-md-10" type="file" id="csvrpt[0]" accept=".csv" name="csvrpt[0]">
                    <button type="button" name="addrpt" id="addrpt" class="btn btn-outline-primary col-md-1 mx-lg-5">Add</button>
                </div>
            </div>
            <div class="mb-3" id="report2">
                <label for="csvrpt" class="form-label">Input Report2 CSV File</label>
                <div class="row file-input" id="pla0">
                    <input class="form-control col-md-10" type="file" id="csvrpta[0]" accept=".csv" name="csvrpta[0]">
                    <button type="button" name="addrpta" id="addrpta" class="btn btn-outline-primary col-md-1 mx-lg-5">Add</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@if (session('success') or session('no_download'))
<form action="download" method="POST">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-sm-2">
            <label for="total_harga" class="col-form-label">Total harga : </label>
        </div>
        <div class="col-sm-4">
            <input type="text" id="total_harga" class="form-control" name="total_harga" required>
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-sm-2">
            <label for="total_saldo" class="col-form-label">Total Saldo : </label>
        </div>
        <div class="col-sm-4">
            <input type="text" id="total_saldo" class="form-control" name="total_saldo" required>
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-sm-2">
            <label for="total_qty" class="col-form-label">total Quantity : </label>
        </div>
        <div class="col-sm-4">
            <input type="text" id="total_qty" class="form-control" name="total_qty" required>
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-sm-2">
            <label for="export_option" class="col-form-label">Export As : </label>
        </div>
        <div class="col-sm-4">
            <select id="inputState" name="export_option" class="form-control">
                <option selected>Choose...</option>
                <option value="download">Download</option>
                <option value="array">Array</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Export Results</button>
</form>

@if ($message = Session::has('array_export'))
    <div><pre> {{ session('array_export') }} </pre></div>
@endif
@endif
<script type="text/javascript">
    var lb = 0
    $("#additm").click(function() {
        ++lb;
        $("#item-report").append('<div class="row file-input" id="lb'+lb+'"> <input class="form-control col-md-10" type="file" id="csvitm['+lb+']" accept=".csv" name="csvitm['+lb+']"> <button type="button" class="btn btn-outline-danger col-md-1 mx-lg-5 remove-field">Remove</button></div>')
    });
    var pl = 0
    $("#addrpt").click(function() {
        ++pl;
        $("#report1").append('<div class="row file-input" id="pl'+pl+'"> <input class="form-control col-md-10" type="file" id="csvrpt['+pl+']" accept=".csv" name="csvrpt['+pl+']"> <button type="button" class="btn btn-outline-danger col-md-1 mx-lg-5 remove-field">Remove</button></div>')
    });
    var pla = 0
    $("#addrpta").click(function() {
        ++pla;
        $("#report2").append('<div class="row file-input" id="pla'+pla+'"> <input class="form-control col-md-10" type="file" id="csvrpta['+pla+']" accept=".csv" name="csvrpta['+pla+']"> <button type="button" class="btn btn-outline-danger col-md-1 mx-lg-5 remove-field">Remove</button></div>')
    });
    $(document).on('click', '.remove-field', function () {
        $(this).parents('div.file-input').remove();
    });
</script>
@stop
