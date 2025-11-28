@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4"> <!-- full-width container -->
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <small class="mb-2 d-block">Head of Institution</small>
                <h4 class="card-title text-primary mb-2">ADHATA HIGH SCHOOL (H.S)</h4>
                <p class="mb-0 fw-semibold text-dark">SCHOOL CODE 19110101614</p>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img class="img-fluid" src="{{ asset('images/dash-img.png') }}">
              </div>
            </div>
          </div>
        </div>
    </div>
   </div>
  
   <div class="row g-3">
    <!-- Enrollment Card -->
    <div class="col-lg-6 col-md-12">
      <div class="card shadow-sm border-0 text-white" style="background-color:#0288d1; border-radius:8px; min-height:150px;">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h1 class="fw-bold mb-1 text-white" style="font-size:48px;">126</h1>
            <h5 class="fw-semibold mb-3 text-white">Enrolment</h5>
            <p class="mb-0">Boys : 90</p>
            <p class="mb-0">Girls : 36</p>
            <p class="mb-0">Transgenders : 0</p>
          </div>
          <i class="bx bxs-graduation" style="font-size:90px; opacity:0.2;"></i>
        </div>
      </div>
    </div>

    <!-- Employee Card -->
   <!-- Employee Card -->
    <div class="col-lg-6 col-md-12">
      <div class="card shadow-sm border-0 text-white" 
          style="background-color:#2e7d32; border-radius:8px; min-height:208px; cursor:pointer;"
          onclick="window.location.href='{{ url('employee/details') }}'">
        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
          <i class="bx bx-group mb-2" style="font-size:70px; opacity:0.7; color:white;"></i>
          <h5 class="fw-semibold mb-0 text-white">Click here to view Employee Details</h5>
        </div>
      </div>
    </div>


    <!-- Location Update Section -->
    <div class="col-lg-12">
      <div class="card shadow-sm border-0" style="border-radius:8px;">
        <div class="card-header text-white fw-bold" style="background-color:#1565c0; border-top-left-radius:8px; border-top-right-radius:8px;">
          Location Update
        </div>
        <div class="card-body">
          <div class="row g-3 align-items-center">
            <div class="col-md-6">
              <label class="form-label fw-semibold text-uppercase small">Latitude</label>
              <div class="row mb-3">
                <div class="col-3"><input type="text" class="form-control" placeholder="0.00"></div>
                <div class="col-3"><input type="text" class="form-control" placeholder="0.00"></div>
                <div class="col-3"><input type="text" class="form-control" placeholder="0.00"></div>
                <div class="col-3"><input type="text" class="form-control" placeholder="N"></div>
              </div>

              <label class="form-label fw-semibold text-uppercase small">Longitude</label>
              <div class="row">
                <div class="col-3"><input type="text" class="form-control" placeholder="0.00"></div>
                <div class="col-3"><input type="text" class="form-control" placeholder="0.00"></div>
                <div class="col-3"><input type="text" class="form-control" placeholder="0.00"></div>
                <div class="col-3"><input type="text" class="form-control" placeholder="E"></div>
              </div>
            </div>

            <div class="col-md-6">
              <div id="map" style="width:100%; height:280px; background-color:#e0e0e0; border-radius:8px; position:relative;">
                <div style="position:absolute; top:45%; left:48%; font-size:36px; color:#f44336;">📍</div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
