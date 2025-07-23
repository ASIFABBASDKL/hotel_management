@extends('layouts.admin_layout')

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb & Actions -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><a href="{{ route('superadmin.guests.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Guests</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Edit Guest</span></li>
            </ul>
        </div>
        <div class="flex-align justify-content-end gap-8">
            <a href="{{ route('superadmin.guests.index') }}" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</a>
            <button type="submit" form="editGuestForm" class="btn btn-main rounded-pill py-9">Update Guest</button>
        </div>
    </div>

    <!-- Step Indicator -->
    <ul class="step-list mb-24">
        <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active">
            <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
            Guest Details
            <span class="line position-relative"></span>
        </li>
        <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6">
            <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
            ID & Contact Info
            <span class="line position-relative"></span>
        </li>
    </ul>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Edit Guest Information</h5>
            <button type="button" class="text-main-600 text-md d-flex" data-bs-toggle="tooltip" data-bs-title="Update guest details">
                <i class="ph-fill ph-question"></i>
            </button>
        </div>
        <div class="card-body">
            <form id="editGuestForm" action="{{ route('superadmin.guests.update', $guest->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-20">

                    <!-- Basic Info -->
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Full Name</label>
                        <input type="text" name="full_name" value="{{ $guest->full_name }}" class="form-control" placeholder="Guest name">
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Email</label>
                        <input type="email" name="email" value="{{ $guest->email }}" class="form-control" placeholder="Email address">
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Phone</label>
                        <input type="text" name="phone" value="{{ $guest->phone }}" class="form-control" placeholder="Phone number">
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Address</label>
                        <input type="text" name="address" value="{{ $guest->address }}" class="form-control" placeholder="Residential address">
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Gender</label>
                        <select name="gender" class="form-select py-9">
                            <option disabled>Select gender</option>
                            <option value="Male" {{ $guest->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $guest->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $guest->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ $guest->date_of_birth }}" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Nationality</label>
                        <input type="text" name="nationality" value="{{ $guest->nationality }}" class="form-control" placeholder="Nationality">
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Emergency Contact</label>
                        <input type="text" name="emergency_contact" value="{{ $guest->emergency_contact }}" class="form-control" placeholder="Emergency phone">
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">ID Type</label>
                        <select name="id_type" class="form-select py-9">
                            <option disabled>Select ID type</option>
                            <option value="CNIC" {{ $guest->id_type == 'CNIC' ? 'selected' : '' }}>CNIC</option>
                            <option value="Passport" {{ $guest->id_type == 'Passport' ? 'selected' : '' }}>Passport</option>
                            <option value="Driving License" {{ $guest->id_type == 'Driving License' ? 'selected' : '' }}>Driving License</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">ID Document</label>
                        <input type="file" name="id_document_path" class="form-control" accept="application/pdf,image/*">
                        @if($guest->id_document_path)
                            <small class="text-gray-500">Current: {{ basename($guest->id_document_path) }}</small>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="h5 fw-semibold font-heading mb-8">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control" accept="image/*">
                        @if($guest->profile_image)
                            <small class="text-gray-500">Current: {{ basename($guest->profile_image) }}</small>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="h5 fw-semibold font-heading mb-8">Notes</label>
                        <textarea name="notes" rows="3" class="form-control" placeholder="Internal guest notes">{{ $guest->notes }}</textarea>
                    </div>

                </div>

                <!-- Footer Buttons -->
                <div class="flex-align justify-content-end gap-8 mt-24">
                    <a href="{{ route('superadmin.guests.index') }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                    <button type="submit" class="btn btn-main rounded-pill py-9">Update Guest</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
