@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid px-4">
  <div class="row g-3">

    <!-- Card 1 -->

<div class="col-12 col-sm-6 col-md-4">
  <div class="card h-100">
    <div class="card-body d-flex flex-column">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar lt-green">
          <i class="bi bi-bookmark-check-fill text-success"></i>
        </div>
      </div>

      <h3 class="card-title mb-2 fw-semibold text-primary">No of Tagged SHG</h3>
      <h2 class="fw-bold text-success">791</h2>

      <div class="mt-auto"></div>
    </div>
  </div>
</div>

    <!-- Card 2 -->
      <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success "></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">No of SHG for which Work Order Issued</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

    <!-- Card 3 -->
      <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success "></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">No of SHG Measurement Completed</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

    <!-- Card 4 -->
      <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success"></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">Requirment of Fabric</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

    <!-- Card 5 -->
      <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success"></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">No of SHG Uniform Manufacturing Completed</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

    <!-- Card 6 -->
  <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success"></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">No of SHG Uniform Delivered</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

    <!-- Card 7 -->
      <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success"></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">Acknowledgement of Uniform</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

    <!-- Card 8 -->
   <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success"></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">Total Boys Enrolment</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

    <!-- Card 9 -->
      <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success"></i>
                </div>
              </div>
              <h3 class="card-title mb-2 fw-semibold text-primary">Total Girls Enrolment</h3>
              <h2 class="fw-bold text-success">791</h2>
              <div class="mt-auto">
              </div>
            </div>
          </div>
      </div>

  </div> <!-- end row -->
</div> <!-- end container -->


@endsection
