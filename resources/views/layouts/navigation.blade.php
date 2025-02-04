<head>
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/all.min.css') }}">
</head>
<body>
      
<nav class="nav">
    
       

            <!-- Navigation Links -->
            
                <ul class="nav-items">
                <li>
                    <a href="{{route('home')}}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('departments.*') ? 'border-b-2 border-blue-500' : '' }}">
                        الصفحة الرئيسية
                    </a>
                </li>
                  
                    @if (Auth::user()->hasRole('doctor'))
                    <li>
                        <a href="{{ route('doctor.show',[ 'doctor_id'=>Auth::user()->Doctor->id]) }}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('doctor.*') ? 'border-b-2 border-blue-500' : '' }}">
                            المرضى
                        </a>
                   </li>
                   @else
                   <li>
                    <a href="{{ route('patient.index') }}" class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('patients.*') ? 'border-b-2 border-blue-500' : '' }}">
                        المرضى
                    </a>
               </li>
                    @endif
                    
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
                         <a href="{{ route(name: 'waitingList.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('waitingList') ? 'border-b-2 border-blue-500' : '' }}">لائحة الانتظار</a>
                </li>
                <li>
                    <a href="{{ route(name: 'lazer.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('lazer') ? 'border-b-2 border-blue-500' : '' }}">الليزر </a>
                  </li> 
         
             

                  <li>
                    <a href="{{ route(name: 'storage.index')}}"class="text-gray-700 hover:text-gray-900 {{ request()->routeIs('store') ? 'border-b-2 border-blue-500' : '' }}">المستودع </a>
                  </li>  
                  @if (Auth::user()->hasRole('admin')) 
                  <li>
                  
                      <div class="dashboard">
                          <a href="{{ route('admin.')}}">لوحة التحكم</a>
                      </div>
                      
                  </li>
                  <div class="noti">
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                                <div class="notification-button">
                        <a href="{{ route('notifications.index') }}" class="btn btn-notification">
                            <i class="fas fa-bell"></i> <!-- Font Awesome bell icon -->
                        </a>
                        <span class="notification-count" style="display: none;"></span> <!-- Initially hidden -->
                    </div>
                 </div>

                  @endif 
                  
                
                  
                <li class="loglog">
                  
                <div class="dropdown">  
                    <a class="dropbtn" onclick="toggleDropdown()">
                
                    </a>  
                    <div class="inside">
                    <img src="{{asset ('images/login.png')}}" alt="log-con" class="log-con mr-2">
                    <div>{{ Auth::user()->name }}</div>
                    </div> 
                    <div class="dropdown-content" id="dropdownContent">  
                        <a href="{{ route('profile.edit') }}">الحساب الشخصي</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" style="color:red; cursor:pointer;" >
                                {{ __('تسجيل الخروج') }}
                            </a>
                        </form>
                        
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
       width: 50px;
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
        background-color: #68f6de65; 
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

  .noti {
    display: flex;
    width: 55px;
    height: auto;
    justify-content: center;
    z-index: 10;
}

.notification-button {
    width: 50px;
    height: 50px;
    background-color: #f1f1f1;
    border-radius: 10px;
    color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative; /* Make this relative for absolute positioning of the count */
}

.btn-notification {
    font-size: 25px;
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333; /* Change color as needed */
    transition: transform 0.3s ease; /* Add transition for smooth rotation */
}

.btn-notification:hover {
    transform: rotate(15deg); /* Rotate the icon on hover */
}

.notification-count {
    background-color: red; /* Change color as needed */
    color: white;
    border-radius: 50%;
    padding: 0 5px;
    position: absolute; /* Change to absolute positioning */
    top: 0; /* Align to the top */
    right: -10px; /* Adjust position to be half inside and half outside */
    font-size: 15px; /* Adjust size */
    transform: translateY(-25%); /* Center vertically */
    display: inline-block; /* Ensure it behaves like a block */
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Check local storage for the last known notification count
        const lastKnownCount = localStorage.getItem('notificationCount');
        if (lastKnownCount) {
            $('.notification-count').text(lastKnownCount).show(); // Show last known count
        }

        // Fetch the current notification count from the server
        $.get('/notifications/count', function(data) {
        
            if (data.count > 0) {
                $('.notification-count').text(data.count).show(); // Update the count and show it
                localStorage.setItem('notificationCount', data.count); // Store the count in local storage
            } else {
                $('.notification-count').hide(); // Hide if there are no notifications
                localStorage.removeItem('notificationCount'); // Clear local storage if no notifications
            }
        }).fail(function() {
            console.error("Error fetching notification count");
        });
    });
</script>
</body>