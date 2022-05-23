@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Criar Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('usuarios.criar') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cargo_staff" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                            <div class="col-md-6">
                                <select id="cargo_staff" type="cargo_staff" class="form-control @error('cargo_staff') is-invalid @enderror" name="cargo_staff" required>
                                    <option value="">{{ __('Selecione')}}</option>
                                    @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id}}" {{ $cargo->id == old('cargo_staff') ? 'selected' : ''}}>{{ $cargo->cargo}}</option>
                                    @endforeach
                                </select>
                                @error('cargo_staff')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <input id="password" type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="12345678">
                        <input id="password-confirm" type="hidden" class="form-control" name="password_confirmation" required autocomplete="new-password" value="12345678">

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Criar Usuario') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection