<section class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card my-5 w-100">
      <div class="card-header text-light" style="background-color: #653719">
        <h3 class="text-center">{{mode_dsc}}</h3>
      </div>
      <div class="card-body"> 
        <form class="grid" method="post" action="index.php?page=admin_pedido&mode={{mode}}&VentaId={{VentaId}}">
  
          <div class="row">
            <label class="col-12 col-m-4 flex center" for="CategoriaId">Código</label>
            <input type="hidden" class="width-full center" class="form-control" id="VentaId" name="VentaId" value="{{VentaId}}"/>
            <input readonly type="text" class="width-full center disabled" class="form-control" name="VentaIdDummy" value="{{VentaId}}"/>
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="VentaFecha">Fecha de la Venta</label>
            <input class="width-full center" type="text" class="form-control" readonly id="VentaFecha" name="VentaFecha" value="{{VentaFecha}}" maxlength="80">
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="VentaISV">Impuesto sobre la Venta</label>
            <input class="width-full center" type="text" class="form-control" readonly id="VentaISV" name="VentaISV" value="{{VentaISV}}" maxlength="80">
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="VentaEst">Estado de la Venta</label>
            <input class="width-full center" type="text" class="form-control" readonly id="VentaEst" name="VentaEst" value="{{VentaEst}}" maxlength="80">
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="UsuarioNombre">Nombre del Cliente</label>
            <input class="width-full center" type="text" class="form-control" readonly id="UsuarioNombre" name="UsuarioNombre" value="{{UsuarioNombre}}" maxlength="80">
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="ClienteDireccion">Dirección del Cliente</label>
            <textarea class="form-control" type="text" class="form-control" readonly id="ClienteDireccion" name="ClienteDireccion" maxlength="300">{{ClienteDireccion}}</textarea>
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="ClienteTelefono">Télefono del Cliente</label>
            <input class="width-full center" type="text" class="form-control" readonly id="ClienteTelefono" name="ClienteTelefono" value="{{ClienteTelefono}}" maxlength="80">
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="VentaLinkDevolucion">Link para Devolución</label>
            <input class="width-full center" type="text" class="form-control" readonly id="VentaLinkDevolucion" name="VentaLinkDevolucion" value="{{VentaLinkDevolucion}}" maxlength="80">
          </div>

          <div class="row">
            <label class="col-12 col-m-4 flex center" for="VentaLinkOrden">Link para Orden en Paypal</label>
            <input class="width-full center" type="text" class="form-control" readonly id="VentaLinkOrden" name="VentaLinkOrden" value="{{VentaLinkOrden}}" maxlength="80">
          </div>
          <br>
          <div class="table-responsive table-hover rounded py-3">
            <table class="table">
            <thead class="thead text-light" style="background-color: #653719">
                <tr>
                <th class="text-center align-middle">Código del Producto</th>
                <th class="text-center align-middle">Nombre del Producto</th>
                <th class="text-center align-middle">Descripcion del Producto</th>
                <th class="text-center align-middle">Precio del Producto</th>
                <th class="text-center align-middle">Cantidad de Producto</th>
                </tr>
            </thead>
            <tbody>
                {{foreach Productos}}
                <tr>
                    <td class="text-center align-middle">{{LibrodId}}</td>
                    <td class="text-center align-middle">{{LibroNombre}}</td>
                    <td class="text-center align-middle">{{LibroDescripcion}}</td>
                    <td class="text-center align-middle">{{LibroPrecioVenta}}</td>
                    <td class="text-center align-middle">{{VentasProdCantidad}}</td>
                </tr>
                {{endfor Productos}}
            </tbody>
          </table>
        </div>

        <div class="row">
          <label class="col-12 col-m-4 flex center" for="VentaCantidadTotal">Ganacia Bruta</label>
          <input class="width-full center" type="text" class="form-control" readonly id="VentaCantidadTotal" name="VentaCantidadTotal" value="{{VentaCantidadTotal}}" maxlength="80">
        </div>

        <div class="row">
          <label class="col-12 col-m-4 flex center" for="VentaComisionPayPal">Comisión de Paypal</label>
          <input class="width-full center" type="text" class="form-control" readonly id="VentaComisionPayPal" name="VentaComisionPayPal" value="{{VentaComisionPayPal}}" maxlength="80">
        </div>

        <div class="row">
          <label class="col-12 col-m-4 flex center" for="VentaCantidadNeta">Ganancia Neta</label>
          <input class="width-full center" type="text" class="form-control" readonly id="VentaCantidadNeta" name="VentaCantidadNeta" value="{{VentaCantidadNeta}}" maxlength="80">
        </div>
          <div class="row center flex-end px-3 py-3">
            {{if showaction}}
              <button type="submit" class="btn btn-block primary" id="btnGuardar" name="btnGuardar">Cambiar Estado</button>
            {{endif showaction}}
            <button type="button" class="btn btn-block btn-danger" id="btnCancelar" name="btnCancelar">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  
  <script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById("btnCancelar").addEventListener("click", function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=admin_pedidos");
        });
    });
  </script>
  
  
  
