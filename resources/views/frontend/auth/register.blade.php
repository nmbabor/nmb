@extends('frontend.app')
@section('content')
<!-- signup-page -->
<section id="main" class="clearfix user-page section">
	<div class="container">
		<div class="row">
			<!-- user-login -->
			<div class="main_section col-md-10 col-md-offset-1 no-padding">
				
			
			<div class="col-sm-8 col-md-7 no-padding-right">
				<div class="user-account">
					<h2>Create your Account</h2>
                        {!! Form::open(array('route' => 'register', 'data-toggle'=>'validator','role'=>'form')) !!}
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<input name="name" type="text" class="form-control" placeholder="Name Or  Organization Name Or e-Shop Name" value="{{old('name')}}" required>
							<div class="help-block with-errors"></div>
							 @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
							<input name="mobile" type="number" min="0" class="form-control" placeholder="Mobile Number" value="{{old('mobile')}}" required>
							<div class="help-block with-errors"></div>
							 @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<input name="email" type="email" value="{{old('email')}}" class="form-control" placeholder="Email" required>
							<div class="help-block with-errors"></div>
							@if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
							{{Form::select('type',$type,'',['class'=>'form-control','placeholder'=>'Account Type'])}}
							<div class="help-block with-errors"></div>
							@if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<input name="password" type="password" class="form-control" placeholder="Password" required>
							<div class="help-block with-errors"></div>
							@if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
							<input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="checkbox">
							<div class="form-group col-md-12" style="margin-bottom: 0">
									<label for="send">
										<input type="checkbox" id="send" required>I agree with<a href="https://www.ebusines.com.bd/page/using-rules">Terms of Use</a> and <a href="https://www.ebusines.com.bd/page/using-rules">Privacy Policy.</a>
									</label>
									<div class="help-block with-errors"></div>
								</div>
						</div><!-- checkbox -->	
						<button type="submit" href="#" class="btn btn-success">Registration</button>	
					{{Form::close()}}
					<!-- checkbox -->
					<div class="user-option">
							<div class="col-md-6 no-padding">
							<a href="#" class="btn btn-lg btn-primary create_btn"><i class="fa fa-facebook"></i> Sign up with facebook</a>
							</div>
							<div class="col-md-6">
							<a href="#" class="btn btn-lg btn-danger create_btn"><i class="fa fa-google"></i> Sign up with google</a>
							</div>
						</div>
									
				</div>
			</div><!-- user-login -->
			<div class="col-md-5">
				<div class="user-account">
					<h4>একাউন্ট খোলার পূর্বে পড়ে নিন !</h4>
				<? $typeDetails=DB::table('user_type')->where('type','!=',1)->where('type','!=',2)->get(); ?>
				@foreach($typeDetails as $data)
					<div class="panel panel-success">
					  <div class="panel-heading">
					    <h3 class="panel-title">{{$data->type_name}}</h3>
					  </div>
					  <div class="panel-body">
					    <? echo $data->description; ?>
					  </div>
					</div>
				@endforeach

				</div>
			</div>
			</div>	
		</div><!-- row -->	
	</div><!-- container -->
</section><!-- signup-page -->



@endsection