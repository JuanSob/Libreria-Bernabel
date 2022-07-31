<section class="container-fluid min-vh-100">

    <h3 class="my-4 text-center display-4 mb-2">Gestión de Libros</h3>

    <div class="rounded">
        <form method="POST" action="index.php?page=admin_libros">
        <div class="form-row">
            <div class="col-10">
                <input type="search" class="form-control rounded" id="ProductoBusqueda" name="ProductoBusqueda" value="{{ProductoBusqueda}}" placeholder="Ingrese su busqueda">
            </div>
            <div class="col-2">
                <button type="submit" class="fas fa-search mb-3 rounded" id="btnBuscar" name="btnBuscar"> Buscar</button>
            </div>
        </div>
        </form> 
    </div>

    <div class="table-responsive table-hover rounded">
        <table class="table">
            <thead class="thead text-light" style="background-color: #653719">
                <tr>
                <th class="text-center align-middle">Código</th>
                <th class="text-center align-middle">Libro</th>
                <th class="text-center align-middle">Descripción</th>
                <th class="text-center align-middle">Precio Venta</th>
                <th class="text-center align-middle">Precio Compra</th>
                <th class="text-center align-middle">Estado</th>
                <th class="text-center align-middle">Stock</th>
                <th class="text-center align-middle"><button type="button" class="btn primary my-2" id="btnAdd">Nuevo</button></th>
                </tr>
            </thead>
            <tbody>
                {{foreach items}}
                <tr>
                    <td class="text-center align-middle">{{LibrodId}}</td>
                    <td class="text-center align-middle"><a href="index.php?page=admin_libro&mode=DSP&LibrodId={{LibrodId}}">{{LibroNombre}}</a></td>
                    <td class="text-center align-middle">{{LibroDescripcion}}</td>
                    <td class="text-center align-middle">{{LibroPrecioVenta}}</td>
                    <td class="text-center align-middle">{{LibroPrecioCompra}}</td>
                    <td class="text-center align-middle">{{LibroEst}}</td>
                    <td class="text-center align-middle">{{LibroStock}}</td>
                    <td class="text-center align-middle">
                    <form action="index.php" method="get">
                        <input type="hidden" name="page" value="admin_libro"/>
                        <input type="hidden" name="mode" value="UPD" />
                        <input type="hidden" name="LibrodId" value={{LibrodId}} />
                        <button type="submit" class="btn primary my-1">Editar</button>
                    </form>
                    <form action="index.php" method="get">
                        <input type="hidden" name="page" value="admin_libro"/>
                        <input type="hidden" name="mode" value="DEL" />
                        <input type="hidden" name="LibrodId" value={{LibrodId}} />
                        <button type="submit" class="btn btn-danger my-1">Eliminar</button>
                    </form>
                    </td>
                </tr>
                {{endfor items}}
            </tbody>
        </table>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function () 
    {
        document.getElementById("btnAdd").addEventListener("click", function (e){
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=admin_libro&mode=INS&LibrodId=0");
        });
    });
</script>
