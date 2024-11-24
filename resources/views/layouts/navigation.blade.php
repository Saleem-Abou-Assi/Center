
    
      
<nav class="nav">
    
       

            <!-- Navigation Links -->
            
                <ul class="nav-items">
                <li>
                    <a href="{{route('home')}}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('departments.*') ? 'border-b-2 border-blue-500' : '' }}">
                        الصفحة الرئيسية
                    </a>
                </li>
                    <li>
                         <a href="{{ route('patient.index') }}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('patients.*') ? 'border-b-2 border-blue-500' : '' }}">
                             المرضى
                         </a>
                    </li>
                    <li>
                         <a href="{{ route('doctor.index') }}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('doctors.*') ? 'border-b-2 border-blue-500' : '' }}">
                        الأطباء
                        </a>
                </li>
                <li>
                        <a href="{{ route(name: 'department.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('departments.*') ? 'border-b-2 border-blue-500' : '' }}">الأقسام</a>
                </li>
                <li>
                <a href="{{ route(name: 'book.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('book') ? 'border-b-2 border-blue-500' : '' }}">الحجوزات</a>

                </li>
                <li>
                         <a href="{{ route(name: 'patientDept.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('patientDept') ? 'border-b-2 border-blue-500' : '' }}">معاينات المريض</a>
                </li>
                
                <li>
                  <a href="{{ route(name: 'lazer.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('lazer') ? 'border-b-2 border-blue-500' : '' }}">الليزر </a>
                </li>  
                </ul>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                  <x-dropdown align="right" width="48">
                      <x-slot name="trigger">
                          <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                              <div>{{ Auth::user()->name }}</div>
  
                              <div class="ms-1">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                  </svg>
                              </div>
                          </button>
                      </x-slot>
  
                      <x-slot name="content">
                          <x-dropdown-link :href="route('profile.edit')">
                              {{ __('Profile') }}
                          </x-dropdown-link>
  
                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
  
                              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                  this.closest('form').submit();">
                                  {{ __('Log Out') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
              </div>
  
              <!-- Hamburger -->
              <div class="-me-2 flex items-center sm:hidden">
                  <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                      <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                          <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                          <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>
          </div>
      </div>
  
             
</nav>
<style>

    .nav{
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    justify-content: space-between;
    align-items: center;
    display: fixed;
    top: 0;
    
  }
  .nav-items{
    list-style: none;
    display: flex;
    padding-left:10px;
    align-items: center;
  }
  .nav-items > li{
    padding: 10px;
  }
  
  li a:hover{
    background-color:#007561c5 ;
    color: white;
    text-decoration: none;  
  }
  li a {
    display: block;
    color: #000;
    padding: 16px 16px;
    text-decoration: none;
      border-bottom: none;   
  }
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 100%;
    height: fit-content;
    background-color: #f1f1f1;
  }
</style>