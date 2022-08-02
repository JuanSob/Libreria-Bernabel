<div class="container py-5 mx-auto min-vh-100">
    <br><br><br>
    <div class="col-md-4 p-0 mb-4">
        <button class="btn primary" onclick="goBack()"><i class="fas fa-arrow-left mx-2"></i>Regresar</button>
    </div>

    <div class="header">
        <div class="row justify-content-center">
            <div class="col-md-9 mt-2 text-center">
                <h2 class="display-3">{{LibroNombre}}</h2>
            </div>
        </div>
    </div>

    <div class="row">  
        <div class="col-lg-2 d-flex flex-column justify-content-center">
            {{foreach AllProductMedia}}
                <div class="my-4 border">
                    <a href="{{MediaPath}}">
                        <img class="rounded mx-auto d-block" src="{{MediaPath}}" width="60%">
                    </a>
                </div>
            {{endfor AllProductMedia}}
        </div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-md-6"> 
                    <img src="{{PrimaryMediaPath}}" alt="{{PrimaryMediaDoc}}" width="90%"> 
                </div>

                <div class="col-md-6">
                    <h3 class="mb-4">Lps.{{LibroPrecioVenta}}</h3>
                    <h4 class="mb-4">Descripción</h4>
                    <p class="lead">
                        {{LibroDescripcion}}
                    </p>
                    
                    <form method="POST" action="index.php?page=visualizarproducto&LibrodId={{LibrodId}}">
                        <input type="hidden" name="ProdPrecioVenta" value={{LibroPrecioVenta}}>
                        <input type="hidden" name="ProdStock" value={{LibroStock}}>
                        <label class="font-weight-bold" for="ProdCantidad">Cantidad</label>
                        <br/>
                        <input class="form-control col-md-2" type="number" id="ProdCantidad" name="ProdCantidad" min="1" value="{{ProdCantidad}}">
                        <button class="btn btn-lg primary mt-4" type="submit" id="btnAgregarCarrito"><i class="fas fa-shopping-cart mx-2"></i>Agregar al carrito</button>
                    </form>

                    {{if Error}}
                        <p class="text-danger font-weight-bold my-4">{{Error}}</p>
                    {{endif Error}}

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function goBack() 
    {
        window.history.back();
    }
</script>