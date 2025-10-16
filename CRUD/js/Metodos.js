

    //Ingreso
      $(document).ready(function() {
            $('#ingreso').on('submit', function(e) {
                e.preventDefault(); // Evita que el formulario se envíe normalmente

                $.ajax({
                    url: 'conexion.php',
                    type: 'POST',
                    data: $(this).serialize(), // Serializa los datos del formulario
                    success: function(respuesta) {
                        $('#respuesta').html('<p>' + respuesta + '</p>');
                    },
                    error: function() {
                        $('#respuesta').html('<p>Error al enviar el formulario.</p>');
                    }
                });
            });
        });


  //buscar

 $(document).ready(function () {
    let delayTimer;

    // Buscar al escribir con un pequeño retraso
    $('#busqueda').on('keyup', function (e) {
        clearTimeout(delayTimer);

        // Si se presiona Enter, hacer búsqueda inmediata
        if (e.key === 'Enter') {
            buscarMateriales($(this).val());
            return;
        }

        delayTimer = setTimeout(function () {
            let texto = $('#busqueda').val();
            buscarMateriales(texto);
        }, 300);
    });

    // Buscar al hacer clic en el botón
    $('#btnBuscar').on('click', function () {
        let texto = $('#busqueda').val();
        buscarMateriales(texto);
    });

    function buscarMateriales(texto) {
        if (texto.trim() === '') {
            $('#tablaMateriales tbody').html('<tr><td colspan="6">Escribe algo para buscar</td></tr>');
            return;
        }

        $('#tablaMateriales tbody').html('<tr><td colspan="6">Buscando...</td></tr>');

        $.ajax({
            url: 'buscar.php',
            method: 'POST',
            data: { nombre: texto },
            dataType: 'json',
            success: function (data) {
                let filas = '';

                if (data.length > 0) {
                    $.each(data, function (i, material) {
                        filas += `<tr>
                            <td>${material.id}</td>
                            <td>${material.nombre}</td>
                            <td>${material.unidad_medida}</td>
                            <td>${material.precio}</td>
                            <td>${material.stock}</td>
                            <td>${material.total}</td>
                        </tr>`;
                    });
                } else {
                    filas = '<tr><td colspan="6">No se encontraron materiales.</td></tr>';
                }

                $('#tablaResultados tbody').html(filas);
            },
            error: function (xhr, status, error) {
                console.error("Error AJAX:", error);
                console.log("Respuesta del servidor:", xhr.responseText);
                $('#tablaResultados tbody').html('<tr><td colspan="6">❌ Error al buscar materiales</td></tr>');
            }
        });
    }
});


//modificar


      $(document).ready(function() {
            $('#modificar').on('submit', function(e) {
                e.preventDefault(); // Evita que el formulario se envíe normalmente
                
                $.ajax({
                    url: 'modificar.php',
                    type: 'POST',
                    data: $(this).serialize(), // Serializa los datos del formulario
                    success: function(respuesta) {
                        $('#respuesta').html('<p>' + respuesta + '</p>');
                    },
                    error: function() {
                        $('#respuesta').html('<p>Error al enviar el formulario.</p>');
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#eliminar').on('submit', function(e) {
                e.preventDefault(); // Evita que el formulario se envíe normalmente
                
                $.ajax({
                    url: 'eliminar.php',
                    type: 'POST',
                    data: $(this).serialize(), // Serializa los datos del formulario
                    success: function(respuesta) {
                        $('#respuesta').html('<p>' + respuesta + '</p>');
                    },
                    error: function() {
                        $('#respuesta').html('<p>Error al enviar el formulario.</p>');
                    }
                });
            });
        });

