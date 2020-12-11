<table>
    <thead>
        <tr>
            <th scope="col">Môn</th>
            <th scope="col">Khoa</th>
            <th scope="col">Ngành</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Nhóm LHP</th> 
            <th scope="col">Năm học</th>
            <th scope="col">Học kỳ</th>
            <th scope="col">Kỳ thi</th>
            <th scope="col">Thời lượng</th>
            <th scope="col">Hình thức thi</th>   
            <th scope="col">Số đề lần 1</th>    
            <th scope="col">Số đề lần 2</th>
            <th scope="col">Được dùng tài liệu</th>    
            <th scope="col">Kèm đáp án</th>
            <th scope="col">Kèm thang điểm</th>    
            <th scope="col">Loại đề thi</th>    
            <th scope="col">Ghi chú</th>   
            <th scope="col">Giảng viên</th>
            <th scope="col">Ngày tạo</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($subexams as $subexam)
            <tr>
                <td>{{ $subexam->subject->name }}</td>
                <td>{{ $subexam->department->name }}</td>
                <td>{{ $subexam->major->name }}</td>
                <td>{{ $subexam->status() }}</td>
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
                <td>{{ $subexam->notes }}</td>
                <td>{{ $subexam->teacher->identification() }}</td>
                <td>@include('subexam.components.columns.created-at')</td>
            </tr>
        @endforeach
    </tbody>
</table>