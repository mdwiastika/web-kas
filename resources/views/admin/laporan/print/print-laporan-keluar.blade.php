<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('/admin/img/logo.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('/admin/css/bootstrap1.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/themefy_icon/themify-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/niceselect/css/nice-select.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/owl_carousel/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/vendors/gijgo/gijgo.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/vendors/tagsinput/tagsinput.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/datepicker/date-picker.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/scroll/scrollable.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/datatable/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/vendors/datatable/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/vendors/datatable/css/buttons.dataTables.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/text_editor/summernote-bs4.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/vendors/morris/morris.css') }}">

    <link rel="stylesheet" href="{{ asset('/admin/vendors/material_icon/material-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('/admin/css/metisMenu.css') }}">

    <link rel="stylesheet" href="{{ asset('/admin/css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/css/colors/default.css') }}" id="colorSkinCSS">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/toastr/toastr.min.css') }}">
    <style>
        .dashboard-active {
            color: darkorange;
        }

        .dropdown-list-color-active {
            color: red;
        }
    </style>

</head>

<body class="crm_body_bg">
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

    <script src="{{ asset('/admin/js/jquery1-3.4.1.min.js') }}"></script>

    <script src="{{ asset('/admin/js/popper1.min.js') }}"></script>

    <script src="{{ asset('/admin/js/bootstrap1.min.js') }}"></script>

    <script src="{{ asset('/admin/js/metisMenu.js') }}"></script>

    <script src="{{ asset('/admin/vendors/count_up/jquery.waypoints.min.js') }}"></script>

    <script src="{{ asset('/admin/vendors/chartlist/Chart.min.js') }}"></script>

    <script src="{{ asset('/admin/vendors/count_up/jquery.counterup.min.js') }}"></script>

    <script src="{{ asset('/admin/vendors/niceselect/js/jquery.nice-select.min.js') }}"></script>

    <script src="{{ asset('/admin/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('/admin/vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/vfs_fonts.js') }}>"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/admin/js/chart.min.js') }}"></script>

    <script src="{{ asset('/admin/vendors/progressbar/jquery.barfiller.js') }}"></script>

    <script src="{{ asset('/admin/vendors/tagsinput/tagsinput.js') }}"></script>

    <script src="{{ asset('/admin/vendors/text_editor/summernote-bs4.js') }}"></script>
    <script src="{{ asset('/admin/vendors/am_chart/amcharts.js') }}"></script>

    <script src="{{ asset('/admin/vendors/scroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/admin/vendors/scroll/scrollable-custom.js') }}"></script>
    <script src="{{ asset('/admin/vendors/chart_am/core.js') }}"></script>
    <script src="{{ asset('/admin/vendors/chart_am/charts.js') }}"></script>
    <script src="{{ asset('/admin/vendors/chart_am/animated.js') }}"></script>
    <script src="{{ asset('/admin/vendors/chart_am/kelly.js') }}"></script>
    <script src="{{ asset('/admin/vendors/chart_am/chart-custom.js') }}"></script>

    <script src="{{ asset('/admin/js/custom.js') }}"></script>
    <script src="{{ asset('/admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        @if (Session::has('status'))
            @if (Session::get('status') == 'success')
                toastr.success(`{{ Session::get('message') }}`)
            @else
                toastr.error(`{{ Session::get('message') }}`)
            @endif
        @endif
    </script>
    <script>
        window.print();
        window.onfocus = function() {
            window.close()
        }
    </script>
</body>

</html>
