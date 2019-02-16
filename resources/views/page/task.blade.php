@extends('layout.app')

@section('content')

    <div class="p-4">

        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Задача #{{ $task->id }}</h3>
            </div>
            <div class="card-body">

                @if($updated)
                    <div class="alert alert-success" role="alert">
                        Запись обновлена!
                    </div>
                @endif

                @include('page.task.form')

            </div>
        </div>
    </div>

@endsection
