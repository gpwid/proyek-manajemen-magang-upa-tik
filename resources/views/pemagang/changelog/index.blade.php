@extends('pemagang.layoutspemagang.main')
@section('title', 'Changelog')
@section('changelog-active', 'active')
@section('content')

    <div class="container-fluid">

        <div class="row g-3">
            @foreach ($changelogs as $changelog)
                <div class="col-12">
                    <div class="card shadow-sm border-0 mb-2">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user me-2"></i> {{ $changelog->title }}
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-12 col-md-6">
                                    <div class="info-item">
                                        <label class="info-label">Changelog</label>
                                        <div class="info-value">
                                            <ul>
                                                @foreach (explode("\n", $changelog->description) as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


@endsection
