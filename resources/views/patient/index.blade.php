<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
  
       
    @include('layouts.navigation')

    <title>ادارة المرضى</title>
    
</head> 
<body>
    <div class="page-title"> <h1>المرضى</h1></div>
    <div class="all">
    <div class="container">
    <a href="{{ route('patient.create') }}" class="cta"><span>أضف مريضاّ</span>
    <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg>
    </a>
    <br>
    <br>
        <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th onclick="sortTable('id')">ID <span id="arrow-id" class="circle inactive"></span></th>
                    <th onclick="sortTable('name')">الاسم <span id="arrow-name" class="circle inactive"></span></th>
                    <th>الرقم</th>
                    <th>العنوان</th>
                    
                    <th>الجنس</th>
                    <th>العمر</th>
                    <th>الوظيفة</th>
                    <th onclick="sortTable('createdAt')">تاريخ الإضافة <span id="arrow-created-at" class="circle inactive"></span></th>
                    <th> آخر تعديل</th>
                    
                    <th>تفاصيل</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add your patient data rows here -->
                @foreach ($patients as $patient)
                @php
                   
                @endphp
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->Gender }}</td>
                        <td>{{ $patient->age }}</td>
                        <td>{{ $patient->job }}</td>
                     
                        <td>{{ $patient->created_at }}</td>
                        <td>{{ $patient->updated_at }}</td>
                      
                        <td class="action-td">
                            <a href="{{ route('patient.edit', $patient->id) }}" class="action-btn">تعديل</a>
                        
                                <form id="deleteForm" action="{{ route('patient.destroy', $patient->id) }}" method="POST" onsubmit="return confirmCustom()">
                                    @csrf

                                    @method('DELETE')
                                    <button type="submit" class="action-btn">إزالة</button>
                                </form>

                                <div id="confirm-modal" class="modal" style="display: none;">
                                    <div class="modal-content" style="background-color: #4e9dec; color: white; padding: 15px; border-radius: 5px; position: fixed; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 300px; text-align: center;">
                                        <p>Are you sure you want to delete this patient?</p>
                                        <p style="font-weight: bold; color: rgb(0, 0, 0);">Warning: all the patient data will be deleted</p>
                                        <div style="display: flex; justify-content: center;">
                                            <button onclick="closeModal()" style="background-color: transparent; border:black; color: white; margin-right: 10px;">Cancel</button>
                                            <button onclick="deletePatient()" style="background-color: transparent; border:black ; color: white; font-weight: bold;">Delete</button>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('patient.show', $patient->id) }}" class="action-btn">التفاصيل</a>                        

                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
        
        </div>
        
        <!-- Custom Pagination Controls -->
        @if ($patients->hasPages())
            <div class="custom-pagination">
                {{-- Previous Page Link --}}
                @if ($patients->onFirstPage())
                    <button class="page-btn" disabled><<</button>
                @else
                    <a href="{{ $patients->previousPageUrl() }}" class="page-btn"><<</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach (range(1, $patients->lastPage()) as $page)
                    @if ($page == 1 || $page == $patients->lastPage() || ($page >= $patients->currentPage() - 1 && $page <= $patients->currentPage() + 1))
                        @if ($page == $patients->currentPage())
                            <button class="page-btn active">{{ $page }}</button>
                        @else
                            <a href="{{ $patients->url($page) }}" class="page-btn">{{ $page }}</a>
                        @endif
                    @elseif ($page == 2 || $page == $patients->lastPage() - 1)
                        <span class="page-btn">...</span>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($patients->hasMorePages())
                    <a href="{{ $patients->nextPageUrl() }}" class="page-btn">>></a>
                @else
                    <button class="page-btn" disabled>>></button>
                @endif
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>
    </div>

   
    <script>
       function confirmCustom() {
    document.getElementById('confirm-modal').style.display = 'block';
    return false;
}

function closeModal() {
    document.getElementById('confirm-modal').style.display = 'none';
}

function deletePatient() {
    document.getElementById('confirm-modal').style.display = 'none';
    document.getElementById('deleteForm').submit();
}
//======================================
let sortOrder = {
        id: 'desc', // Default sort order for ID
        name: 'desc', // Default sort order for name
        createdAt: 'desc' // Default sort order for created at
    }; 

    let originalRows = []; // Array to store original rows

    function initializeTable() {
        const table = document.querySelector('table'); // Select the table
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr')); // Get all rows

        // Store original rows in the array
        originalRows = rows.map(row => row.cloneNode(true)); // Clone rows to keep original data
    }

    function sortTable(column) {
        const table = document.querySelector('table'); // Select the table
        const tbody = table.querySelector('tbody');

        // Clear the tbody to refresh the table
        tbody.innerHTML = '';

        // Reset the sort order for all columns to default
        sortOrder.id = 'desc'; // Reset ID sort order to descending
        sortOrder.name = 'desc'; // Reset name sort order to descending
        sortOrder.createdAt = 'desc'; // Reset created at sort order to descending

        // Set the sort order for the selected column
        sortOrder[column] = (sortOrder[column] === 'asc') ? 'desc' : 'asc';

        // Sort rows based on the selected column
        const sortedRows = originalRows.slice().sort((a, b) => {
            let aValue, bValue;

            if (column === 'id') {
                aValue = parseInt(a.children[0].textContent.trim()); // Get ID from the first column
                bValue = parseInt(b.children[0].textContent.trim()); // Get ID from the first column
            } else if (column === 'name') {
                aValue = a.children[1].textContent.trim(); // Get name from the second column
                bValue = b.children[1].textContent.trim(); // Get name from the second column
            } else if (column === 'createdAt') {
                aValue = new Date(a.children[7].textContent.trim()); // Get created at from the eighth column
                bValue = new Date(b.children[7].textContent.trim()); // Get created at from the eighth column
            }

            // Use localeCompare for string comparison or numeric comparison for IDs
            return sortOrder[column] === 'asc' 
                ? (column === 'id' ? aValue - bValue : (column === 'createdAt' ? aValue - bValue : aValue.localeCompare(bValue, undefined, { numeric: true, sensitivity: 'base' })))
                : (column === 'id' ? bValue - aValue : (column === 'createdAt' ? bValue - aValue : bValue.localeCompare(aValue, undefined, { numeric: true, sensitivity: 'base' })));
        });

        // Append sorted rows back to the tbody
        sortedRows.forEach(row => tbody.appendChild(row));

        // Update circle direction
        const arrowId = document.getElementById('arrow-id');
        const arrowName = document.getElementById('arrow-name');
        const arrowCreatedAt = document.getElementById('arrow-created-at');
        
        // Set the circle color based on the sort order
        arrowId.className = 'circle active ' + sortOrder.id;
        arrowName.className = 'circle active ' + sortOrder.name;
        arrowCreatedAt.className = 'circle active ' + sortOrder.createdAt;

        // Set inactive circles for other columns
        if (column !== 'id') arrowId.classList.add('inactive');
        if (column !== 'name') arrowName.classList.add('inactive');
        if (column !== 'createdAt') arrowCreatedAt.classList.add('inactive');
    }

    // Call initializeTable when the page loads to store the original rows
    document.addEventListener("DOMContentLoaded", initializeTable);
        </script>
</body>
</html>