 @extends('layouts.app') @section('title', 'Dashboard') @section('content')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid full-width-content">
    <!-- TOP ROW: Institution + Two Small Cards -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card card-effect">
                <div class="d-flex align-items-center row">
                    <div class="col-sm-7">
                        <div class="card-body pb-5 institution-details">
                            <p class="text-secondary mb-2 d-block">Head of Institution</p>
                            <h4 class="text-primary mb-2"><strong>ADHATeeA HIGH SCHOOL (H.S)</strong></h4>
                            <p class="mb-0 fw-semibold text-dark">SCHOOL CODE 19110101614</p>
                        </div>
                    </div>

                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="px-md-4">
                            <img class="img-fluid" src="{{ asset('images/student.png') }}" alt="Institution">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="card card-effect">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar-md lt-green">
                            <i class="bx bxs-school text-success"></i>
                        </div>
                    </div>
                    <h3 class="card-title mb-2 fw-semibold">SCHOOL INFO</h3>
                    <a href="javascript:;" class="btn btn-sm btn-outline-primary mt-2">View More</a>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="card card-effect">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar-md lt-blue">
                            <i class="bx bx-desktop text-primary"></i>
                        </div>
                    </div>
                    <h3 class="card-title mb-2 fw-semibold">SM23S</h3>
                    <a href="javascript:;" class="btn btn-sm btn-outline-primary mt-2">View More</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2">
      <div class="card card-effect">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar-md lt-green">
              <i class="bx bxs-school text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="col-lg-2">
      <div class="card card-effect">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar-md lt-blue">
              <i class="bx bx-desktop text-primary"></i>
            </div>
          </div>
          <h3 class="card-title mb-2 fw-semibold">SMS</h3>
          <a href="javascript:;" class="btn btn-sm btn-outline-primary mt-2">View More</a>
        </div>
      </div>
    </div>
  </div>

  <!-- MIDDLE ROW: Student, Teacher, Geolocation Columns -->
  <div class="row">
    <!-- STUDENT DETAILS -->
    <div class="col-12 col-md-12 col-xxl-4 mb-4">
      <h5 class="fw-bold mb-3">Student Details</h5>

      <div class="row">
        <!-- Total Enrolment -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-food-menu text-success"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Total Enrolment</h3>
              <h2 class="fw-bold text-success">791</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-success" role="progressbar" style="width:75%" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Boys -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-blue">
                  <i class="bx bx-group text-primary"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Boys</h3>
              <h2 class="fw-bold text-primary">90</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-primary" role="progressbar" style="width:50%" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Girls -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-red">
                  <i class="bx bx-group text-danger"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Girls</h3>
              <h2 class="fw-bold text-danger">30</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-danger" role="progressbar" style="width:30%" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Transgenders -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-purple">
                  <i class="bx bx-group text-purple"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Transgenders</h3>
              <h2 class="fw-bold text-purple">0</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-purple" role="progressbar" style="width:0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- TEACHER DETAILS -->
    <div class="col-12 col-md-12 col-xxl-4 mb-4">
      <h5 class="fw-bold mb-3">Teacher Details</h5>

      <div class="row">
        <!-- Total Teacher -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-green">
                  <i class="bx bx-user text-success"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Total Teacher</h3>
              <h2 class="fw-bold text-success">53</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-success" role="progressbar" style="width:50%" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Teaching Staff -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-yellow">
                  <i class="bx bx-group text-warning"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Teaching Staff</h3>
              <h2 class="fw-bold text-warning">45</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width:45%" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Para Teacher -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-red">
                  <i class="bx bx-group text-danger"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Para Teacher</h3>
              <h2 class="fw-bold text-danger">10</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-danger" role="progressbar" style="width:10%" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Nonteaching Staff -->
        <div class="col-6 col-md-3 col-xxl-6 mb-4">
          <div class="card card-effect">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar lt-seegreen">
                  <i class="bx bx-group text-info"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                  </div>
                </div>
              </div>

              <h3 class="card-title mb-2 fw-semibold">Nonteaching Staff</h3>
              <h2 class="fw-bold text-info">4</h2>

              <div class="progress card-progress">
                <div class="progress-bar bg-info" role="progressbar" style="width:4%" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- GEOLOCATION -->
    <div class="col-12 col-md-12 col-xxl-4 mb-4">
      <h5 class="fw-bold mb-3">Geolocation Search</h5>

      <div class="card card-effect">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar lt-green">
              <i class="bx bx-map text-success"></i>
            </div>
          </div>

          <h3 class="card-title mb-0 fw-semibold">Location Details</h3>

          <div class="col-12 mt-4">
            <label class="form-label fw-semibold text-uppercase small">Latitude</label>
            <input type="text" id="latitude" class="form-control form-control-lg mb-3" value="22.52" placeholder="Enter latitude">

            <label class="form-label fw-semibold text-uppercase small">Longitude</label>
            <input type="text" id="longitude" class="form-control form-control-lg" value="88.31" placeholder="Enter longitude">

            <button class="btn btn-primary mt-4" onclick="updateMap()">Show on Map</button>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- MIDDLE ROW: Student, Teacher, Geolocation Columns -->
    <div class="row">
        <!-- STUDENT DETAILS -->
        <div class="col-12 col-md-12 col-xxl-4 mb-4">
            <h5 class="fw-bold mb-3">Student Details</h5>

            <div class="row">
                <!-- Total Enrolment -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-green">
                                    <i class="bx bx-food-menu text-success"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Total Enrolment</h3>
                            <h2 class="fw-bold text-success">791</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width:75%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boys -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-blue">
                                    <i class="bx bx-group text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Boys</h3>
                            <h2 class="fw-bold text-primary">90</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width:50%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Girls -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-red">
                                    <i class="bx bx-group text-danger"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Girls</h3>
                            <h2 class="fw-bold text-danger">30</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:30%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transgenders -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-purple">
                                    <i class="bx bx-group text-purple"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Transgenders</h3>
                            <h2 class="fw-bold text-purple">0</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width:0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TEACHER DETAILS -->
        <div class="col-12 col-md-12 col-xxl-4 mb-4">
            <h5 class="fw-bold mb-3">Teacher Details</h5>

            <div class="row">
                <!-- Total Teacher -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-green">
                                    <i class="bx bx-user text-success"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Total Teacher</h3>
                            <h2 class="fw-bold text-success">53</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width:50%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teaching Staff -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-yellow">
                                    <i class="bx bx-group text-warning"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Teaching Staff</h3>
                            <h2 class="fw-bold text-warning">45</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:45%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Para Teacher -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-red">
                                    <i class="bx bx-group text-danger"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Para Teacher</h3>
                            <h2 class="fw-bold text-danger">10</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:10%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nonteaching Staff -->
                <div class="col-6 col-md-3 col-xxl-6 mb-4">
                    <div class="card card-effect">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar lt-seegreen">
                                    <i class="bx bx-group text-info"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show"></i> View More</a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mb-2 fw-semibold">Nonteaching Staff</h3>
                            <h2 class="fw-bold text-info">4</h2>

                            <div class="progress card-progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width:4%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GEOLOCATION -->
        <div class="col-12 col-md-12 col-xxl-4 mb-4">
            <h5 class="fw-bold mb-3">Geolocation Search</h5>

            <div class="card card-effect">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar lt-green">
                            <i class="bx bx-map text-success"></i>
                        </div>
                    </div>

                    <h3 class="card-title mb-0 fw-semibold">Location Details</h3>

                    <div class="col-12 mt-4">
                        <label class="form-label fw-semibold text-uppercase small">Latitude</label>
                        <input type="text" id="latitude" class="form-control form-control-lg mb-3" value="22.52" placeholder="Enter latitude">

                        <label class="form-label fw-semibold text-uppercase small">Longitude</label>
                        <input type="text" id="longitude" class="form-control form-control-lg" value="88.31" placeholder="Enter longitude">

                        <button class="btn btn-primary mt-4" onclick="updateMap()">Show on Map</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM ROW: Full-width Map -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body p-0">
                    <div id="map" class="map" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet assets -->
