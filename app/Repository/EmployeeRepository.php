<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\EmployeeFilter;
use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeRepository extends BaseRepositoryImplementation implements EmployeeInterface
{
    public function __construct(protected ProductPhotosRepository $productPhotosRepository)
    {
        parent::__construct();

    }

    public function model()
    {
        return Employee::class;
    }

    public function addEmployee($data)
    {
        $this->with = ['role'];
        $employee = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($employee), ApiResponseCodes::CREATED);
    }

    public function indexEmployee(EmployeeFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        if (! is_null($filters->getRoleId())) {
            $this->where('role_id', '%'.$filters->getRoleId().'%', 'like');
        }
        $employees = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total' => $employees->total(),
            'current_page' => $employees->currentPage(),
            'last_page' => $employees->lastPage(),
            'per_page' => $employees->perPage(),
        ];
        $employees = EmployeeResource::collection($employees->items());

        return ApiResponseHelper::sendResponseWithPagination(new Result($employees, 'get employees successfully', $pagination));
    }

    public function updateEmployee(Employee $employee, $data)
    {
        $newEmployee = $this->updateById($employee->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newEmployee));
    }

    public function deleteEmployee(Employee $employee)
    {
        $this->deleteById($employee->id);

        return ApiResponseHelper::sendMessageResponse('delete employee  successfully');
    }

    public function showEmployee(Employee $employee)
    {
        $showEmployee = $this->getById($employee->id);
        $showEmployee = EmployeeResource::make($showEmployee);

        return ApiResponseHelper::sendResponse(new Result($showEmployee));
    }

    public function CountEmployees()
    {
        return $this->count();
    }

    public function rolesCount()
    {
        return $rolesCount = DB::table('employees')->selectRaw('COUNT(employees.role_id) as count, roles.name')->leftJoin('roles', 'employees.role_id', '=', 'roles.id')->groupBy('employees.role_id', 'roles.name')->get();
    }
}
