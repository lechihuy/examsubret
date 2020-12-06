<tr>
    <th scope="col" class="col-checkbox cell-fixed" style="left: -1px;" rowspan="2">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input check-all" id="table-check-all">
            <label class="custom-control-label" for="table-check-all"></label>
        </div>
    </th>
    <th scope="col" class="cell-fixed primary-cell" style="left: 48px;" rowspan="2">Môn</th>
    <th scope="col" rowspan="2" class="text-center d-none d-md-table-cell">Trạng thái</th>
    <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Năm học</th>
    <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Học kỳ</th>
    <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Kỳ thi</th>
    <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Thời lượng</th>
    
    @if ($position == 'header')
        <th scope="col" colspan="2" class="text-center d-none d-md-table-cell">Lần 1</th>
        <th scope="col" colspan="2" class="text-center d-none d-md-table-cell">Lần 2</th>
    @else
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
    @endif

    <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Hình thức thi</th>    
    <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Ghi chú</th>    
    
    @auth('admin')
        <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Người đăng</th>
    @endauth
    <th scope="col" class="text-center d-none d-md-table-cell" rowspan="2">Ngày tạo</th>    
</tr>
<tr>
    @if ($position == 'footer')
        <th  colspan="2" class="text-center d-none d-md-table-cell" >Lần 1</th>
        <th  colspan="2" class="text-center d-none d-md-table-cell" >Lần 2</th>
    @else
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
    @endif
</tr>