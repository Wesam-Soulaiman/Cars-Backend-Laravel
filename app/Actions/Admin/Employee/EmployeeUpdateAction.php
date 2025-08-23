<?php

namespace App\Actions\Admin\Employee;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Repository\EmployeeRepository;

class EmployeeUpdateAction
{
    public function __construct(protected EmployeeRepository $employeeRepository) {}

    public function __invoke(Employee $employee, EmployeeRequest $request)
    {
        return $this->employeeRepository->updateEmployee($employee, $request->validated());
    }
}
