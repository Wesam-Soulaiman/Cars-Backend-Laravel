<?php

namespace App\Actions\Admin\Employee;

use App\Http\Requests\SearchEmployeeRequest;
use App\Repository\EmployeeRepository;

class EmployeeIndexAction
{
    public function __construct(protected EmployeeRepository $employeeRepository) {}

    public function __invoke(SearchEmployeeRequest $request)
    {
        return $this->employeeRepository->indexEmployee($request->toFilter());
    }
}
