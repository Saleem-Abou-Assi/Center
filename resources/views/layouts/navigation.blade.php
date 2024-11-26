
    
      
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
                        <a href="{{ route(name: 'department.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('departments.*') ? 'border-b-2 border-blue-500' : '' }}">العيادات</a>
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
                <li class="loglog">
                <div class="dropdown">  
                    <a class="dropbtn" onclick="toggleDropdown()">
                
                    </a>  
                    <div class="inside">
                    <img src="images/login.png" alt="log-con" class="log-con mr-2">
                    <div>{{ Auth::user()->name }}</div>
                    </div> 
                    <div class="dropdown-content" id="dropdownContent">  
                        <a href="{{ route('profile.edit') }}">الحساب الشخصي</a>
                        <a href="{{ route('logout') }}" style="color:red">تسجيل خروج</a>  
                    </div>  
                </div>  

                </li>
                </ul>

               
            
             
          </div>
      </div>
  
             
</nav>
<style>
    .loglog{
        position: absolute;
        left: 90%;
    }
    .inside{
        display: flex;  
        position: relative;
        align-content:center ;
        justify-content: center;
        font-size: 20px;
        grid-column: 1;
        z-index: 1;
        grid-row: 1;
        width: 80px;
        height: auto;
        flex-wrap:wrap;

    }
     .dropdown {  
       display: grid;
       grid-template-columns: repeat(1,80px); 
      grid-template-rows: repeat(1,50px);
      
    }  
    
    .inside img {
        width: 35px;
        z-index: 0; /* Ensure the image is below the dropdown */
    }

    .dropbtn {  
        background-color: transparent; /* Make background transparent */
        color: inherit;  
        position: inherit;  
       width: 70px;;
       height: auto;
        border: none;  
        cursor: pointer;  
       z-index: 10;
       grid-column: 1;
       grid-row: 1;
        
    }  

    .dropdown-content {  
        display: none; /* Keep this as 'none' initially */  
        position: absolute;  
        top: 80px;
        font-weight: 20px;
        background-color: #f9f9f9;  
        min-width: 160px;  
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);  
        z-index: 20; /* Ensure dropdown is above other elements */
    }  

    .dropdown-content a {  
        color: black;  
        padding: 12px 16px;  
        text-decoration: none;  
        display: block;  
    }  

    .dropdown-content a:hover {  
        background-color: #007561c5; 
        color: white; /* Change text color on hover */
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
<script>
     function toggleDropdown() {  
    const dropdownContent = document.getElementById("dropdownContent");  
    dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block"; // Toggle display  
}  

// Optional: Close the dropdown if the user clicks outside of it  
window.onclick = function(event) {  
    if (!event.target.matches('.dropbtn')) {  
        const dropdowns = document.getElementsByClassName("dropdown-content");  
        for (let i = 0; i < dropdowns.length; i++) {  
            if (dropdowns[i].style.display === "block") {  
                dropdowns[i].style.display = "none";  
            }  
        }  
    }  
}  

function logout() {  
    // Logic for logout action  
    alert('Logging out...');  
}  

function viewProfile() {  
    // Logic for viewing the profile  
    alert('Viewing profile...');  
}
</script>