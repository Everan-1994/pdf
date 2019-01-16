@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row" style="margin-left: 0; margin-right: 0;">
                    <div class="col-md-2">
                        <button type="button" class="member btn btn-primary" data-id="0">新增用户</button>
                    </div>
                    <div class="col-md-10 row">
                        <form role="form" class="col-md-12 search-form">
                            <div class="form-group row" style="margin-bottom: 0;">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-group">选择分组</span>
                                        </div>
                                        <select class="custom-select" name="group" aria-describedby="basic-group">
                                            @foreach ($groups as $key => $group)
                                                <option value="{{ $group->name }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="用户名" autofocus>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-outline-success">
                                        查 询
                                    </button>
                                    <button type="button" id="reset" class="btn btn-outline-dark" style="margin-left: 10px;">
                                        重 置
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @include('tables.member')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
