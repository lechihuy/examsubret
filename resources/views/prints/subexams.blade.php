<style>
    * {
        font-family: "Times New Roman", Times, serif;
        font-size: 13px;
    }
    table {
        width: 100%;
    }
    table, th, td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    th, td {
        padding: 3px 5px;
    }
</style>
<table>
    <thead>
        <tr>
            <th scope="col" rowspan="2">Môn</th>
            <th scope="col" rowspan="2">Khoa</th>
            <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Năm học</th>
            <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Học kỳ</th>
            <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Kỳ thi</th>
            <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Thời lượng</th>
            <th scope="col" colspan="2" class="text-center d-none d-md-table-cell">Lần 1</th>
            <th scope="col" colspan="2" class="text-center d-none d-md-table-cell">Lần 2</th>
            <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Hình thức thi</th>    
            <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Giảng viên</th>
        </tr>
        <tr>
            <th scope="col" class="text-center d-none d-md-table-cell">
                Số đề gốc
            </th>
            <th scope="col" class="text-center d-none d-md-table-cell">
                Số mã đề
            </th>
            <th scope="col" class="text-center d-none d-md-table-cell">
                Số đề gốc
            </th>
            <th scope="col" class="text-center d-none d-md-table-cell">
                Số mã đề
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($subexams as $subexam)
            <tr>
                <td>{{ $subexam->subject->name }}</td>
                <td>{{ $subexam->department->name }}</td>
                <td>{{ $subexam->schoolYear() }}</td>
                <td>{{ $subexam->semester }}</td>
                <td>{{ $subexam->examText() }}</td>
                <td>{{ $subexam->timeText() }}</td>
                <td>{{ $subexam->times_1->origin_exam_qty }}</td>
                <td>{{ $subexam->times_1->exam_code_qty }}</td>
                <td>{{ optional($subexam->times_2)->origin_exam_qty }}</td>
                <td>{{ optional($subexam->times_2)->exam_code_qty }}</td>
                <td>{{ $subexam->formsText() }}</td>
                <td>{{ $subexam->teacher->identification() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>