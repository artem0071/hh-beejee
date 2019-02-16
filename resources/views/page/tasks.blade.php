@extends('layout.app')

@section('content')

    <div class="p-2">

        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Все задачи</h3>
            </div>
            <div class="card-body">
                @include('page.task.list')

                @include('component.pagination')
            </div>
            <div class="card-footer">
                @include('page.task.form')
            </div>
        </div>
    </div>

@endsection
