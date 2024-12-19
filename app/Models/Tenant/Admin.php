<?php

namespace App\Models\Tenant;

use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;

class Admin extends Authenticatable implements HasTenants
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public function getTenants(Panel $panel): Collection|\Illuminate\Database\Eloquent\Collection
    {
        return collect([tenant()]);
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return true;
    }
}
