<style>
    * {
        font-family: "Times New Roman", Times, serif;
        padding: 0;
        margin: 0;
    }

    body {
        font-size: 13px;
    }

    header {
        margin-bottom: 20px;
    }

    header h1 {
        font-size: 20px;
    }

    table {
        width: 100%;
    }

    table, th, td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    th, td {
        padding: 2px 3px;
        text-align: center;
    }

    .clearfix {
        clear: both;
    }

    .col {
        float: left;
    }

    .col-3 {
        width: calc(100% / 3);
    }

    .col-2 {
        width: calc(100% / 2);
    }

    .text-center {
        text-align: center;
    }

    footer {
        margin-top: 20px;
    }
</style>
<header>
    <div class="col col-2">
        <h3>TRƯỜNG ĐẠI HỌC VĂN LANG</h3>
        <h1>PHÒNG KHẢO THÍ & ĐBCLĐT</h1>
        <p>69/68 Đăng Thùy Trâm, P.13, Q. Gò Vấp, TP.HCM</p>
        <p>ĐT: (028) 71099231 - Fax: (028) 38369716</p>
        <p>E-mail: p.ktdb@vanlanguni.edu.vn</p>
    </div>
    <div class="col col-2 text-center">
        <h3 style="margin-top: 20px;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h3>
        <p>Độc lập - Tự do - Hạnh phúc</p>
    </div>
    <div class="clearfix"></div>
</header>
<table>
    <thead>
        <tr>
            <th scope="col">Tên học phần</th>
            <th scope="col">Khoa</th>
            <th scope="col">Nhóm LHP</th> 
            <th scope="col">Năm học</th>
            <th scope="col">Học kỳ</th>
            <th scope="col">Kỳ thi</th>
            <th scope="col">Thời lượng</th>
            <th scope="col">Hình thức thi</th>   
            <th scope="col">Số đề đợt 1</th>    
            <th scope="col">Số đề đợt 2</th>
            <th scope="col">Được dùng tài liệu</th>    
            <th scope="col">Kèm đáp án</th>
            <th scope="col">Kèm thang điểm</th>    
            <th scope="col">Loại đề thi</th>    
            <th scope="col">Giảng viên</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subexams as $subexam)
            <tr>
                <td>{{ $subexam->subject->name }}</td>
                <td>{{ $subexam->department->name }}</td>
                <td>{{ $subexam->class }}</td>
                <td>{{ $subexam->schoolYear() }}</td>
                <td>{{ $subexam->semester }}</td>
                <td>{{ $subexam->examText() }}</td>
                <td>{{ $subexam->timeText() }}</td>
                <td>@include('subexam.components.columns.exam-forms')</td>
                <td>{{ $subexam->times_1_exam_qty }}</td>
                <td>{{ $subexam->times_2_exam_qty }}</td>
                <td>@include('subexam.components.columns.used-material')</td>
                <td>{{ $subexam->hasAnswerText() }}</td>
                <td>{{ $subexam->hasPointLadderText() }}</td>
                <td>{{ $subexam->examTypeText() }}</td>
                <td>{{ $subexam->teacher->identification() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<footer>
    <div class="col col-3">
        <p style="opacity: 0;">p</p>
    </div>
    <div class="col col-3">
        <p style="opacity: 0;">p</p>
    </div>
    <div class="col col-3 text-center">
        <p><strong>Tp. HCM, ngày {{ now()->format('d') }} tháng {{ now()->format('m') }} năm {{ now()->format('Y') }}</strong></p>
        <p>Người nhận bàn giao đề thi</p>
        <p>(Ký, ghi rõ họ tên)</p>
    </div>
    <div class="clearfix"></div>
</footer>