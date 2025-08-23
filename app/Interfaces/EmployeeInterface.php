<?php

namespace App\Interfaces;

use App\Filter\EmployeeFilter;
use App\Models\Employee;

interface EmployeeInterface
{
    public function addEmployee($data);

    public function indexEmployee(EmployeeFilter $filters);

    public function updateEmployee(Employee $employee, $data);

    public function deleteEmployee(Employee $employee);

    public function showEmployee(Employee $employee);
}
