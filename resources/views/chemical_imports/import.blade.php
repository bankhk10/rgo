<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นำเข้าข้อมูลวัตถุอันตราย</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>นำเข้าข้อมูลวัตถุอันตรายจาก Excel</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('import_errors'))
            <div class="alert alert-danger">
                <h5>ข้อผิดพลาดในการนำเข้า:</h5>
                <ul>
                    @foreach (session('import_errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chemical_imports.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">เลือกไฟล์ Excel (.xlsx, .xls)</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-primary">อัปโหลดและนำเข้า</button>
        </form>

        <hr>
        {{-- <h4>รูปแบบไฟล์ Excel ที่ถูกต้อง:</h4>
        <p>
            ไฟล์ Excel ของคุณควรมีแถวแรกเป็นหัวข้อ (header) และชื่อคอลัมน์ต้องตรงกับชื่อคอลัมน์ในฐานข้อมูล (เป็น snake_case ตัวพิมพ์เล็ก) เพื่อให้การแมปข้อมูลเป็นไปอย่างราบรื่น<br>
            ตัวอย่างชื่อคอลัมน์:
            <br>
            <code>company_id</code>,
            <code>registration_no</code>,
            <code>expiry_date</code>,
            <code>chemical_name_th</code>,
            <code>chemical_name_en</code>,
            <code>formula</code>,
            <code>trade_name</code>,
            <code>manufacturer</code>,
            <code>supplier</code>,
            <code>license_no</code>,
            <code>import_quantity</code>,
            <code>remaining_quantity</code>,
            <code>second_expiry_date</code>,
            <code>packaging</code>,
            <code>note</code>
        </p>
        <p>สำหรับคอลัมน์ <code>expiry_date</code> และ <code>second_expiry_date</code> สามารถระบุเป็นรูปแบบวันที่ที่ถูกต้อง (เช่น YYYY-MM-DD) หรือเป็นรูปแบบตัวเลขวันที่ของ Excel ก็ได้</p> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
