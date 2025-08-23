<?php

namespace App\Actions\Admin\Employee;

use App\Http\Requests\EmployeeRequest;
use App\Repository\EmployeeRepository;

class EmployeeCreateAction
{
    public function __construct(protected EmployeeRepository $employeeRepository) {}

    public function __invoke(EmployeeRequest $request)
    {
        return $this->employeeRepository->addEmployee($request->validated());
    }
}
