@extends('layouts.app')

@section('title', 'Student Basic Details')

@section('content')
<div class="container-fluid full-width-content py-3">

 <div class="page-header mb-3">
    <h4 class="fw-bold"><i class="bx bx-user"></i> Student Aadhaar Update Details   </h4>
  </div>


<div class="card card-full">
    
    <!-- Header -->
    <div class="card-header p-0">
      <div class="bg-primary text-white px-3 py-2">
        <h6 class="mb-0 text-white">Student Basic Details</h6>
      </div>
    </div>

    <div class="card-body p-0">

      <!-- wrapper that keeps a table-like feel but is fully responsive -->
      <div class="container-fluid">
        <div class="row g-0"> 
          <!-- Each cell pair uses the same markup on all breakpoints -->
          <!-- Row 1: Student Code -->
          <div class="col-12 col-md-6 border-bottom border-end">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Student Code</div>
              <div class="mt-2 mt-md-0">03196120000001</div>
            </div>
          </div>

          <!-- Row 1: Name -->
          <div class="col-12 col-md-6 border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Name</div>
              <div class="mt-2 mt-md-0">SAKIBUL ALI</div>
            </div>
          </div>

          <!-- Row 2: DOB -->
          <div class="col-12 col-md-6 border-bottom border-end">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">DOB</div>
              <div class="mt-2 mt-md-0">09-10-2014</div>
            </div>
          </div>

          <!-- Row 2: Gender -->
          <div class="col-12 col-md-6 border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Gender</div>
              <div class="mt-2 mt-md-0">MALE</div>
            </div>
          </div>

          <!-- Row 3: Social Category -->
          <div class="col-12 col-md-6 border-bottom border-end">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Social Category</div>
              <div class="mt-2 mt-md-0">OBC-A</div>
            </div>
          </div>

          <!-- Row 3: Religion -->
          <div class="col-12 col-md-6 border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Religion</div>
              <div class="mt-2 mt-md-0">MUSLIM</div>
            </div>
          </div>

          <!-- Row 4: Father Name -->
          <div class="col-12 col-md-6 border-bottom border-end">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Father Name</div>
              <div class="mt-2 mt-md-0">FAJAR ALI</div>
            </div>
          </div>

          <!-- Row 4: Mother Name -->
          <div class="col-12 col-md-6 border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Mother Name</div>
              <div class="mt-2 mt-md-0">KASHMIRA BIBI</div>
            </div>
          </div>

          <!-- Row 5: School Name -->
          <div class="col-12 col-md-6 border-bottom border-end">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">School Name</div>
              <div class="mt-2 mt-md-0">ADHATA HIGH SCHOOL(H.S)</div>
            </div>
          </div>

          <!-- Row 5: Dise Code -->
          <div class="col-12 col-md-6 border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start p-3">
              <div class="small text-uppercase text-muted me-2 fw-bold">Dise Code</div>
              <div class="mt-2 mt-md-0">19110100704</div>
            </div>
          </div>

          <!-- Aadhaar: full width always -->
          <div class="col-12">
            <div class="d-flex flex-column p-3">
              <label class="small text-uppercase text-muted mb-2 fw-bold">Aadhaar Number</label>
              <input type="text" class="form-control" value="882785393205" />
            </div>
          </div>

        </div> <!-- row -->
      </div> <!-- container-fluid -->

      <div class="d-flex justify-content-center py-3">
        <button class="btn btn-success px-4">Update</button>
      </div>

    </div>
  </div>
</div>
@endsection

@section('styles')
{{-- No custom CSS --}}
@endsection

@section('scripts')
{{-- No custom JS --}}
@endsection
