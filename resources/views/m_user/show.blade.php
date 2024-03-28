@extends('layout.app')

{{-- customize layout section --}}

@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'User')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2 class="text-primary"> Show User</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('m_user.index') }}">
                    Kembali </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="text-info">User_id:</strong>
                <span class="text-muted">{{ $useri->user_id }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="text-info">Level_id: </strong>
                <span class="text-muted">{{ $useri->level_id }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="text-info">Username:</strong>
                <span class="text-muted">{{ $useri->username }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="text-info">Nama:</strong>
                <span class="text-muted">{{ $useri->nama }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="text-info">Password:</strong>
                <span class="text-muted">{{ $useri->password }}</span>
            </div>
        </div>
    </div>
@endsection


{{-- @extends('m_user/template')
@section('content')
    
@endsection --}}