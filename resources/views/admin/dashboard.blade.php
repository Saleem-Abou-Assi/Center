<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">   
    <title>Dashboard</title>
    @include('layouts.navigation')
</head>
<body>
    <br>
    

    <div class="r-all">
       
            <!-- User Management Section -->
            <div class="con">
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
                    <input type="number" required id="ax_price" name="ax_price" class="price" placeholder="سعر شعاع الليزر">
                   
                    <label for="ay_price">AY</label>
                    <input type="number" required id="ay_price" name="ay_price" class="price" placeholder="سعر شعاع الليزر">
                    
                    <label for="again_price">Again</label>
                    <input type="number" required id="again_price" name="again_price" class="price" placeholder="سعر شعاع الليزر">
                    
                </div>    
                <button type="submit" class="add-btn">أدخل</button>
                
               
            </form>
            </div>
            
        
            <!-- Reports Section -->
            <div class="report">
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
                <div class="line"></div>
                <!-- Custom Department Report -->
                 <h3>تقرير مخصص</h3>
                <div class="report-section">
                  
                    <form action="{{ route('admin.reports.custom') }}" method="POST" id="customReportForm">
                        @csrf
                        <div class="form-group">
                            <div class="select-box-1">
                            <select name="report_type" id="report_type"required>
                                <option value="">اختر نوع التقرير</option>
                                <option value="patientDept">المعاينات</option>
                                <option value="lazer">الليزر</option>
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
                            <button type="submit" name="export_type" value="excel" class="add-btn">Excel تصدير</button>
                        </div>
                    </form>
                </div>
            </div>
            
            </div>
            
         </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/report-generator.js') }}"></script>
</body>
</html>