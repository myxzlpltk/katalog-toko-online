@extends('layouts.admin.app')

@section('title', "Register")

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
							<div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
							<div class="col-lg-6">
								<div class="p-5">

									@include('layouts.admin.flash')

									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Daftar Akun Mahasiswa</h1>
									</div>
									<form action="{{ route('register') }}" method="POST" class="user">
										@csrf
										<div class="form-group">
											<input type="text" class="form-control form-control-user @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" placeholder="Nomor Induk Mahasiswa" required>
											@error('nim')
											<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group">
											<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
											@error('name')
											<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group">
											<input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required>
											@error('email')
											<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group row">
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Kata Sandi" required>
												@error('password')
												<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
											<div class="col-sm-6">
												<input type="password" class="form-control form-control-user @error('password_confirmation ') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Ulangi Kata Sandi" required>
												@error('password_confirmation')
												<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
									</form>

                                    <div class="mt-3 text-center">
                                        <a href="{{ route('login') }}"><small>Sudah mempunyai akun?</small></a>
                                    </div>
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
