<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Models\SubmitExamRequest;

class SubmitExamRequestsExport implements FromView, ShouldAutoSize
{
    protected $filter;

    public function __construct(array $filter)
    {
        $this->filter = $filter;
    }   

    public function view(): View
    {
        return view('subexam.exports.excel', [
            'subexams' => SubmitExamRequest::list($this->filter)
        ]);
    }
}
