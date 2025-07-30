@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Room Management</span></li>
                </ul>
            </div>
            <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm">
                Add Room
            </a>
        </div>

       <div class="card mt-24 mb-24">
    <div class="card-body">
        <form action="#" class="search-input-form" id="roomFilterForm">


            <!-- Filter by Status -->
            <div class="search-input">
                <select id="filterStatus" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                    <option value="" selected disabled>Search by Status</option>
                    <option value="available">Available</option>
                    <option value="occupied">Occupied</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

            <!-- Filter by Type -->
            <div class="search-input">
                <select id="filterType" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                    <option value="" selected disabled>Search by Type</option>
                    <option value="Single">Single</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Suite">Suite</option>
                </select>
            </div>
             <!-- Search by Room Number -->
            <div class="search-input">
                <input type="text" id="filterRoomNumber"
                    class="form-control h6 rounded-4 mb-0 py-6 px-8" placeholder="Search by Room Number">
            </div>

            <!-- (Optional) Search Button — not needed for script but keeping for design -->
            <div class="search-input">
                <button type="button" class="btn btn-main rounded-pill py-9 w-100" disabled>Search</button>
            </div>
        </form>
    </div>
</div>


        <!-- Room List Table -->
        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300">#</th>
                        <th class="h6 text-gray-300">Room No</th>
                        <th class="h6 text-gray-300">Floor</th>
                        <th class="h6 text-gray-300">Type</th>
                        <th class="h6 text-gray-300">Price</th>
                        <th class="h6 text-gray-300">Occupancy</th>
                        <th class="h6 text-gray-300">Status</th>
                        <th class="h6 text-gray-300">Image</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $key => $room)
                        <tr>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $key + 1 }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $room->room_number }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $room->floor_number ?? '-' }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $room->type }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ number_format($room->price, 2) }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $room->occupancy_limit }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ ucfirst($room->status) }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">
                                @if ($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" width="50"
                                        height="50">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td class="h6 mb-0 fw-medium text-gray-300">
                                <a href="{{ route('rooms.edit', $room->id) }}"
                                    class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
                                    Edit
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        onclick="return confirm('Are you sure you want to delete this room?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roomInput = document.getElementById('filterRoomNumber');
        const statusSelect = document.getElementById('filterStatus');
        const typeSelect = document.getElementById('filterType');

        const tableRows = document.querySelectorAll('table tbody tr');

        function filterRows() {
            const roomVal = roomInput.value.toLowerCase();
            const statusVal = statusSelect.value.toLowerCase();
            const typeVal = typeSelect.value.toLowerCase();

            tableRows.forEach(row => {
                const roomText = row.children[1]?.textContent.toLowerCase();
                const typeText = row.children[3]?.textContent.toLowerCase();
                const statusText = row.children[6]?.textContent.toLowerCase();

                const matchesRoom = roomText.includes(roomVal);
                const matchesStatus = !statusVal || statusText === statusVal;
                const matchesType = !typeVal || typeText === typeVal;

                row.style.display = (matchesRoom && matchesStatus && matchesType) ? '' : 'none';
            });
        }

        roomInput.addEventListener('input', filterRows);
        statusSelect.addEventListener('change', filterRows);
        typeSelect.addEventListener('change', filterRows);
    });
</script>
@endsection
