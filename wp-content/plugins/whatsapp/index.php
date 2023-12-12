<?php   

/*
Plugin Name: whatsapp_leo
Description: Plugin para recabar contactos por whatsapp.
*/

?>


<?php 

defined('ABSPATH') or die('Acceso restringido');


/*   functionalidad whatsapp  */  


// crear tabla en la base de datos 
function crear_tabla_usuarios_registrados() {
    global $wpdb;
    $nombre_tabla = $wpdb->prefix . 'usuarios_registrados';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $nombre_tabla (
        id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        telefono VARCHAR(20) NOT NULL,
        correo VARCHAR(100) NOT NULL,
        fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}
add_action('admin_init', 'crear_tabla_usuarios_registrados'); 




// function para insertar usuarios en la bd

function registrar_usuario_en_tabla($nombre, $telefono, $correo) {
    global $wpdb;
    $nombre_tabla = $wpdb->prefix . 'usuarios_registrados';

    $wpdb->insert(
        $nombre_tabla,
        array(
            'nombre' => $nombre,
            'telefono' => $telefono,
            'correo' => $correo,
        )
    );
}


// Función para agregar una página personalizada en el panel de administración 
function agregar_pagina_clientes_registrados() {
    add_menu_page(
        'Clientes Registrados', // Título de la página
        'Clientes Registrados', // Título del menú
        'manage_options', // Capacidad requerida para ver esta página (aquí: administrador)
        'clientes-registrados', // Slug de la página
        'mostrar_tabla_clientes' // Función que muestra el contenido de la página
    );
}
add_action('admin_menu', 'agregar_pagina_clientes_registrados'); 


function agregar_subpagina_registros() {
    add_submenu_page(
        'clientes-registrados', // Slug de la página padre (en este caso, la página de entradas)
        'Mi Subpágina', // Título de la subpágina
        'Mi Subpágina', // Título del menú
        'manage_options', // Capacidad requerida para ver esta página (aquí: administrador)
        'mi-subpagina', // Slug de la subpágina
        'contenido_subpagina' // Función que muestra el contenido de la subpágina
    );
}
add_action('admin_menu', 'agregar_subpagina_registros');

function contenido_subpagina() {
    // Contenido de tu subpágina aquí
	?>

<h1>Opciones del shortcode</h1>
<?php
}


function mostrar_tabla_clientes() {
    global $wpdb;
    $nombre_tabla = $wpdb->prefix . 'usuarios_registrados';

    $usuarios_registrados = $wpdb->get_results("SELECT * FROM $nombre_tabla");

    ?>
<div class="wrap">
    <h1>Clientes Registrados</h1>
    <table class="wp-list-table widefat striped" id="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios_registrados as $usuario) : ?>
            <tr>
                <td><?php echo esc_html($usuario->id); ?></td>
                <td><?php echo esc_html($usuario->nombre); ?></td>
                <td><?php echo esc_html($usuario->correo); ?></td>
                <td><?php echo esc_html($usuario->telefono); ?></td>
                <td><?php echo esc_html($usuario->fecha_registro); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
jQuery(document).ready(function($) {
    $('#tabla-usuarios').DataTable();
});
</script>
<?php
}

function incluir_recursos_data_tables() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('data-tables', 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', array('jquery'), '1.11.5', true);
    wp_enqueue_style('data-tables-css', 'https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');
}
add_action('admin_enqueue_scripts', 'incluir_recursos_data_tables'); 


function cargar_scripts_en_front() {
    // Agregar SweetAlert al front-end
    wp_enqueue_script('validation', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js', array('jquery'), '10', true);

  
}
add_action('wp_enqueue_scripts', 'cargar_scripts_en_front'); 







// Función para mostrar el formulario de registro como shortcode
function mostrar_formulario_registro($atts) {
    // Código del formulario aquí

	 $image_asesor = get_theme_mod('imagen_encabezado');
	 $image_whatsapp = get_theme_mod('imagen_whatsapp');
    
    $formulario = '
	     <div class="contenedor-formulario">
           <div class="row-formulario">
		       <div class="encabezado-formulario">';

                 $formulario .='<div class="titulo_chat"> <h3>'. get_theme_mod('texto_encabezado') .' </h3> <img src= ' . esc_url($image_whatsapp) .' alt="image whatsapp"/>   </div>'; 

                 $formulario .='<div class="asesor"> <div class="img-asesor"> <img src="'. get_theme_mod('imagen_encabezado') .'"  /> </div> <div class="txt-asesor"> 
                     <small class="atencion">Atencion al cliente</small>';
                     $formulario .= '<p class="nombre-asesor">' . get_theme_mod('texto_asesor') .'</p>'; 
                     $formulario .= '<div class="green"></div>
                     <h5 class="online">Online</h5>
                 </div>  </div>';
				
				  
			  $formulario .= ' </div>
			   <div class="content-formulario">';
			   $formulario .= '<form action="' . admin_url('admin-ajax.php')  . '" method="post" id="formulario">';
			   $formulario .= '<div class="dato">
			   <input type="text" name="nombre" placeholder="Nombre" id="nombre">
			   </div>
			   <div class="dato">
			   <input type="email" name="correo" placeholder="email" id="email">
			   </div>
			   <div class="dato"> 
			   <input type="tel" name="telefono" placeholder="Numero de whatsapp" id="telefono">
			   </div>';
               $formulario .= '<a type="submit"  class="enviar" id="enviar" href="" >' . get_theme_mod('texto_btn_enviar') . '</a>';
			   
			   $formulario .= '</form>
			   </div> 
			   <div class="whatsapp-btn">';
			    
			    $formulario .=  '<img src=" ' . esc_url($image_whatsapp) .' " alt="WhatsApp Image"/>';
			    $formulario .= '<p>' .  get_theme_mod('texto_whatsapp') . '</p>
			   </div>
		   </div>
		 
		 </div>
        
    ';

    return $formulario;
}
add_shortcode('formulario_registro', 'mostrar_formulario_registro'); 




// Agrega un enlace a la variable JavaScript 
add_action('wp_head', 'my_ajax_script');
function my_ajax_script() {
    wp_enqueue_script('scriptForm', plugins_url('/js/plugin.js', __FILE__), array('jquery'), '1.0', true);
    wp_localize_script('scriptForm', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

// funcion para manejar la solicitud
add_action('wp_ajax_procesar_formulario', 'procesar_formulario');
add_action('wp_ajax_nopriv_procesar_formulario', 'procesar_formulario'); // Para usuarios no autenticados

function procesar_formulario() {
    // Recibe los datos del formulario
    $form_data = $_POST['formData'];

    // Realiza cualquier procesamiento necesario con los datos

    // Envía una respuesta (puedes enviar cualquier cosa que necesites)
    echo '¡Formulario procesado correctamente!';
    wp_die(); // Siempre usa wp_die al final de tu función de AJAX
}




/* estilos para el plugin  */

function enqueue_plugin_styles() {
    wp_enqueue_style('estilos-plugin', plugins_url('css/plugin.css', __FILE__));
    wp_enqueue_script('scripts-plugin', plugins_url('js/plugin.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');


function whatsapp_options_plugin($wp_customize) {

    $wp_customize->add_section('opciones_whatsapp', array(
        'title' => 'Opciones WhatsApp',
        'priority' => 30,
    ));

	$wp_customize->add_setting('imagen_encabezado');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'imagen_encabezado_control', array(
        'label' => 'Seleccionar imagen para encabezado',
        'section' => 'opciones_whatsapp',
        'settings' => 'imagen_encabezado',
    ))); 

	$wp_customize->add_setting('imagen_whatsapp');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'imagen_whatsapp_control', array(
        'label' => 'Seleccionar imagen para WhatsApp',
        'section' => 'opciones_whatsapp',
        'settings' => 'imagen_whatsapp',
    ))); 

	$wp_customize->add_setting('texto_whatsapp');
    $wp_customize->add_control('texto_whatsapp_control', array(
        'label' => 'Texto para WhatsApp',
        'section' => 'opciones_whatsapp',
        'settings' => 'texto_whatsapp',
        'type' => 'text',
    ));
	$wp_customize->add_setting('texto_encabezado');
    $wp_customize->add_control('texto_encabezado_control', array(
        'label' => 'Texto para WhatsApp',
        'section' => 'opciones_whatsapp',
        'settings' => 'texto_encabezado',
        'type' => 'text',
    ));

    $wp_customize->add_setting('texto_asesor');
    $wp_customize->add_control('texto_asesor_control', array(
        'label' => 'Texto para Nombre de asesor',
        'section' => 'opciones_whatsapp',
        'settings' => 'texto_asesor',
        'type' => 'text',
    ));

    $wp_customize->add_setting('texto_btn_enviar');
    $wp_customize->add_control('texto_btn_enviar_control', array(
        'label' => 'Texto para boton enviar',
        'section' => 'opciones_whatsapp',
        'settings' => 'texto_btn_enviar',
        'type' => 'text',
    ));

    // Agregar control de URL
    $wp_customize->add_setting('mi_whatsapp_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mi_whatsapp_url', array(
        'label' => 'Ingrese la URL',
        'section' => 'opciones_whatsapp',
        'settings' => 'mi_whatsapp_url',
        'type' => 'url',
    )));
}
add_action('customize_register', 'whatsapp_options_plugin');





/*   end funcionalidad whatsapp   */

?>