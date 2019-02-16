@extends('layout.app')

@section('content')

    <div class="p-4">

        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Войдите</h3>
            </div>
            <div class="card-body">

                <form method="post" action="/login">
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input name="email" type="text" class="form-control" id="login" placeholder="Введите логин">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Введите пароль">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection
