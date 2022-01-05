          <li class="nav-item has-treeview menu-open">
          <a class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Adm. usuario
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
                  <a href="{{ url('/rol/listar')}}"  class="nav-link ">
                    <i class="fas fa-stream"></i>  Gestionar rol</a>
                  </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
                  <a href="{{ url('/usuario/listar') }}" class="nav-link ">
                    <i class="fas fa-stream"></i>  Gestionar personal de la empresa</a>
                  </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
                  <a href="{{ url('/empresa/listar') }}" class="nav-link ">
                    <i class="fas fa-stream"></i>  Gestionar empresa</a>
                  </li>
                </ul>


                <ul class="nav nav-treeview">
                <li class="nav-item has-treeview menu-open">
                <a href="{{ url('/bitacora/listar')}}"  class="nav-link ">
                  <i class="fas fa-stream"></i>  Gestionar bitacora</a>
                </li>
                </ul>

          </li>



          <li class="nav-item has-treeview menu-open">
          <a class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Adm. Cliente
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
                  <a href="{{ url('/cliente/listar') }}" class="nav-link ">
                    <i class="fas fa-stream"></i>  Gestionar cliente</a>
                  </li>
                </ul>

                
          </li>
            
            


          <li class="nav-item has-treeview menu-open">
          <a class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Adm. transacción
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/cobro/listar') }}" class="nav-link ">
              <i class="fas fa-stream"></i>  Gestionar cobro</a>
            </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
               <a href="{{ route('pedidos.listar') }}" class="nav-link ">
                   <i class="fas fa-stream"></i>Gestionar Pedidos</a>
           </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
               <a href="{{ route('productos.listar') }}" class="nav-link ">
                   <i class="fas fa-stream"></i>Gestionar Productos</a>
           </li>
                </ul>

                
          </li>  

           
           <li class="nav-item has-treeview menu-open">
          <a class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Adm. transacción
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/categoria/listar') }}" class="nav-link ">
              <i class="fas fa-stream"></i>  Gestionar categoria</a>
            </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/subcategoria/listar') }}" class="nav-link ">
              <i class="fas fa-stream"></i>  Gestionar subcategoria</a>
            </li>
                </ul>
                

                
          </li>  

            

            

            

            

            
            
            

           
            
