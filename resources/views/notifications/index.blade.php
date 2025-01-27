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
                            <td>{{ $notification->type === 'patient_dept' ? 'معاينة' : 'ليزر' }}</td>
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
                                <a href="{{ route('patient.show', ['patient_id' => $notification->patient->id, 'highlight_operation' => $notification->operation_id, 'operation_type' => $notification->type]) }}" class="action-btn">تفاصيل</a>
                              </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $notifications->links() }}
    </div>
</body>
</html>