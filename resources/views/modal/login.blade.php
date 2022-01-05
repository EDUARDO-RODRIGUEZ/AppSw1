    <div class="modal fade " id="sign-in-social">
      <div class="modal-dialog">
      
        <div class="modal-content ">
            <div class="modal-header bg-cyan">
                <h4 class="modal-title ">Iniciar sessión</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                  <p class="login-box-msg"> </p>
                <div class="card p-3">
                  <form action="{{ url('cliente/login') }}" method="post">
                     @csrf
                    <div class="input-group mb-3">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" >
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="">
                        <div class="form-check">
                        <input class="form-check-input ml-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label ml-3" for="remember">
                          <strong> {{__('Remember Me') }}</strong>
                        </label>
                        </div>
                      </div>
                      <!-- /.col -->
                     
                      <!-- /.col -->
                    </div>
                    <div class="row ">
                        <button type="submit" class="btn btn-primary btn-block ">Sign In</button>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}"><u>{{ __('Forgot Your Password?') }}</u>
                            
                        </a>
                        @endif
                    </div>
                  </form>

                </div>  
            </div>
 
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <div class="modal fade " id="login-usuarios">
            <div class="modal-dialog">
            
              <div class="modal-content ">
                  <div class="modal-header bg-cyan">
                      <h4 class="modal-title ">Iniciar sesión como usuario</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body ">
                        <p class="login-box-msg"> </p>
                      <div class="card p-3">
                        <form action="{{ url('login') }}" method="post">
                           @csrf
                          <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="">
                              <div class="form-check">
                              <input class="form-check-input ml-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                              <label class="form-check-label ml-3" for="remember">
                                <strong> {{__('Remember Me') }}</strong>
                              </label>
                              </div>
                            </div>
                            <!-- /.col -->
                           
                            <!-- /.col -->
                          </div>
                          <div class="row ">
                              <button type="submit" class="btn btn-primary btn-block ">Sign In</button>
                              @if (Route::has('password.request'))
                              <a class="btn btn-link" href="{{ route('password.request') }}"><u>{{ __('Forgot Your Password?') }}</u>
                                  
                              </a>
                              @endif
                          </div>
                        </form>

                      </div>  
                  </div>

              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>











  <div class="modal fade " id="registrar">
                  <div class="modal-dialog">
                  
                    <div class="modal-content ">
                        <div class="modal-header bg-cyan">
                            <h4 class="modal-title ">Registarse</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                              @if(count($errors) > 0)
                              <div class="errors ">
                              <ul class="alert alert-danger " role="alert"><i class="fas fa-exclamation-triangle"></i> Mensaje informativo : <br>
                              @foreach($errors->all() as $error)
                              <li class="">{{ $error }}</li>
                              @endforeach
                              </ul>
                              </div>
                              @endif
                              <p class="login-box-msg"> </p>
                            <div class="card p-3">
                              <form action="{{ url('/cliente/registrar') }}" method="post">
                                 @csrf
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control @error('email') is-invalid @enderror" name="nombres" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="nombres" >
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Email" >
                                      @error('email')
                                      <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                  </div>
                                </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>
                                <div class="row">
                                  <div class="">
                                    <div class="form-check">
                                    <input class="form-check-input ml-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label ml-3" for="remember">
                                      <strong> {{__('Remember Me') }}</strong>
                                    </label>
                                    </div>
                                  </div>
                                  <!-- /.col -->
                                 
                                  <!-- /.col -->
                                </div>
                                <div class="row ">
                                    <button type="submit" class="btn btn-primary btn-block ">Registrar</button>
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}"><u>{{ __('Forgot Your Password?') }}</u>
                                        
                                    </a>
                                    @endif
                                </div>
                              </form>
                              <div class="row">
                                <p class="">
                                  <a href="register.html" class="btn btn-link"><u> Register a new membership</u></a>
                                </p>
                              </div>
                            </div>  
                        </div>

                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
</div>
                
                