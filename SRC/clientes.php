<?php
require '../INCLUDES/app.php';
require '../vendor/autoload.php';
incluirTemplate('header');
use App\Cliente;


//errores
$errores = Cliente::getErrores();

//resivir datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //instanciar la clase cliente
    $cliente = new Cliente($_POST);

    //validar
    $errores = $cliente->validar();

    if(empty($errores)){
        $cliente->guardar();
    }

}

?>

<div class="login-card">
    <h2>FORMULARIO DE REGISTRO</h2>
    <h3>Por favor, completa los siguientes campos.</h3>
    <form action="" method="POST" class="login-form">
        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre">
        <input type="text" name="apellido" id="apellido" placeholder="Apellido">
        <input type="text" name="telefono_principal" id="telefono_principal" placeholder="Teléfono">
        <input type="text" name="telefono_secundario" id="telefono_secundario" placeholder="Otro contacto">
        <input type="text" name="cedula" id="cedula" placeholder="Número de Cédula">
        <input type="text" name="direccion" id="apellido" placeholder="Dirección (Provincia, Ciudad, Av)">
        <select type="text" minlength="8" maxlength="200" require name="asesor_id" id="exampleRepeatPassword">
                                                <option selected>Atendido por:</option></option>
                                                <option value="Katherine Perez">Katherine Perez</option>
                                                <option value="Luis Revilla">Luis Revilla</option>
                                                <option value="Domenica Fajardo">Domenica Fajardo</option>
                                                <option value="Krystel Quintong">Krystel Quintong</option>
                                        </select>
        <button type="submit">REGISTRAR</button>
    </form>
</div>


<?php incluirTemplate('footer'); ?>