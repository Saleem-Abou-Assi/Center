<!DOCTYPE html>
<html>

<head>
    @include('layouts.navigation')
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>إدارة الحجوزات</title>
    <style>
        .print-controls {
            margin: 20px 0;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;

        }

        .date-range {
            display: flex;
            gap: 15px;
            justify-content: center;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .date-range input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .print-btn {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .print-btn:hover {
            background: #45a049;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 20px;
                visibility: hidden;
            }

            .print {
                visibility: visible;
                top: 0;
                position: absolute;
                margin-top: 5mm;
            }

            .action-td {
                visibility: hidden;
            }
        }
    </style>
</head>

<body>
    <div class="page-title">
        <h1>الحجوزات</h1>
    </div>
    <div class="all">
        <div class="container">
            <div class="but">
                <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left"
                        style="font-size:23px"></span></button>
            </div>
            <a href="{{ route('book.create') }}" class="cta"><span>إضافة حجز</span>
                <svg width="15px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </a>
            <br>
            <br>

            <div class="print-controls no-print">
                <div class="date-range">
                    <div>
                        <label for="from-date">من تاريخ:</label>
                        <input type="date" id="from-date" name="from-date">
                    </div>
                    <div>
                        <label for="to-date">إلى تاريخ:</label>
                        <input type="date" id="to-date" name="to-date">
                    </div>
                    <button onclick="printAppointments()" class="print-btn">طباعة الحجوزات</button>
                </div>
            </div>

            <table id="appointments-table" class="print">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>اسم المريض</th>
                        <th>رقم المريض</th>
                        <th>الطبيب المعالج</th>
                        <th>الموعد</th>
                        <th>تاريخ اختيار الموعد</th>
                        <th class="no-print">الملاحظات</th>
                        <!-- <th>Updated At</th> -->
                        <th>تفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add your patient data rows here -->
                    @foreach ($books as $book)

                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->patient_name }}</td>
                            <td>{{ $book->phone }}</td>
                            <td>

                                {{ $book->doctor->user->name }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($book->bookDate)->format('Y-m-d H:i') }}</td>
                            <td>{{ $book->created_at }}</td>
                            <td>{{ $book->notes }}</td>
                            <td class="action-td">
                                <a href="{{ route('book.edit', $book->id) }}" class="action-btn">عدّل</a>

                                <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn">حذف</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>

    <script>
        function printAppointments() {
            const fromDate = new Date(document.getElementById('from-date').value);
            const toDate = new Date(document.getElementById('to-date').value);

            if (!fromDate || !toDate) {
                alert('الرجاء اختيار نطاق التاريخ');
                return;
            }

            const rows = document.querySelectorAll('#appointments-table tbody tr');
            rows.forEach(row => {
                const dateCell = row.querySelector('td:nth-child(5)');
                const appointmentDate = new Date(dateCell.textContent);

                if (appointmentDate >= fromDate && appointmentDate <= toDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            window.print();

            // Reset display after printing
            rows.forEach(row => {
                row.style.display = '';
            });
        }
    </script>
</body>

</html>