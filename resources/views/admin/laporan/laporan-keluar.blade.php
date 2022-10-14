@extends('admin.layout.app')
@section('content')
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">{{ $title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Table</h4>
                                <div class="box_right d-flex lms_block">
                                </div>
                            </div>
                            <div class="QA_table mb_30">
                                <form action="{{ route('laporan-keluar') }}" method="GET">
                                    <div class="row mb-2">
                                        <div class="col-lg-2 mt-2">
                                            <h5 class="text-center align-middle">Range</h5>
                                        </div>
                                        <div class="col-lg-3 m-auto mt-2">
                                            <input type="datetime-local" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ isset($_GET['tanggal_awal']) }}">
                                        </div>
                                        <div class="col-lg-1 mt-2">
                                            <h3 class="text-center align-middle">-</h3>
                                        </div>
                                        <div class="col-lg-3 m-auto mt-2">
                                            <input type="datetime-local" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ isset($_GET['tanggal_akhir']) }}">
                                        </div>
                                        <div class="col-lg-3 m-auto text-center mt-2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                            <a class="btn btn-warning text-white" onclick="print()"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                    </div>
                                </form>
                                <table class="table lms_table_active ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Jenis Pengeluaran</th>
                                            <th scope="col">Nominal</th>
                                            <th scope="col">Tanggal Keluar</th>
                                            <th scope="col">Nama Penyetor</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kass as $key => $kas)
                                            
                                        
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> {{ ($key+1) }}</a>
                                            </th>
                                            <td>{{ $kas->jenis }}</td>
                                            <td>Rp {{ number_format($kas->nominal, 0, '.', ',') }}</td>
                                            <td>{{ $kas->tanggal_kas }}</td>
                                            <td>{{ $kas->user->name }}</td>
                                            <td>{{ $kas->keterangan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
            </div>
        </div>
    </div>
    <script>
        function print() {
        let tanggal_awal = $('#tanggal_awal').val();
        let tanggal_akhir = $('#tanggal_akhir').val();
        window.open(`{{ route('laporan-keluar-print') }}?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}`, '_blank');
    }
    </script>
@endsection
