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
                    <th onclick="sortTable(0)">ID <span id="arrow0" class="inactive"></span></th>
                    <th onclick="sortTable(1)">الاسم<span id="arrow1" class="inactive"></span></th>
                    <th onclick="sortTable(2)">الرقم<span id="arrow2" class="inactive"></span></th>
                    <th onclick="sortTable(3)">العنوان<span id="arrow3" class="inactive"></span></th>
                    
                    <th onclick="sortTable(4)">الجنس<span id="arrow4" class="inactive"></span></th>
                    <th onclick="sortTable(5)">العمر<span id="arrow5" class="inactive"></span></th>
                    <th onclick="sortTable(6)">الوظيفة <span id="arrow6" class="inactive"></span></th>
                    <th onclick="sortTable(7)">تاريخ الإضافة <span id="arrow7" class="inactive"></span></th>
                    <th onclick="sortTable(8)"> آخر تعديل <span id="arrow8" class="inactive"></span></th>
                    
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
        // Sort functionality
        let sortOrder = [];

        function sortTable(columnIndex) {
            const table = document.querySelector('table'); // Select the table
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr')); // Get all rows

            // Toggle sort order
            sortOrder[columnIndex] = (sortOrder[columnIndex] === 'asc') ? 'desc' : 'asc';

            // Update arrow
            for (let i = 0; i < table.rows[0].cells.length; i++) {
                const arrow = document.getElementById('arrow' + i);
                arrow.className = (i === columnIndex) ? sortOrder[columnIndex] : 'inactive';
            }

            // Sort rows
            rows.sort((a, b) => {
                const aValue = a.children[columnIndex].textContent.trim();
                const bValue = b.children[columnIndex].textContent.trim();

                // Debugging: Log the values being compared
                console.log(`Comparing: ${aValue} vs ${bValue}`);

                // Determine if the column is numeric or string
                if (!isNaN(aValue) && !isNaN(bValue)) {
                    // If both values are numbers, convert them to numbers for comparison
                    return sortOrder[columnIndex] === 'asc' 
                        ? Number(aValue) - Number(bValue) 
                        : Number(bValue) - Number(aValue);
                } else {
                    // If values are strings, use localeCompare
                    return sortOrder[columnIndex] === 'asc' 
                        ? aValue.localeCompare(bValue, undefined, { numeric: true, sensitivity: 'base' })
                        : bValue.localeCompare(aValue, undefined, { numeric: true, sensitivity: 'base' });
                }
            });

            // Clear the tbody and append sorted rows
            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));
        }

        // Confirmation modal functions
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
    </script>
</body>
</html>