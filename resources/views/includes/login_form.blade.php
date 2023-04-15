<form method="POST"
      action="{{ route('udsu.login') }}"
      class="d-flex">
    @csrf
    <input id="username"
           type="text"
           class="form-control me-2 @error('username') is-invalid @enderror"
           name="username"
           value="{{ old('username') }}"
           placeholder="Логин"
           required
           autocomplete="username"
           autofocus>

    @error('username')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
    <input id="password"
           type="password"
           class="form-control me-2 @error('password') is-invalid @enderror"
           name="password"
           placeholder="Пароль"
           required
           autocomplete="текущий пароль">
    @error('password')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
