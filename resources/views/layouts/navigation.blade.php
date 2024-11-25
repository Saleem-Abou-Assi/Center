
    
      
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
                <li>
                    <div class="log flex items-center relative" x-data="{ openModal: false }">
                        <a href="#" class="flex items-center" @click.prevent="openModal = true">
                            <img src="images/login.png" alt="log-con" class="log-con mr-2">
                            <div>{{ Auth::user()->name }}</div>
                        </a>
                        
                        <div x-show="openModal" class="modal fixed inset-0 flex items-center justify-center z-50" @click.away="openModal = false" style="display: none;">
                            <div class="modal-content bg-white border border-gray-300 rounded-md shadow-lg p-4">
                                <h3 class="text-lg font-semibold">Options</h3>
                                <a href="{{ route('profile.edit') }}" class="dropdown-link block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-link block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                                <button @click="openModal = false" class="mt-2 text-gray-500 hover:text-gray-700">Close</button>
                            </div>
                        </div>
                    </div>
                </li>
                </ul>

               
                <!-- <div class="hidden sm:flex sm:items-center sm:ms-6">
                  <x-dropdown align-items="right" width="48">
                      <x-slot name="trigger">
                          <button class="dropdown-button">
                             
                              <div class="ms-1">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                  </svg>
                              </div>
                          </button>
                      </x-slot>
  
                      <x-slot name="content" class="dropdown-content">
                          <x-dropdown-link :href="route('profile.edit')" class="dropdown-link">
                              {{ __('Profile') }}
                          </x-dropdown-link>
  
                           Authentication 
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
  
                              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                  this.closest('form').submit();" class="dropdown-link">
                                  {{ __('Log Out') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
              </div> -->
               
  
             
          </div>
      </div>
  
             
</nav>
<style>
    .log{
        display: flex;
        align-items: center;
        position: absolute;
        right: 0;
        top: 0;
        padding-top: 10px;
    }
    .log-con{
        width: 35px;
        height: 35px;
        margin-right: 8px;
    }
    .log a {
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
    }
    .log a:hover {
        color: white;
    }
   .dropdown-button {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border: 1px solid transparent;
        border-radius: 0.375rem;
        background-color: #ffffff; /* Light background */
        color: #4a5568; /* Text color */
        transition: background-color 0.3s, color 0.3s; /* Smooth transition */
    }

    .dropdown-button:hover {
        background-color: #edf2f7; /* Light gray on hover */
        color: #2d3748; /* Darker text color on hover */
    }

    /* Dropdown content styles */
    .dropdown-content {
        display: none; /* Hidden by default */
        position: absolute;
        background-color: #ffffff; /* White background */
        border: 1px solid #e2e8f0; /* Light gray border */
        border-radius: 0.375rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        z-index: 10; /* Ensure it appears above other elements */
        margin-top: 0.5rem; /* Space between button and dropdown */
    }

    /* Show dropdown on hover */
    .dropdown:hover .dropdown-content {
        display: block; /* Show dropdown */
    }

    /* Dropdown link styles */
    .dropdown-link {
        display: block;
        padding: 0.5rem 1rem;
        color: #4a5568; /* Text color */
        text-decoration: none; /* Remove underline */
        transition: background-color 0.3s; /* Smooth transition */
    }

    .dropdown-link:hover {
        background-color: #edf2f7; /* Light gray on hover */
        color: #2d3748; /* Darker text color on hover */
    }
    .nav{
    font-family: 'Cairo', sans-serif;
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