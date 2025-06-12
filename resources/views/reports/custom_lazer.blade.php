    <div class="section">
        <div class="section-title">إحصائيات الأشعة</div>
        <table>
            <thead>
                <tr>
                    <th>النوع</th>
                    <th>عدد الأشعة في بداية اليوم</th>
                    <th>عدد الأشعة في نهاية اليوم</th>
                    <th>الفرق</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rayCounts = \App\Models\DailyRayCount::where('date', today())->first();
                @endphp
                <tr>
                    <td>AX</td>
                    <td>{{ $rayCounts->ax_start_count ?? 0 }}</td>
                    <td>{{ $rayCounts->ax_end_count ?? 0 }}</td>
                    <td>{{ ($rayCounts->ax_end_count ?? 0) - ($rayCounts->ax_start_count ?? 0) }}</td>
                </tr>
                <tr>
                    <td>AY</td>
                    <td>{{ $rayCounts->ay_start_count ?? 0 }}</td>
                    <td>{{ $rayCounts->ay_end_count ?? 0 }}</td>
                    <td>{{ ($rayCounts->ay_end_count ?? 0) - ($rayCounts->ay_start_count ?? 0) }}</td>
                </tr>
                <tr>
                    <td>Again</td>
                    <td>{{ $rayCounts->again_start_count ?? 0 }}</td>
                    <td>{{ $rayCounts->again_end_count ?? 0 }}</td>
                    <td>{{ ($rayCounts->again_end_count ?? 0) - ($rayCounts->again_start_count ?? 0) }}</td>
                </tr>
            </tbody>
        </table>
        @if($rayCounts && $rayCounts->notes)
            <div class="notes-section">
                <h4>ملاحظات:</h4>
                <p>{{ $rayCounts->notes }}</p>
            </div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">جلسات الليزر</div>
    </div> 