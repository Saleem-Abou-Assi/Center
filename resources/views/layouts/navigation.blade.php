
    
      
<nav class="nav">
    
       

            <!-- Navigation Links -->
            
                <ul class="nav-items">
                <li>
                    <a href="{{route('home')}}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('departments.*') ? 'border-b-2 border-blue-500' : '' }}">
                        Home
                    </a>
                </li>
                    <li>
                         <a href="{{ route('patient.index') }}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('patients.*') ? 'border-b-2 border-blue-500' : '' }}">
                             Patients
                         </a>
                    </li>
                    <li>
                         <a href="{{ route('doctor.index') }}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('doctors.*') ? 'border-b-2 border-blue-500' : '' }}">
                        Doctors
                        </a>
                </li>
                <li>
                        <a href="{{ route(name: 'department.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('departments.*') ? 'border-b-2 border-blue-500' : '' }}">Department</a>
                </li>
                <li>
                <a href="{{ route(name: 'book.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('book') ? 'border-b-2 border-blue-500' : '' }}">Books</a>

                </li>
                <li>
                         <a href="{{ route(name: 'patientDept.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('patientDept') ? 'border-b-2 border-blue-500' : '' }}">معاينات المريض</a>
                </li>
             
                </ul>
             
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