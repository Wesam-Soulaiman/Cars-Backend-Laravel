<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\OrderFilter;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepositoryImplementation implements OrderInterface
{
    public function model()
    {
        return Order::class;
    }

    public function addOrder($data)
    {
        $service = Service::find($data['service_id']);
        $count_days = $data['count_days'];
        $start_time = Carbon::parse($data['start_time']);
        $end_time = $start_time->addDays($count_days)->format('Y-m-d');
        $order = [
            'category_service_id' => $service->category_service_id,
            'service_id' => $service->id,
            'store_id' => $data['store_id'],
            'price' => $data['price'],
            'start_time' => $data['start_time'],
            'count_days' => $count_days,
            'end_time' => $end_time,
            'active' => $data['active'],
        ];
        $order = $this->create($order);

        return ApiResponseHelper::sendResponse(new Result($order), ApiResponseCodes::CREATED);
    }

    public function updateOrder(Order $order, $data)
    {
        $service = Service::find($data['service_id'] ?? $order->service_id);
        $count_days = $data['count_days'] ?? $order->count_days;
        $start_time = Carbon::parse($data['start_time'] ?? $order->start_time);
        $end_time = $start_time->addDays($count_days)->format('Y-m-d');
        $newOrder = [
            'category_service_id' => $service->category_service_id,
            'service_id' => $service->id,
            'store_id' => $data['store_id'] ?? $order->store_id,
            'price' => $data['price'] ?? $order->price,
            'start_time' => $data['start_time'] ?? $order->start_time,
            'count_days' => $count_days,
            'end_time' => $end_time,
            'active' => $data['active'] ?? $order->active,

        ];
        $newOrder = $this->updateById($order->id, $newOrder);

        return ApiResponseHelper::sendResponse(new Result($newOrder));
    }

    public function deleteOrder(Order $order)
    {
        $this->deleteById($order->id);

        return ApiResponseHelper::sendMessageResponse('delete order  successfully');
    }

    public function showOrder(Order $order)
    {
        $showOrder = $this->getById($order->id);
        $showOrder = OrderResource::make($showOrder);

        return ApiResponseHelper::sendResponse(new Result($showOrder));
    }

    public function indexOrder(OrderFilter $filters)
    {
        $this->with = ['service', 'store'];
        $authStore = Auth::guard('store')->check();
        if (! is_null($filters->getActive())) {
            if ($filters->getActive()) {
                $this->scopes['active'] = [];
            } else {
                $this->scopes['inactive'] = [];
            }
        }

        if (! is_null($filters->getStoreId()) && ! $authStore) {
            $this->where('store_id', $filters->getStoreId());
        }

        if (! is_null($filters->getServiceId())) {
            $this->where('service_id', $filters->getServiceId());
        }
        if (! is_null($filters->getCreatedAt())) {
            $date = \Carbon\Carbon::parse($filters->getCreatedAt())->toDateString();
            $this->where('created_at', $date.'%', 'like');
        }
        if ($authStore) {
            $this->where('store_id', Auth::guard('store')->id());
        }
        if (! is_null($filters->getOrder()) && ! is_null($filters->getOrderBy())) {
            $this->orderBy($filters->orderBy, $filters->order);
        }
        $orders = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total' => $orders->total(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'per_page' => $orders->perPage(),
        ];
        $products = OrderResource::collection($orders->items());
        $data = [
            'products' => $products,
            'char' => $this->GetCountorderByMonth(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($data, 'get orders successfully', $pagination));
    }

    public function GetCountOrderByMonth()
    {
        $query = Order::selectRaw('
        DATE_FORMAT(start_time, "%Y-%m") as month,
        DATE_FORMAT(start_time, "%M") as month_name,
        COUNT(*) as order_count
    ')
            ->whereYear('start_time', date('Y'))
            ->groupBy('month', 'month_name')
            ->orderBy('month');

        if (auth('store')->check()) {
            $storeId = auth('store')->id();
            $query->where('store_id', $storeId);
        }

        return $query->get();
    }

    public function CountOrder()
    {
        if (Auth::guard('store')->check()) {
            $this->where('store_id', Auth::guard('store')->id());
        }

        return $this->count();
    }

    public function totalBills()
    {
        return Order::sum('price');
    }

    public function CountActiveOrder()
    {
        $this->scopes = ['activeOrder' => []];

        return $this->count();
    }

    public static function SubscribedStoresCount()
    {
        return DB::table('orders')
            ->selectRaw('COUNT(DISTINCT store_id) as total')
            ->groupBy('store_id')
            ->pluck('total')
            ->sum();
    }

    public static function getServicesCount()
    {
        return DB::table('orders')
            ->rightJoin('services', 'services.id', '=', 'orders.service_id')
            ->select('services.name', DB::raw('COUNT(orders.service_id) as total'))
            ->groupBy('orders.service_id', 'services.name')
            ->get();
    }

    public static function getmonthlyOrders()
    {
        return Order::selectRaw('DATE_FORMAT(start_time, "%Y-%m") as month, COUNT(*) as order_count')->groupBy('month')->orderBy('month')->get();
    }
}
