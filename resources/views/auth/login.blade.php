@extends('layouts.main_layouts')
@section('content')

<div class="login-wrapper">
    <div class="login-card">

        {{-- Logo --}}
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Notes" style="height: 48px;" class="mb-3">
            <h1 class="login-title">Bem-vindo de volta</h1>
            <p class="login-subtitle">Acesse sua conta para continuar</p>
        </div>

        @if(session('loginError'))
        <div class="alert alert-danger">
            {{ session('loginError')}}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
        @endif

        {{-- Formulário --}}
        <form action=" {{ route('loginSubmit') }} " method="POST" novalidate>
            @csrf

            <div class="mb-3">
                <label for="text_username" class="form-label">Usuário</label>
                <input
                    type="text"
                    class="form-control @error('text_username') is-invalid @enderror"
                    id="text_username"
                    name="text_username"
                    value="{{ old('text_username') }}"
                    placeholder="Digite seu usuário"
                    autocomplete="username"
                    required
                    autofocus
                >
                @error('text_username')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="text_password" class="form-label">Senha</label>
                <div class="position-relative">
                    <input
                        type="password"
                        class="form-control @error('text_password') is-invalid @enderror"
                        id="text_password"
                        name="text_password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                    <button
                        type="button"
                        class="btn btn-sm position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                        style="color: rgba(255,255,255,0.4); background: none; border: none; line-height: 1;"
                        onclick="togglePassword()"
                        tabindex="-1"
                        aria-label="Mostrar/ocultar senha"
                    >
                        <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('text_password')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">
                Entrar
            </button>
        </form>

        {{-- Divisor --}}
        <div class="d-flex align-items-center my-4" style="gap: 0.75rem;">
            <hr style="flex: 1; border-color: rgba(255,255,255,0.1); margin: 0;">
            <small style="color: rgba(255,255,255,0.3); white-space: nowrap;">Não tem uma conta?</small>
            <hr style="flex: 1; border-color: rgba(255,255,255,0.1); margin: 0;">
        </div>

        {{-- Botão Criar Conta --}}
        <a href="{{ route('register')}}" class="btn w-100" style="
            background: transparent;
            border: 1.5px solid rgba(255,255,255,0.18);
            color: rgba(255,255,255,0.8);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.7rem;
            border-radius: 0.6rem;
            text-align: center;
            transition: all .2s;
            display: block;
        "
        onmouseover="this.style.borderColor='#2563EB'; this.style.color='#fff'; this.style.background='rgba(37,99,235,0.12)';"
        onmouseout="this.style.borderColor='rgba(255,255,255,0.18)'; this.style.color='rgba(255,255,255,0.8)'; this.style.background='transparent';"
        >
            Criar conta gratuita
        </a>

        {{-- Footer --}}
        <div class="login-footer">
            &copy; {{ date('Y') }} Notes &mdash; Todos os direitos reservados
        </div>

    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('text_password');
        const iconEye = document.getElementById('icon-eye');
        const iconEyeOff = document.getElementById('icon-eye-off');
        if (input.type === 'password') {
            input.type = 'text';
            iconEye.style.display = 'none';
            iconEyeOff.style.display = 'inline';
        } else {
            input.type = 'password';
            iconEye.style.display = 'inline';
            iconEyeOff.style.display = 'none';
        }
    }
</script>

@endsection