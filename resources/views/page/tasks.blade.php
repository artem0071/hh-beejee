@extends('layout.app')

@section('content')

    <div class="p-4">

        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Все задачи</h3>
            </div>
            <div class="card-body">
                @include('page.tasks.list')

                <div class="d-flex justify-content-center">
                    @include('component.pagination')
                </div>
            </div>
            <div class="card-footer">
                @include('page.taskForm')
            </div>
        </div>
    </div>

@endsection
