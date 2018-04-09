<?php $__env->startSection('content'); ?>

<!-- signin-page -->
	<section id="main" class="clearfix user-page">
		<div class="container">
			<div class="row">
				<!-- user-login -->			
				<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<div class="user-account">
						<h3 class="min-margin"><i class="fa fa-sign-in"></i> Login your account</h3>
						<!-- form -->
						<?php echo Form::open(array('url' => 'login', 'data-toggle'=>'validator','role'=>'form')); ?>

							<div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
								<input name="email" type="text" class="form-control" placeholder="Email" required>
								<div class="help-block with-errors"></div>
								<?php if($errors->has('email')): ?>
				                    <span class="help-block">
				                        <strong><?php echo e($errors->first('email')); ?></strong>
				                    </span>
				                <?php endif; ?>
							</div>
							<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
								<input name="password" type="password" class="form-control" placeholder="Password" required>
								<div class="help-block with-errors"></div>
								<?php if($errors->has('password')): ?>
				                    <span class="help-block">
				                        <strong><?php echo e($errors->first('password')); ?></strong>
				                    </span>
				                <?php endif; ?>
							</div>
							<div class="form-group">
							<a href="<?php echo e(url('/password/reset')); ?>" class="btn btn-link">Forgot password?</a>
							<button type="submit" class="btn btn-success pull-right">Login</button>
							</div>
						</form><!-- form -->
					
						<div class="user-option">
							<div class="col-md-12 no-padding">
							<a href="#" class="btn btn-lg btn-primary create_btn"><i class="fa fa-facebook"></i> Login with facebook</a>
							</div>
							<div class="col-md-12 no-padding">
							<br>
							<a href="#" class="btn btn-lg btn-danger create_btn"><i class="fa fa-google"></i> Login with google</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 no-padding">
					<a href="<?php echo e(URL::to('signup')); ?>" class="btn btn-lg btn-info create_btn">Create a New Account</a>
						
					</div>
				</div><!-- user-login -->			
			</div><!-- row -->	
		</div><!-- container -->
	</section><!-- signin-page -->
	

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>