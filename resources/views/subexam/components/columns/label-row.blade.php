<tr>
    <th scope="col" class="col-checkbox cell-fixed" style="left: -1px; width: 49px;">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input check-all" id="table-check-all">
            <label class="custom-control-label" for="table-check-all"></label>
        </div>
    </th>

    @foreach ($table->columns() as $column)
        @if ($column['is_visible'])
            <th scope="col" 
                class="text-center 
                    {{ $column['primary'] ? 'cell-fixed primary-cell' : 'd-none d-md-table-cell' }}
                " 
                style="
                    @isset($column['width'])
                        max-width: {{ $column['width'] }}px; width: {{ $column['width'] }}px;
                    @endisset 
                    @if ($column['primary'])
                        left: 48px;
                    @endif
                ">
                {{ ucfirst($column['label']) }}
            </th>
        @endif
    @endforeach
    {{-- <th scope="col" class="cell-fixed primary-cell" style="left: 48px; width: 300px;">Học phần</th>
    <th scope="col" rowspan="2" class="text-center d-none d-md-table-cell">Trạng thái</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Năm học</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Nhóm LHP</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Học kỳ</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Kỳ thi</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Thời lượng</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Hình thức thi</th>   
    <th scope="col" class="text-center d-none d-md-table-cell">Số đề đợt 1</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Số đề đợt 2</th>   
    <th scope="col" class="text-center d-none d-md-table-cell">Được dùng tài liệu</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Kèm đáp án</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Loại đề thi</th>
    <th scope="col" class="text-center d-none d-md-table-cell">Ghi chú</th>    
    
    @auth('admin')
        <th scope="col" class="text-center d-none d-md-table-cell">Giảng viên</th>
    @endauth
    <th scope="col" class="text-center d-none d-md-table-cell">Ngày tạo</th>     --}}
</tr>