<?php

namespace App\Http\Apis\v1\Inventory;

use App\Http\Apis\v1\Controller as BaseController;
use App\Http\Requests\Inventory\Stock\Request;
use App\Models\InventoryStock;
use App\Models\InventoryStockMovement;
use App\Repositories\Inventory\Repository;
use App\Repositories\Inventory\StockRepository;

class StockController extends BaseController
{
    /**
     * Constructor.
     *
     * @param Repository      $inventory
     * @param StockRepository $inventoryStock
     */
    public function __construct(Repository $inventory, StockRepository $inventoryStock)
    {
        $this->inventory = $inventory;
        $this->inventoryStock = $inventoryStock;
    }

    /**
     * Returns a new grid instance of the specified inventory's stocks.
     *
     * @param int|string $id
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function grid($id)
    {
        $columns = [
            'id',
            'quantity',
            'inventory_id',
            'location_id',
            'created_at',
        ];

        $settings = [
            'sort'      => 'created_at',
            'direction' => 'desc',
            'threshold' => 10,
            'throttle'  => 11,
        ];

        $transformer = function (InventoryStock $stock) use ($id) {
            return [
                'id'               => $stock->id,
                'quantity'         => $stock->getQuantityMetricAttribute(),
                'location'         => ($stock->location ? $stock->location->trail : null),
                'last_movement'    => $stock->getLastMovementAttribute(),
                'last_movement_by' => $stock->getLastMovementByAttribute(),
                'created_at'       => $stock->created_at,
                'view_url'         => route('maintenance.inventory.stocks.show', [$id, $stock->id]),
            ];
        };

        return $this->inventory->gridStocks($id, $columns, $settings, $transformer);
    }

    /**
     * Returns a new grid instance of all stock movements.
     *
     * @param int|string $id
     * @param int|string $stockId
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function gridMovements($id, $stockId)
    {
        $columns = [
            'id',
            'user_id',
            'stock_id',
            'before',
            'after',
            'cost',
            'reason',
        ];

        $settings = [
            'sort'      => 'created_at',
            'direction' => 'desc',
            'threshold' => 10,
            'throttle'  => 11,
        ];

        $transformer = function (InventoryStockMovement $movement) use ($id, $stockId) {
            return [
                'id'         => $movement->id,
                'before'     => $movement->before,
                'after'      => $movement->after,
                'cost'       => $movement->cost,
                'reason'     => $movement->reason,
                'change'     => $movement->getChangeAttribute(),
                'user'       => ($movement->user ? $movement->user->full_name : '<em>None</em>'),
                'created_at' => $movement->created_at,
                'view_url'   => route('maintenance.inventory.stocks.movements.show', [$id, $stockId, $movement->id]),
            ];
        };

        return $this->inventory->gridStockMovements($id, $stockId, $columns, $settings, $transformer);
    }

    /**
     * Processes updating the specified inventory stock.
     *
     * @param Request    $request
     * @param int|string $inventoryId
     * @param int|string $stockId
     *
     * @return bool|static
     */
    public function update(Request $request, $inventoryId, $stockId)
    {
        return $this->inventoryStock->update($request, $inventoryId, $stockId);
    }
}
