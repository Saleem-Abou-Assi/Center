<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>Dashboard</title>
    @include('layouts.navigation')
</head>
<body>
    <div class="all">
        <div class="C-container">
            <!-- User Management Section -->
            <div class="con">
                <h2>إدارة المستخدمين</h2>
                <h3>عدد المسجلين</h3>
                <div class="count">
                    <p><strong>{{ $userCount }}</strong></p>
                </div>
                <div>
                    <a href="{{ route('admin.users.index') }}" class="add-btn">Go</a>
                </div>
            </div>

            <!-- Reports Section -->
            <div class="con">
                <h2>التقارير</h2>
                
                <!-- Daily Operations Report -->
                <div class="report-section">
                    <h3>تقرير العمليات اليومية</h3>
                    <form action="{{ route('admin.reports.daily') }}" method="POST">
                        @csrf
                        <div class="export-options">
                            <button type="submit" name="export_type" value="pdf" class="add-btn">PDF تصدير</button>
                            <button type="submit" name="export_type" value="excel" class="add-btn">Excel تصدير</button>
                        </div>
                    </form>
                </div>

                <!-- Custom Department Report -->
                <div class="report-section">
                    <h3>تقرير مخصص</h3>
                    <form action="{{ route('admin.reports.custom') }}" method="POST" id="customReportForm">
                        @csrf
                        <div class="form-group">
                            <select name="report_type" id="report_type" class="form-control" required>
                                <option value="">اختر نوع التقرير</option>
                                <option value="patientDept">المعاينات</option>
                                <option value="lazer">الليزر</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="start_date">من تاريخ:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">إلى تاريخ:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>

                        <div class="export-options">
                            <button type="submit" name="export_type" value="pdf" class="add-btn">PDF تصدير</button>
                            <button type="submit" name="export_type" value="excel" class="add-btn">Excel تصدير</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/report-generator.js') }}"></script>
</body>
</html>