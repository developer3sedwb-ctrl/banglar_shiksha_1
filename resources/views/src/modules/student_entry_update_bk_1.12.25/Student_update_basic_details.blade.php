@extends('layouts.app')

@section('title', "Update Student's Basic Details")

@section('content')
<div class="container-fluid full-width-content">

  <!-- PAGE HEADING -->
  <div class="page-header mb-3">
    <h4 class="fw-bold"><i class="bx bx-user"></i> Update Student's Basic Details</h4>
  </div>

  <!-- INFO BAR -->
  <div class="alert alert-info py-2">
    Click on <strong>Update Student Identity</strong> for update student Name, DOB & Parent's Name
  </div>

  <!-- STUDENT SEARCH -->
  <div class="card mb-3">
    <div class="card-header bg-primary text-white py-2">Student Search</div>
    <div class="card-body p-3">
      <div class="row align-items-center">
        <div class="col-md-8 mb-2">
          <input type="text" class="form-control" placeholder="Search Student">
        </div>
        <div class="col-md-3 mb-2">
          <div class="input-group">
            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
            <input type="text" class="form-control" placeholder="Student Code">
          </div>
        </div>
        <div class="col-md-1 mb-2 text-end">
          <button class="btn btn-primary w-100">Search</button>
        </div>
      </div>
    </div>
  </div>

  <!-- STUDENT'S BASIC INFORMATION -->
  <div class="card mb-3">
    <div class="card-header bg-primary text-white py-2">Student's Basic Information</div>
    <div class="card-body p-3">

      <!-- Student Code & Status -->
      <div class="row mb-3">
        <div class="col-md-6">
          <p class="mb-1"><strong>Student Code *</strong></p>
          <p class="mb-0">11282032000122</p>
        </div>
        <div class="col-md-6 text-end">
          <p class="mb-1"><strong>Status</strong></p>
          <p class="text-success fw-bold mb-0">ACTIVE</p>
        </div>
      </div>

      <!-- FORM -->
      <form>
        <div class="row">
          <!-- LEFT COLUMN -->
          <div class="col-md-6">
            <div class="mb-2">
              <label class="form-label small">Student Name *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" placeholder="Student Name">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Father's Name *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" placeholder="Father's Name">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Gender *</label>
              <select class="form-select">
                <option>-Please Select-</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
            </div>

            <div class="mb-2">
              <label class="form-label small">Medium *</label>
              <select class="form-select">
                <option>-Please Select-</option>
                <option>BENGALI</option>
                <option>ENGLISH</option>
              </select>
            </div>

            <div class="mb-2">
              <label class="form-label small">District *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-map"></i></span>
                <input type="text" class="form-control" placeholder="District">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Post Office *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                <input type="text" class="form-control" placeholder="Post Office">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Pin Code *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-map-alt"></i></span>
                <input type="text" class="form-control" placeholder="Pin Code">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Bank Name *</label>
              <select class="form-select">
                <option>-Please Select-</option>
                <option>SBI</option>
                <option>HDFC</option>
              </select>
            </div>

            <div class="mb-2">
              <label class="form-label small">IFSC *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-credit-card"></i></span>
                <input type="text" class="form-control" placeholder="IFSC">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Student's Aadhaar Number</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                <input type="text" class="form-control" placeholder="Aadhaar Number">
              </div>
            </div>
          </div>

          <!-- RIGHT COLUMN -->
          <div class="col-md-6">
            <div class="mb-2">
              <label class="form-label small">Date of Birth *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                <input type="date" class="form-control">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Mother's Name *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" placeholder="Mother's Name">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Guardian's Contact No. *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                <input type="text" class="form-control" placeholder="Guardian's Contact No.">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Habitation or Locality *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-home"></i></span>
                <input type="text" class="form-control" placeholder="Locality">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Police Station *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                <input type="text" class="form-control" placeholder="Police Station">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Student's Contact No.</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-phone-call"></i></span>
                <input type="text" class="form-control" placeholder="Student's Contact No.">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Branch Name *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-bank"></i></span>
                <input type="text" class="form-control" placeholder="Branch Name">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Account Number *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-credit-card"></i></span>
                <input type="text" class="form-control" placeholder="Account Number">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Confirm Account Number *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-check"></i></span>
                <input type="text" class="form-control" placeholder="Confirm Account Number">
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label small">Upload Student Photo (Max size 20kb)</label>
              <input type="file" class="form-control">
            </div>

            <div class="mt-2">
              <img src="https://via.placeholder.com/100x120?text=Photo" alt="Student Photo" class="border rounded">
            </div>
          </div>
        </div>

        <!-- UPDATE BUTTON -->
        <div class="text-center mt-4">
          <button type="button" class="btn" style="background-color: #f39c12; color: white; padding: 8px 18px; border-radius: 4px;">
            Update Details
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
