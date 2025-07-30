@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb & Actions -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('dashboard.index') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Add Guest</span></li>
                </ul>
            </div>
        </div>

        <!-- Step Indicator -->
        <ul class="step-list mb-24">
            <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active">
                <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                Guest Details
                <span class="line position-relative"></span>
            </li>
            {{-- <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6">
                <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                ID & Contact Info
                <span class="line position-relative"></span>
            </li> --}}
        </ul>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                <h5 class="mb-0">Guest Information</h5>
                <button type="button" class="text-main-600 text-md d-flex" data-bs-toggle="tooltip"
                    data-bs-title="Fill in guest information">
                    <i class="ph-fill ph-question"></i>
                </button>
            </div>
            <div class="card-body">
                <form id="addGuestForm" action="{{ route('superadmin.guests.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-20">

                        <!-- Basic Info -->
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Guest name">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email address">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone number">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Residential address">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Gender</label>
                            <select name="gender" class="form-select py-9">
                                <option disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Nationality</label>
                            <input type="text" name="nationality" class="form-control" placeholder="Nationality">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Emergency Contact</label>
                            <input type="text" name="emergency_contact" class="form-control"
                                placeholder="Emergency phone">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">ID Type</label>
                            <select name="id_type" class="form-select py-9">
                                <option disabled selected>Select ID type</option>
                                <option value="CNIC">CNIC</option>
                                <option value="Passport">Passport</option>
                                <option value="Driving License">Driving License</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">ID Document</label>
                            <input type="file" name="id_document" class="form-control" accept="application/pdf,image/*">

                        </div>
                        <div class="col-sm-6">
                            <label class="h5 fw-semibold font-heading mb-8">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="h5 fw-semibold font-heading mb-8">Notes</label>
                            <textarea name="notes" rows="3" class="form-control" placeholder="Internal guest notes"></textarea>
                        </div>

                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex-align justify-content-end gap-8">
                        <a href="{{ route('superadmin.guests.index') }}"
                            class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</a>
                        <button type="submit" form="addGuestForm" class="btn btn-main rounded-pill py-9">Save
                            Guest</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
