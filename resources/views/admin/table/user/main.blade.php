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
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form Active="#">
                                                <div class="search_field">
                                                    <input type="text" placeholder="Search content here...">
                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#registeruser"
                                            class="btn_1">Add New User</a>
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table mb_30">

                                <table class="table lms_table_active ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            
                                        
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> {{ ($key+1) }}</a>
                                            </th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->status == 'Aktif')
                                                <a href="{{ route('change-status', $user->id) }}" class="status_btn">Aktif</a>
                                                @else
                                                <a href="{{ route('change-status', $user->id) }}" class="btn btn-danger rounded-pill text-white">Non Aktif</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#showuser{{ $user->id }}" class="btn btn-info"><i class="ti-eye text_white"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#edituser{{ $user->id }}" class="btn btn-warning"><i class="ti-pencil-alt text_white"></i></a>
                                                <form action="{{ route('destroy-user', $user->id) }}" method="post" style="display: inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="ti-trash text_white" onclick="return confirm('Yakin Ingin Menghapus?')"></i></button>
                                                </form>
                                            </td>
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
@endsection
