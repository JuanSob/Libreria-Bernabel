<section class="container-fluid" id="productos">
    <br><br><br>
    <h4 class="my-4   justify-content text-center p-3 mb-2 text-light " style="background-color: #653719; ">{{PageTitle}}</h4>
    
    <form class="form-inline align-items-center d-flex justify-content-center mb-4" action="index.php" method="GET">
        <input type="hidden" name="page" value="catalogoproductos"/>
        <input type="hidden" name="PageIndex" value="1" />

        <input type="search" class="form-control col-8" id="UsuarioBusqueda" name="UsuarioBusqueda" value="{{UsuarioBusqueda}}" placeholder="Ingrese su busqueda">
        <button type="submit" class="btn btn-primary mx-2">Buscar</button>
    </form>
    
    <div class="row">
        {{foreach Productos}}
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body align-items-center d-flex flex-column justify-content-center">
                    <a href="index.php?page=visualizarproducto&ProdId={{LibrodId}}"><img class="card-img-top mb-4" src="{{MediaPath}}" alt="{{MediaDoc}}" style="width: 200px"></a>
                    <h4 class="card-title text-center mb-4">
                        <a href="index.php?page=visualizarproducto&ProdId={{LibrodId}}">{{LibroNombre}}</a>
                    </h4>
                    <h5 class="mb-4">Lps. {{LibroPrecioVenta}}</h5>
                    <p class="card-text">{{LibroDescripcion}}</p>
                </div>
            </div>
        </div>
        {{endfor Productos}}
    </div>

    <div class="row">
        <div class="col-md-12 d-flex">
            <ul class="pagination mx-auto"> 
                <li class="page-item {{PreviousState}}">
                    <a class="page-link" href="index.php?page=catalogoproductos&PageIndex={{Previous}}" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                </li>

                  {{foreach PageIndexes}}
                    <li class="page-item {{Estado}}"><a class="page-link" href="index.php?page=catalogoproductos&PageIndex={{Index}}{{if Busqueda}}&UsuarioBusqueda={{Busqueda}}{{endif Busqueda}}">{{Index}}</a></li>
                  {{endfor PageIndexes}}

                <li class="page-item {{NextState}}">
                    <a class="page-link" href="index.php?page=catalogoproductos&PageIndex={{Next}}" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>