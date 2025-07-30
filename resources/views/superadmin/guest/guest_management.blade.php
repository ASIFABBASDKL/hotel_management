@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Guest Management</span></li>
                </ul>
            </div>
            <a href="{{ route('superadmin.guests.create') }}" class="btn btn-primary btn-sm">
                Add Guest
            </a>
        </div>

      <div class="card mt-24 mb-24">
    <div class="card-body">
        <form action="#" class="search-input-form" id="guestFilterForm">

            <!-- Search by Guest Name -->
            <div class="search-input">
                <input type="text" id="filterGuestName"
                    class="form-control h6 rounded-4 mb-0 py-6 px-8"
                    placeholder="Search by Guest Name">
            </div>

            <!-- Search by Phone Number -->
            <div class="search-input">
                <input type="text" id="filterGuestPhone"
                    class="form-control h6 rounded-4 mb-0 py-6 px-8"
                    placeholder="Search by Phone Number">
            </div>

            <!-- Fake Search Button (optional for design only) -->
            <div class="search-input">
                <button type="button" class="btn btn-main rounded-pill py-9 w-100" disabled>Search</button>
            </div>

        </form>
    </div>
</div>



        <!-- Guest List Table -->
        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300">#</th>
                        <th class="h6 text-gray-300">Full Name</th>
                        <th class="h6 text-gray-300">Email</th>
                        <th class="h6 text-gray-300">Phone</th>
                        <th class="h6 text-gray-300">Gender</th>
                        <th class="h6 text-gray-300">Profile Image</th>
                        <th class="h6 text-gray-300">Address</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guests as $key => $guest)
                        <tr>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $key + 1 }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $guest->full_name }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $guest->email ?? 'N/A' }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $guest->phone ?? 'N/A' }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $guest->gender ?? 'N/A' }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">
                                @if ($guest->profile_image)
                                    <img src="{{ asset('storage/' . $guest->profile_image) }}" alt="Profile" width="40"
                                        height="40">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $guest->address ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('superadmin.guests.edit', $guest->id) }}"
                                    class="text-main-600 bg-main-50 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white d-inline-block text-center">
                                    Edit
                                </a>

                                <form action="{{ route('superadmin.guests.destroy', $guest->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white">
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
    const nameInput = document.getElementById('filterGuestName');
    const phoneInput = document.getElementById('filterGuestPhone');

    const tableRows = document.querySelectorAll('table tbody tr');

    function filterGuestRows() {
        const nameVal = nameInput.value.toLowerCase();
        const phoneVal = phoneInput.value.toLowerCase();

        tableRows.forEach(row => {
            const tds = row.querySelectorAll('td');
            const nameText = tds[1]?.textContent.toLowerCase() || '';   // Full Name column
            const phoneText = tds[3]?.textContent.toLowerCase() || '';  // Phone column (✅ fixed index)

            const matchesName = nameText.includes(nameVal);
            const matchesPhone = phoneText.includes(phoneVal);

            row.style.display = (matchesName && matchesPhone) ? '' : 'none';
        });
    }

    nameInput.addEventListener('input', filterGuestRows);
    phoneInput.addEventListener('input', filterGuestRows);
});
</script>


@endsection
