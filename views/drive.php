<head>
    <title>Drive</title>
</head>
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row ml-0">
                    <h1 class="mr-3 mb-2">Drive</h1>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content scroll">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="drive-container">
                            <div class="navigation">
                                <a id="inicio"><i class="fa-solid fa-rotate-left"></i> Volver al inicio</a>
                                <small id="texto-cargando"></small>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="cargar-archivo">

                                    </div>
                                    <div class="col-sm-3">
                                        <button style="width: 100%" class="btn btn-success guardar-archivo"><i class="fas fa-upload"></i> Subir Archivo</button>

                                    </div>
                                </div>
                                <div class="cargar">
                                    <button class="btn crear-carpeta"><i class="fas fa-folder-plus"></i> Crear Carpeta</button>
                                </div>
                            </div>
                            <div id="contenedor-elementos"></div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    var repositorio = new Repositorio();

    $(document).ready(async () => {
        await repositorio.listarCarpeta();

        document.querySelector('#inicio').addEventListener('click', function() {
            repositorio.carpetaPrincipal = repositorio.key;
            repositorio.listarCarpeta();
        });


        document.querySelector(".guardar-archivo").addEventListener("click", async () => {
            const archivoSeleccionado = document.getElementById("cargar-archivo").files[0];
            if (archivoSeleccionado) {
                let respuesta = await repositorio.crearArchivo(archivoSeleccionado);
                if (respuesta) {
                    alert("Archivo " + archivoSeleccionado.name + " Subido Correctamente");
                    document.getElementById("cargar-archivo").value = null;
                }
                repositorio.listarCarpeta();
            } else {
                alert("Ningún archivo seleccionado");
            }
        });


        document.querySelector(".crear-carpeta").addEventListener("click", async () => {
            const nombre = prompt("Ingrese el nombre de la Carpeta:");
            if (nombre !== null && nombre !== "") {
                let respuesta = await repositorio.crearCarpeta(nombre);
                if (respuesta) {
                    alert("Carpeta " + nombre + " creada correctamente");
                }
                repositorio.listarCarpeta();
            } else {
                alert("No ingresaste un nombre válido. Por favor, inténtalo de nuevo.");
            }
        });
    });


    /*DIBUJAR LAS CARPETAS Y ARCHIVOS*/
    function mostrarElementos() {
        const contenedorElementos = document.getElementById('contenedor-elementos');
        contenedorElementos.innerHTML = "";
        repositorio.listadoDirectorios.forEach((elemento) => {
            const elementoDOM = document.createElement('div');
            elementoDOM.className = elemento.tipo === 'carpeta' ? 'folder' : 'file';
            elementoDOM.style.cursor = "pointer"

            const elementoIcono = document.createElement('i');
            elementoIcono.className = elemento.tipo === 'carpeta' ? 'fa-regular fa-folder' : 'fa-regular fa-file-lines';
            elementoIcono.style.fontSize = '25px';
            elementoIcono.style.marginRight = '15px';
            elementoIcono.style.width = '26px';
            const elementoNombre = document.createElement('div');
            elementoNombre.className = 'nombre';
            elementoNombre.textContent = elemento.nombre;

            elementoDOM.appendChild(elementoIcono);
            elementoDOM.appendChild(elementoNombre);

            if (elemento.tipo === 'carpeta') {
                elementoDOM.ondblclick = () => {
                    console.log('Doble clic: ' + elemento.nombre);
                    repositorio.carpetaPrincipal = elemento.id
                    repositorio.listarCarpeta();
                };

                const botonEliminar = document.createElement('button');
                botonEliminar.className = 'delete-button';
                botonEliminar.textContent = 'Eliminar';
                botonEliminar.onclick = async () => {
                    await repositorio.eliminarCarpeta(elemento.id);
                    alert("La Carpeta " + elemento.nombre + " fue eliminada");
                    repositorio.listarCarpeta();
                };

                elementoDOM.appendChild(botonEliminar);
            } else {
                const botonEliminar = document.createElement('button');
                botonEliminar.className = 'delete-button';
                botonEliminar.textContent = 'Eliminar';
                botonEliminar.onclick = async () => {
                    await repositorio.eliminarArchivo(elemento.id);
                    alert("El archivo " + elemento.nombre + " fue eliminado");
                    repositorio.listarCarpeta();
                };

                elementoDOM.appendChild(botonEliminar);
            }

            contenedorElementos.appendChild(elementoDOM);
        });
    }

    function mostrarMensaje(estado) {
        let mensaje = estado ? "Cargando..." : "";
        const texto = document.getElementById("texto-cargando");
        texto.textContent = mensaje;
        texto.style.color = "red";
        texto.style.fontWeight = 700;
    }
</script>