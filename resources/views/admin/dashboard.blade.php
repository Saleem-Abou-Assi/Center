<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Dashboard</title>
    @include('layouts.navigation')
</head>

<body>
    <br>

    <div class="boton">
        <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left"
                style="font-size:25px"></span></button>
    </div>
    <div class="r-all">
        <!-- Add Ray Counts Button -->
       

        <!-- User Management Section -->
        <div class="con">
            <button class="add-btn" id="rayCountsBtn">Ray Counts</button>
            <h2>إدارة لمستخدمين</h2>
            <h3>عدد المسجلين</h3>
            <div class="count">
                <p><strong>{{ $userCount }}</strong></p>
            </div>
            <br>
            <div>
                <a href="{{ route('admin.users.index') }}" class="add-btn">Go</a>
            </div>
            <form action="{{ route('admin.lazerPrice.store') }}" method="POST">
                @csrf
                <br>
                <div class="form-group">
                    <label for="ax_price">AX</label>
                    <input type="number" required id="ax_price" name="ax_price" class="price"
                        placeholder="سعر شعاع الليزر">

                    <label for="ay_price">AY</label>
                    <input type="number" required id="ay_price" name="ay_price" class="price"
                        placeholder="سعر شعاع الليزر">

                    <label for="again_price">Again</label>
                    <input type="number" required id="again_price" name="again_price" class="price"
                        placeholder="سعر شعاع الليزر">

                </div>
                <button type="submit" class="add-btn">أدخل</button>


            </form>
        </div>

        <!-- Rays Statistics Section -->
        <div id="rayCountsModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 style="text-align: center;">تسجيل عدد الأشعة اليومي</h2>
                <div class="con1">

                    <!-- Start Counts Section -->
                    <div class="ray-counts-section">
                        <h3 class="section-title">عدد الأشعة في بداية اليوم</h3>
                        <form action="{{ route('admin.ray-counts.store-start') }}" method="POST">
                            @csrf
                            <div class="ray-counts-container">
                                <div class="device-section">
                                    <h3>AX</h3>
                                    <div class="count-inputs">
                                        <div class="input-group">
                                            <input type="number" id="ax_start_count" name="ax_start_count"
                                                value="{{ $todayCounts->ax_start_count ?? '' }}" required min="0"
                                                placeholder="أدخل عدد الأشعة">
                                        </div>
                                    </div>
                                </div>

                                <div class="device-section">
                                    <h3>AY</h3>
                                    <div class="count-inputs">
                                        <div class="input-group">
                                            <input type="number" id="ay_start_count" name="ay_start_count"
                                                value="{{ $todayCounts->ay_start_count ?? '' }}" required min="0"
                                                placeholder="أدخل عدد الأشعة">
                                        </div>
                                    </div>
                                </div>

                                <div class="device-section">
                                    <h3>Again</h3>
                                    <div class="count-inputs">
                                        <div class="input-group">
                                            <input type="number" id="again_start_count" name="again_start_count"
                                                value="{{ $todayCounts->again_start_count ?? '' }}" required min="0"
                                                placeholder="أدخل عدد الأشعة">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="add-btn start-btn">حفظ عدد الأشعة في بداية اليوم</button>
                        </form>
                    </div>

                    <!-- End Counts Section -->
                    <div class="ray-counts-section">
                        <h3 class="section-title">عدد الأشعة في نهاية اليوم</h3>
                        <form action="{{ route('admin.ray-counts.store-end') }}" method="POST">
                            @csrf
                            <div class="ray-counts-container">
                                <div class="device-section">
                                    <h3>AX</h3>
                                    <div class="count-inputs">
                                        <div class="input-group">
                                            <input type="number" id="ax_end_count" name="ax_end_count"
                                                value="{{ $todayCounts->ax_end_count ?? '' }}" required min="0"
                                                placeholder="أدخل عدد الأشعة">
                                        </div>
                                    </div>
                                </div>

                                <div class="device-section">
                                    <h3>AY</h3>
                                    <div class="count-inputs">
                                        <div class="input-group">
                                            <input type="number" id="ay_end_count" name="ay_end_count"
                                                value="{{ $todayCounts->ay_end_count ?? '' }}" required min="0"
                                                placeholder="أدخل عدد الأشعة">
                                        </div>
                                    </div>
                                </div>

                                <div class="device-section">
                                    <h3>Again</h3>
                                    <div class="count-inputs">
                                        <div class="input-group">
                                            <input type="number" id="again_end_count" name="again_end_count"
                                                value="{{ $todayCounts->again_end_count ?? '' }}" required min="0"
                                                placeholder="أدخل عدد الأشعة">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea id="notes" name="notes" rows="3"
                                    placeholder="أدخل أي ملاحظات هنا">{{ $todayCounts->notes ?? '' }}</textarea>
                            </div>

                            <button type="submit" class="add-btn end-btn">حفظ عدد الأشعة في نهاية اليوم</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reports Section -->
        <div class="report" >


            <!-- Daily Operations Report -->
            <div class="report-section">
                <h3>تقرير العمليات اليومية</h3>
                <form action="{{ route('admin.reports.daily') }}" method="POST">
                    @csrf
                    <div class="export-options">
                        <button type="submit" name="export_type" value="pdf" class="add-btn">PDF تصدير</button>

                    </div>
                </form>
            </div>

            <div class="report-section">
                <h3>تقرير مخصص</h3>

                <form action="{{ route('admin.reports.custom') }}" method="POST" id="customReportForm">
                    @csrf
                    <div class="form-group">
                        <div class="select-box-1">
                            <select name="report_type" id="report_type" required>
                                <option value="">اختر نوع التقرير</option>
                                <option value="patientDept">المعاينات</option>
                                <option value="lazer">الليزر</option>
                                <option value="skin">البشرة</option>

                            </select>
                        </div>
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

                    </div>
                </form>
            </div>
            <div class="report-section">
                <h3>تقرير طبيب محدد</h3>
                <form action="{{ route('admin.reports.doctor') }}" method="POST" id="doctorReportForm">
                    @csrf
                    <div class="form-group">
                        <div class="select-box-1">
                            <label for="doctor_id">اختر الطبيب</label>
                            <select name="doctor_id" id="doctor_id" required>
                                <option value="">اختر طبيباً</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                    </div>
                </form>
            </div>
        </div>



    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/report-generator.js') }}"></script>


    <script>
        // Get the modal
        const modal = document.getElementById("rayCountsModal");
        const btn = document.getElementById("rayCountsBtn");
        const span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>