<link rel="stylesheet" href="{{ asset('Leaflet_map/leaflet.css') }}">
<script src="{{ asset('Leaflet_map/leaflet.js') }}"></script>

<!-- Map script -->
<script>
    // Force Leaflet to use local marker icons
    L.Icon.Default.mergeOptions({
        iconUrl: '{{ asset('Leaflet_map/images/marker-icon.png') }}',
        iconRetinaUrl: '{{ asset('Leaflet_map/images/marker-icon-2x.png') }}',
        shadowUrl: '{{ asset('Leaflet_map/images/marker-shadow.png') }}'
    });

    // Initial coordinates (read from inputs)
    var lat = parseFloat(document.getElementById('latitude').value) || 22.52;
    var lng = parseFloat(document.getElementById('longitude').value) || 88.31;

    // Initialize map
    var map = L.map('map', {
        zoomControl: false,
        attributionControl: false
    }).setView([lat, lng], 13);

    // Tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: ''
    }).addTo(map);

    // Explicit icon
    var myIcon = L.icon({
        iconUrl: '{{ asset('Leaflet_map/images/marker-icon.png') }}',
        iconRetinaUrl: '{{ asset('Leaflet_map/images/marker-icon-2x.png') }}',
        shadowUrl: '{{ asset('Leaflet_map/images/marker-shadow.png') }}',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Add marker
    var marker = L.marker([lat, lng], { icon: myIcon }).addTo(map);

    // Update map function
    function updateMap() {
        var newLat = parseFloat(document.getElementById('latitude').value);
        var newLng = parseFloat(document.getElementById('longitude').value);

        if (!isNaN(newLat) && !isNaN(newLng)) {
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng], 13);
        } else {
            alert("Please enter valid coordinates");
        }
    }
</script>
@endsection
