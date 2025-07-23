<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $models = ['bookings', 'payments', 'rooms', 'guests'];
        $actions = ['add', 'edit', 'view', 'delete'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $name = "{$action}_{$model}"; // e.g. edit_bookings
                $label = ucfirst($action) . ' ' . ucfirst($model); // e.g. Edit Bookings

                Permission::updateOrCreate(
                    ['name' => $name],
                    [
                        'label' => $label,
                        'model' => $model,
                        'action' => $action,
                    ]
                );
            }
        }
    }
}
