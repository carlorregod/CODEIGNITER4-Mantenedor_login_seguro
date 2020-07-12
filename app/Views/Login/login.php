<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php echo csrf_meta(); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/css/login.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/css/iziToast.min.css">
	<script src="<?php echo base_url(); ?>/js/jquery3.js"></script>
	<!-- Alertas de iziToast: https://izitoast.marcelodolza.com/ -->
	<script src="<?php echo base_url(); ?>/js/iziToast.min.js"></script>
	<title>Login sistema</title>
	<?php helper('form');
		$session = session();?>
</head>
<body>
	<!-- Mensaje inicial de encabezado ante errores, mensajes, etc -->
		<script type="text/javascript">
		$(document).ready(function(){
			<?php if(null !== $session->get('vista_login')): ?>
				document.querySelector('a[href="#login"]').click();
			<?php endif; ?>
			<?php if(isset($mensaje)): ?>
			iziToast.show({
			    title: 'Información',
			    message: '<?php echo $mensaje; ?>',
			    position:'topCenter',
			    timeout: 2300
			});
			<?php elseif(isset($errors)): ?>
				<?php foreach ($errors as $field => $err) : ?>
			       iziToast.error({
					    title: 'Error',
					    message: '<?php echo $err; ?>',
					    position:'topCenter',
					    timeout: 4000
					});
			    <?php endforeach ?>
			<?php elseif($session->getFlashdata('errors')): ?>
				<?php foreach ($session->getFlashdata('errors') as $field => $err) : ?>
			       iziToast.error({
					    title: 'Error',
					    message: '<?php echo $err; ?>',
					    position:'topCenter',
					    timeout: 4000
					});
			    <?php endforeach ?>
			<?php endif; ?>
		});
		</script>

	<div class="form">
	      <ul class="tab-group">
	        <li class="tab active"><a href="#signup">Registrarse</a></li>
	        <li class="tab"><a href="#login">Ingresar</a></li>
	      </ul>

	      <div class="tab-content">
	        <div id="signup">
	          <h1>Registrarse</h1>
				<?php echo form_open(base_url().'/register',['id'=>'register', 'class'=>'login','method'=>'POST']); ?>

	          <div class="top-row">
	            <div class="field-wrap">
            	<?php  	echo form_label('Nombre <span class="req">*</span>', 'firstname');
            			echo form_input('firstname', old('firstname')?old('firstname'):'',['id'=>'firstname','required'=>true,'autocomplete'=>'off'],'text');?>
	            </div>

	            <div class="field-wrap">
            	<?php  	echo form_label('Apellido <span class="req">*</span>', 'lastname');
            			echo form_input('lastname', old('lastname')?old('lastname'):'',['id'=>'lastname','required'=>true,'autocomplete'=>'off'],'text');?>
	            </div>
	          </div>

			 <div class="top-row">
	          <div class="field-wrap">
	          	<?php  	echo form_label('Correo electrónico <span class="req">*</span>', 'email');
	            		echo form_input('email', old('email')?old('email'):'',['id'=>'email','required'=>true,'autocomplete'=>'off'],'email');?>
	          </div>

	          <div class="field-wrap">
	          	<?php  	echo form_label('Nombre usuario <span class="req">*</span>', 'username');
	            		echo form_input('username', old('username')?old('username'):'',['id'=>'username','required'=>true,'autocomplete'=>'off'],'text');?>
	          </div>
	         </div>

			<div class="top-row">
	          <div class="field-wrap">
	          	<?php  	echo form_label('Contraseña <span class="req">*</span>', 'password');
	            		echo form_password('password', '',['id'=>'password','required'=>true,'autocomplete'=>'off']);?>
	          </div>
	          <div class="field-wrap">
	          	<?php  	echo form_label('Confirme contraseña <span class="req">*</span>', 'password_verify');
	            		echo form_password('password_verify', '',['id'=>'password_verify','required'=>true,'autocomplete'=>'off']);?>
	          </div>
	        </div>
				<?php echo form_submit('register', 'Registrarse Ahora',['class'=>'button button-block', 'id'=>'register']);?>
		        <?php echo form_close(); ?>

	        </div>

	        <div id="login">
	          <h1>Bienvenido, ingrese al sistema</h1>
				<?php echo form_open(base_url().'/login',['id'=>'login', 'class'=>'login','method'=>'POST']); ?>				

	            <div class="field-wrap">
	            	<?php  	echo form_label('Nombre usuario <span class="req">*</span>', 'username1');
	            		echo form_input('username1', old('username1')?old('username1'):'',['id'=>'username1','required'=>true,'autocomplete'=>'off'],'text');?>
	          </div>

	          <div class="field-wrap">
	          	<?php  	echo form_label('Contraseña <span class="req">*</span>', 'password1');
	            		echo form_password('password1', '',['id'=>'password1','required'=>true,'autocomplete'=>'off']);?>
	          </div>

	          <p class="forgot"><a href="#">¿Olvidaste la contraseña?</a></p>
				<?php echo form_submit('login', 'Ingresar',['class'=>'button button-block', 'id'=>'login']);?>
		        <?php echo form_close(); ?>

	        </div>

	      </div><!-- tab-content -->

	</div> <!-- /form -->
	<script type="text/javascript" src="<?php echo base_url(); ?>/js/login.js"></script>
</body>
</html>
