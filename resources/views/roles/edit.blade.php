@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('user.index') }}">&leftarrow; Voltar para a listagem</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('user.update', [$user]) }}" method="post" class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Usuário</label>
                                <input type="text" class="form-control" id="name" placeholder="Insira o usuário" name="name" value="{{ old('name') ?? $user->name }}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Insira o email do usuário"name="email" value="{{ old('email') ?? $user->email }}">
                            </div>

                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input autocomplete="off" type="password" class="form-control" id="password" placeholder="Insira a senha do usuário" name="password" value="{{ old('password') }}">
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Atualizar usuário</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
