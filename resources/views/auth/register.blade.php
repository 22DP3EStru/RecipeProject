@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light py-5">
  <div class="card shadow-lg" style="max-width: 500px; width: 100%;">
    <div class="card-header text-center bg-white">
      <div class="mb-3">
        <div class="bg-warning rounded-circle p-3 d-inline-block">
          <i class="bi bi-egg-fried fs-3 text-white"></i>
        </div>
      </div>
      <h3 class="fw-bold">Create Account</h3>
      <p class="text-muted mb-0">Join our cooking community today</p>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
          </div>
          @error('name')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
          </div>
          @error('email')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <ul class="small mt-2 text-muted ps-3">
            <li>At least 8 characters</li>
            <li>Contains uppercase and lowercase</li>
            <li>Includes a number</li>
          </ul>
          @error('password')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>
        </div>

        <button type="submit" class="btn btn-warning w-100">
          Create Account
        </button>
      </form>
    </div>
    <div class="card-footer text-center bg-white">
      <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-warning fw-medium">Sign in here</a></p>
    </div>
  </div>
</div>
@endsection
