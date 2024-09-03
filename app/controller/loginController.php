<?php
	
    namespace app\controller;
	use app\model\mainModel;

	class loginController extends mainModel{

		/*----------  Controlador iniciar sesion  ----------*/
		public function iniciarSesionControlador(){

			$usuario=$this->limpiarCadena($_POST['login_usuario']);
		    $clave=$this->limpiarCadena($_POST['login_clave']);

		    # Verificando campos obligatorios #
		    if($usuario=="" || $clave==""){
		        echo "<script>
			        Swal.fire({
					  icon: 'error',
					  title: 'Ocurrió un error inesperado',
					  text: 'No has llenado todos los campos que son obligatorios'
					});
				</script>";
		    }else{

			    # Verificando integridad de los datos #
			    if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
			        echo "<script>
				        Swal.fire({
						  icon: 'error',
						  title: 'Ocurrió un error inesperado',
						  text: 'El USUARIO no coincide con el formato solicitado'
						});
					</script>";
			    }else{

			    	# Verificando integridad de los datos #
				    if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
				        echo "<script>
					        Swal.fire({
							  icon: 'error',
							  title: 'Ocurrió un error inesperado',
							  text: 'La CLAVE no coincide con el formato solicitado'
							});
						</script>";
				    }else{

                        $usuarioValido = 'ACEMA';
                        $contraseñaValida = 'ACEMA123';

                        if ($usuario == $usuarioValido && $clave == $contraseñaValida) {
                            
                            echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Ingreso Exitoso',
                                text: 'Bienvenido al sistema de gestión de equipos',
                                timer: 1000,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.href = '".APP_URL."?views=dashboard';
                            });
                            </script>";
                            
                        } else {
                            echo "<script>
                                Swal.fire({
                                icon: 'error',
                                title: 'Ocurrió un error inesperado',
                                text: 'Usuario o clave incorrectos'
                                });
                            </script>";
                        }

					    # Verificando usuario #
					    
				    }
			    }
		    }
		}


		/*----------  Controlador cerrar sesion  ----------*/
		public function cerrarSesionControlador(){

			session_destroy();

		    if(headers_sent()){
                echo "<script> window.location.href='".APP_URL."?views=login/'; </script>";
            }else{
                header("Location: ".APP_URL."?views=login");
            }
		}
		
	}
