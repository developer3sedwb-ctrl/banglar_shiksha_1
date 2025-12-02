@extends('layouts.app')

@section('title', 'Add Student')

@section('content')


<div class="container-fluid full-width-content">

   <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Bulk Upload</h5>
  </div>

  <!-- GENERAL INFORMATION -->
  <!-- BULK UPLOAD SECTION -->
<!-- BULK UPLOAD SECTION -->
<div class="card card-full mb-4 mt-4">

    <!-- Header Row with Download Button -->
    <div class="card-header d-flex justify-content-between ">
        <span class="fw-semibold">Upload Excel File</span>

        <a href="{{ url('download-entry-format') }}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
            <i class='bx bxs-file-pdf'></i>
            Download Entry Format
        </a>
    </div>

    <div class="card-body">

        <!-- Note -->
        <p class="text-danger mb-3">
            Note*: Students who are currently studying in class PRE-PRIMARY to class IX can upload the data.
        </p>

        <!-- Upload Box -->
        <div class="border rounded p-4" style="background:#f8f9fa;">
            <form action="{{ url('upload-student-excel') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label fw-semibold">Attached Document :</label>

                    <div class="col-sm-6">
                        <input type="file" name="excel_file" class="form-control" required>
                    </div>

                    <div class="col-sm-4 text-success fw-semibold">
                        Excel file with maximum 200 rows is allowed.
                    </div>
                </div>

                <!-- Centered Upload Button -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary px-4">Upload</button>
                </div>

            </form>
        </div>
    </div>
</div>



  <!-- FORM ACTIONS -->
  

</div>
@endsection
