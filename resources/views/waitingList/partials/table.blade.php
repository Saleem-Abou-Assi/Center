<tr>
    <th>اسم المريض</th>
    <th>اسم الطبيب</th>
    <th>الخدمة

    </th>
    <th>ازالة</th>
</tr>
@foreach ($waitingList as $patient)

    <tr>
        <td>{{ $patient->patient->name }}</td>
        <td>{{ $patient->doctor->user->name }}</td>
        <td>{{ $patient->device }}</td>
        <td>
            <form action="{{ route('waitingList.destroy', $patient->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn">إزالة</button>
            </form>
        </td>
    </tr>
@endforeach