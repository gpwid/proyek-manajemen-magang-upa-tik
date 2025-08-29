@extends('admin.layoutsadmin.main')
@section('permohonan-active', 'active')
@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Permohonan</h1>
                        <a href="{{ route('admin.permohonan.tambah') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                </div>

@endsection
