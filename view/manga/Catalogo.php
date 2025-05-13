       <div class="Grid">
                <div class="Busqueda">
            <input type="search" id="buscarTitulo" placeholder="Busca tu manga favorito" onchange="buscarMangas()">
          </div>
            <div class="Filtros">
                <form id="form-filtros">
                    <fieldset class="filtro-categoria" id="filtro-tipo">
                        <legend>Tipo</legend>
                        <label><input type="radio" name="tipo" value="manga" onchange="aplicarFiltros()"> Manga</label><br>
                        <label><input type="radio" name="tipo" value="novel" onchange="aplicarFiltros()"> Novela</label><br>
                        <label><input type="radio" name="tipo" value="lightnovel" onchange="aplicarFiltros()"> Light Novel</label><br>
                        <label><input type="radio" name="tipo" value="manhwa" onchange="aplicarFiltros()"> Manhwa</label><br>
                        <label><input type="radio" name="tipo" value="manhua" onchange="aplicarFiltros()"> Manhua</label>
                    </fieldset>
                </form>
                <form id="form-filtros2">
                    <fieldset class="filtro-categoria" id="filtro-tipo2">
                        <legend>Tipo</legend>
                        <label><input type="checkbox" name="tipo" value="paja" onchange="aplicarNsfw()"> Paja</label><br>
                    </fieldset>
                </form>
                <form id="form-filtros3">
                    <fieldset class="filtro-categoria" id="filtro-tipo3">
                        <legend>Tipo</legend>
                        <label><input id="fechaInicio" type="text" name="tipo" value="1934" style="width: 40px;" onkeydown="cambioFecha(event)"> Año de Inicio</label><br>
                        <label><input id="fechaFinal" type="text" name="tipo" value="2025" style="width: 40px;" onkeydown="cambioFecha(event)"> Año ......Final</label><br> <!-- Alineado con psint -->
                    </fieldset>
                </form>
            </div> 
            
            <div class="Catalogo">
               
            </div>
            
            <div class="Paginacion">
                
                
            </div>
</div>