<?php

namespace App\Actions\Admin\Employee;

use App\Models\Employee;
use App\Repository\EmployeeRepository;

class EmployeeDeleteAction
{
    public function __construct(protected EmployeeRepository $employeeRepository) {}

    public function __invoke(Employee $employee)
    {
        return $this->employeeRepository->deleteEmployee($employee);
    }
}
