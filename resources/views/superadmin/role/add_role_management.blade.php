@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('roles.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Back
                            to Roles</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Create Role</span></li>
                </ul>
            </div>
        </div>

        <div class="card p-4">
            <h5 class="mb-4">Add New Role</h5>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"></textarea>
                    @error('description')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Assign Permissions</label>
                    <div class="border rounded p-3 bg-light">
                        @forelse ($groupedPermissions as $page => $permissions)
                            <div class="mb-4">
                                <h6 class="text-main-600 mb-2">{{ ucfirst($page) }}</h6>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-4 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                    {{ ucwords(str_replace('_', ' ', $permission->label ?? $permission->name)) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p>No permissions available.</p>
                        @endforelse
                    </div>
                </div>


                <button type="submit" class="btn btn-primary mt-3">Create Role</button>
            </form>
        </div>
    </div>
@endsection
