@extends('layouts.app')

@section('title', "Update Student's Basic Details")

@section('content')
<div class="container-fluid full-width-content">

  <!-- PAGE HEADING -->
  <div class="page-header mb-3">
    <h4 class="fw-bold"><i class="bx bx-user"></i> Update Student's Basic Details</h4>
  </div>

  <!-- STUDENT SEARCH -->
  <div class="card mb-3">
    <div class="card-header bg-primary text-white py-2">Change  Password? 🔒</div>
    <div class="card-body p-3">
      <div class="row align-items-center">
        <div class="col-md-3 mb-2">
          <div class="input-group">
            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
            <input type="text" class="form-control" placeholder="Old Password">
          </div>
        </div>


        <div class="col-md-3 mb-2">
          <div class="input-group">
            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
            <input type="text" class="form-control" placeholder="New Password">
          </div>
        </div>


        <div class="col-md-3 mb-2">
          <div class="input-group">
            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
            <input type="text" class="form-control" placeholder="Confirm Password">
          </div>
        </div>
        <div class="col-md-1 mb-2 text-end">
          <button class="btn btn-primary w-100" type="button">Search</button>
        </div>
      </div>
    </div>
  </div>



  <!-- CHANGE PASSWORD -->
  <div class="card mb-3">
    <div class="card-body p-4">
      <div style="max-width:900px;margin:0 auto;">

        <div class="mb-3">
          <label class="form-label">Old Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" placeholder="Old Password">
        </div>

        <div class="mb-3">
          <label class="form-label">New Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" placeholder="New Password">
        </div>

        <div class="mb-4">
          <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" placeholder="Confirm Password">
        </div>

        <div class="text-center">
          <button type="button" class="btn btn-warning px-4">Change</button>
        </div>

      </div>
    </div>
  </div>

</div>
@endsection
