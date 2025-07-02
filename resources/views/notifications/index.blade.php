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
        {{ $notifications->links() }}
    </div>
</body>

</html>