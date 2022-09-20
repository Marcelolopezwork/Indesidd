$('#phone').numerico();
$('#perfilfoto').on('change', function () {
	readURL(this);
	$('#archivo').text($(this).get(0).files.item(0).name);
});
/*Verificar campos del formulario*/
$(function () {
	/*Validación del formulario actualizar datos*/
	$("form[name='actualizardata']").validate({
		rules: {
			level: {
				required: true,
			},
			phone: {
				required: true,
				minlength: 6,
			},
		},
		messages: {
			level: {
				required: 'Ingrese nivel de estudios',
			},
			phone: {
				required: 'Ingresa tu número de teléfono',
				minlength: 'Mínimo 6 caracteres',
			},
		},
		errorPlacement: function (error, element) {
			if (element.attr('name') == 'level') error.appendTo('#levelError');
			if (element.attr('name') == 'phone') error.appendTo('#phoneError');
		},
		submitHandler: function (form) {
			$.ajax({
				type: 'post',
				url: 'update.php',
				data: $(form).serialize(),
				success: function (response) {
					const listo = JSON.parse(response);
					if (listo[0] == true)
						Toast.fire({
							icon: 'info',
							title: 'Datos actualizados',
						});
					else
						Toast.fire({
							icon: 'error',
							title: listo[1],
						});
				},
				error: function () {
					Toast.fire({
						icon: 'error',
						title: 'No se pudo actualizar la información',
					});
				},
			});
		},
	});
	/*Validación del formulario cambiar contraseña*/
	$.validator.addMethod(
		'passeguro',
		function (value, element) {
			return (
				this.optional(element) ||
				(/^[a-zA-Z0-9!@#$%^&()={*};:\_\|,.<>+-]*$/i.test(value) &&
					/[A-Z]/.test(value) &&
					/[a-z]/.test(value) &&
					/\d/i.test(value) &&
					/[!@#$%^&()={*};:\_\|,.<>+-]/i.test(value))
			);
		},
		'No es segura'
	);
	$('#actualizarclave').on('blur keyup change', '#again', function () {
		if ($('#actualizarclave').valid()) {
			$('#subbtn').addClass('curor-not-allowed');
			$('#subbtn').removeClass('curor-pointer');
			$('#subbtn').prop('disabled', false);
		} else {
			$('#subbtn').addClass('curor-pointer');
			$('#subbtn').removeClass('curor-not-allowed');
			$('#subbtn').prop('disabled', true);
		}
	});
	$('#actualizarclave').validate({
		rules: {
			old: {
				required: true,
				minlength: 5,
				maxlength: 12,
			},
			new: {
				required: true,
				minlength: 8,
				maxlength: 12,
				passeguro: true,
			},
			again: {
				required: true,
				minlength: 8,
				maxlength: 12,
				passeguro: true,
				equalTo: '#new',
			},
		},
		messages: {
			old: {
				required: 'Ingrese clave actual',
				minlength: 'Mínimo 5 caracteres',
				maxlength: 'Mínimo 12 caracteres',
			},
			new: {
				required: 'Ingresa clave nueva',
				minlength: 'Mínimo 8 caracteres',
				maxlength: 'Mínimo 12 caracteres',
			},
			again: {
				required: 'Clave nueva otra vez',
				minlength: 'Mínimo 8 caracteres',
				maxlength: 'Máximo 12 caracteres',
				equalTo: 'Claves no son iguales',
			},
		},
		errorPlacement: function (error, element) {
			if (element.attr('name') == 'old') error.appendTo('#oldError');
			if (element.attr('name') == 'new') error.appendTo('#newError');
			if (element.attr('name') == 'again') error.appendTo('#againError');
		},
		submitHandler: function (form) {
			$.ajax({
				type: 'post',
				url: 'security.php',
				data: $(form).serialize(),
				success: function (response) {
					const listo = JSON.parse(response);
					document.getElementById('actualizarclave').reset();
					$('#subbtn').prop('disabled', true);
					$('#old').attr('type', 'password');
					$('#new').attr('type', 'password');
					$('#again').attr('type', 'password');
					if (listo[0] == true)
						Toast.fire({
							icon: 'success',
							title: 'Contraseña cambiada',
						});
					else
						Toast.fire({
							icon: 'error',
							title: listo[1],
						});
				},
				error: function () {
					Toast.fire({
						icon: 'error',
						title: 'No se pudo cambiar la contraseña',
					});
				},
			});
		},
	});
});
/*Verifica que la imagen de perfil no sea muy grande*/
function valid() {
	var fileSize = $('#perfilfoto')[0].files[0].size;
	var sizekByte = parseInt(fileSize / 824000);
	if (sizekByte > $('#perfilfoto').attr('size')) {
		Swal.fire(
			'Aviso',
			'Imagen muy grande. Utilice una imagen de 4MB de peso como máximo.',
			'error'
		);
		return false;
	}
}
/*Mostrar contraseña*/
function muestra(cual, quien) {
	$(cual).toggleClass('icon-line-eye-off');
	var type = $(cual).hasClass('icon-line-eye-off') ? 'text' : 'password';
	$(quien).attr('type', type);
}
/*Mostrar imagen de perfil*/
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#profile').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
/*Ajax*/
function ajaxData(t, a, n, r) {
	$(t).on('click', function (t) {
		var i = $(this).attr('href'),
			o = $(this).attr(n),
			u = '#' + r;
		$.ajax({ url: a, type: 'POST', data: { z: i, t: o } })
			.done(function (t) {
				$(u).html(t);
			})
			.fail(function (t, a) {
				$(u).html('Ha ocurrido un error!!!');
			}),
			t.preventDefault();
	});
}
/*Toast*/
const Toast = Swal.mixin({
	toast: true,
	position: 'top-right',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: false,
	onOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer);
		toast.addEventListener('mouseleave', Swal.resumeTimer);
	},
});
