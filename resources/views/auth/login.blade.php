@extends('layouts.console.app')

@section('title', "Masuk")

@section('stylesheets')
@endsection

@section('simple')
	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">

									@include('layouts.console.flash')

									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
									</div>
									<form action="{{ route('login') }}" method="POST" class="user">
										@csrf
										<div class="form-group">
											<input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Alamat email" name="email" required>
											@error('email')
											<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" placeholder="Kata Sandi" name="password" required>
										</div>
										<div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" id="customCheck" name="remember" @if(old('remember') == 'on') checked @endif>
												<label class="custom-control-label" for="customCheck">Ingat Saya</label>
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>

										<div class="mt-3 text-center">
											<a href="{{ route('password.email') }}"><small>Lupa kata sandi?</small></a>
										</div>

										<hr/>

										<div class="mt-3 text-center">
											<p><small>Mahasiswa dan belum mempunyai akun?</small></p>
											<a href="{{ route('register') }}" class="btn btn-outline-primary btn-user btn-block">Daftarkan Saya!</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection

@section('scripts')
@endsection
