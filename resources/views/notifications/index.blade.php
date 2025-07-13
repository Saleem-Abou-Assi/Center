<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>الإشعارات</title>
    @include('layouts.navigation')
</head>

<body>
    <div class="page-title">
        <h1>الإشعارات</h1>
    </div>
    <div class="container">
        <div class="boton">
            <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left"
                    style="font-size:25px"></span></a>
        </div>

        <!-- Bulk Delete Form -->
        <div class="bulk-delete-section"
            style="margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;">
            <h3 style="margin-bottom: 15px; color: #000; text-align:center;">حذف الإشعارات حسب النطاق الزمني</h3>
            <form action="{{ route('notifications.bulkDelete') }}" method="POST"
                style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap; justify-content:center;">
                @csrf
                <div style="display: flex; align-items: center; gap: 8px;">
                    <label for="start_date" style="font-weight: bold; color: #495057;">من تاريخ:</label>
                    <input type="date" id="start_date" name="start_date" required
                        style="padding: 8px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <label for="end_date" style="font-weight: bold; color: #495057;">إلى تاريخ:</label>
                    <input type="date" id="end_date" name="end_date" required
                        style="padding: 8px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                </div>
                <button type="submit" class="action-btn"
                    style="background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 14px;"
                    onclick="return confirm('هل أنت متأكد من حذف جميع الإشعارات في هذا النطاق الزمني؟')">
                    حذف الإشعارات المحددة
                </button>
            </form>
            @if ($errors->any())
                <div style="margin-top: 10px; color: #dc3545; font-size: 14px;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>النوع</th>
                        <th>الطبيب</th>
                        <th>المريض</th>
                        <th>الرسالة</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                        <th>تفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr @if(!$notification->is_read) style="background-color: #f0f8ff;" @endif>
                            <td>
                                @if($notification->type === 'patient_dept')
                                    معاينة
                                @elseif($notification->type === 'lazer')
                                    ليزر
                                @elseif($notification->type === 'skin')
                                    بشرة
                                @else
                                    {{ $notification->type }}
                                @endif
                            </td>
                            <td>{{ $notification->doctor }}</td>
                            <td>{{ $notification->patient->name }}</td>
                            <td>{{ $notification->message }}</td>
                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                            <td>{{ $notification->is_read ? 'مقروء' : 'جديد' }}</td>
                            <td class="action-td">


                                @if(!$notification->is_read)
                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="action-btn">تحديد كمقروء</button>
                                    </form>
                                @endif
                                @if($notification->type === 'patient_dept')
                                    <a href="{{ route('accounter.index', $notification->operation_id) }}"
                                        class="action-btn">تفاصيل</a>
                                    <a href="{{ route('patientDept.edit', $notification->operation_id) }}"
                                        class="action-btn">تعديل المعاينة</a>

                                @elseif($notification->type === 'lazer')
                                    <a href="{{ route('lazer.show', $notification->operation_id) }}"
                                        class="action-btn">تفاصيل</a>
                                    <a href="{{ route('lazer.edit', $notification->operation_id) }}" class="action-btn"> تعديل
                                        المعاينة</a>
                                @elseif($notification->type === 'skin')
                                    <a href="{{ route('skin.show', $notification->operation_id) }}"
                                        class="action-btn">تفاصيل</a>
                                    <a href="{{ route('skin.edit', $notification->operation_id) }}" class="action-btn">تعديل
                                        المعاينة</a>
                                @endif
                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn"
                                        onclick="return confirm('هل أنت متأكد من حذف هذا الإشعار؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Custom Pagination Controls -->
        @if ($notifications->hasPages())
            <div class="custom-pagination">
                {{-- Previous Page Link --}}
                @if ($notifications->onFirstPage())
                    <button class="page-btn" disabled>
                << @else <a href="{{ $notifications->previousPageUrl() }}" class="page-btn">
                    << @endif {{-- Pagination Elements --}} @foreach (range(1, $notifications->lastPage()) as $page)
                            @if ($page == 1 || $page == $notifications->lastPage() || ($page >= $notifications->currentPage() - 1 && $page <= $notifications->currentPage() + 1))
                                @if ($page == $notifications->currentPage())
                                    <button class="page-btn active">{{ $page }}</button>
                                @else
                                    <a href="{{ $notifications->url($page) }}" class="page-btn">{{ $page }}</a>
                                @endif
                            @elseif ($page == 2 || $page == $notifications->lastPage() - 1)
                                <span class="page-btn">...</span>
                            @endif
                        @endforeach

                            {{-- Next Page Link --}}
                            @if ($notifications->hasMorePages())
                                <a href="{{ $notifications->nextPageUrl() }}" class="page-btn">>></a>
                            @else
                                <button class="page-btn" disabled>>></button>
                            @endif
            </div>
        @endif
    </div>

    <script>
        // Set default date values (last 30 days)
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date();
            const thirtyDaysAgo = new Date();
            thirtyDaysAgo.setDate(today.getDate() - 30);

            // Format dates for input fields (YYYY-MM-DD)
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            document.getElementById('start_date').value = formatDate(thirtyDaysAgo);
            document.getElementById('end_date').value = formatDate(today);

            // Add validation to ensure end_date is not before start_date
            document.getElementById('end_date').addEventListener('change', function () {
                const startDate = document.getElementById('start_date').value;
                const endDate = this.value;

                if (startDate && endDate && endDate < startDate) {
                    alert('تاريخ النهاية يجب أن يكون بعد تاريخ البداية');
                    this.value = startDate;
                }
            });

            document.getElementById('start_date').addEventListener('change', function () {
                const startDate = this.value;
                const endDate = document.getElementById('end_date').value;

                if (startDate && endDate && endDate < startDate) {
                    document.getElementById('end_date').value = startDate;
                }
            });
        });
    </script>
</body>

</html>