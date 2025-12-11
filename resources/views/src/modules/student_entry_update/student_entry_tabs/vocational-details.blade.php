    <!-- =========TAB 4: VOCATIONAL DETAILS START BY AZIZA ===========-->
          <div class="tab-pane fade" id="vocational_tab" role="tabpanel" aria-labelledby="tab4-tab">
            <form id="stu_vocational_dtls_form">
              @csrf

              <!-- Title -->
              <h6 class="card-header bg-heading-primary text-white py-2">
                VOCATIONAL EDUCATION DETAILS OF THE STUDENT
              </h6>

              <div class="row mt-3">

                <!-- Exposure to vocational activities -->
                <div class="col-md-6">
                  <label class="form-label small fw-bold">
                    Was the student provided with any exposure to Vocational activities? <span class="text-danger">*</span>
                  </label>
                  <select name="exposure_vocational_activities_y_n" id="exposure_vocational_activities_y_n" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1">YES</option>
                    <option value="2">NO</option>
                  </select>
                </div>
                <!-- Undertook vocational course -->
                <div class="col-md-6">
                  <label class="form-label small fw-bold">
                    Did the student undertake any vocational course? <span class="text-danger">*</span>
                  </label>
                  <select name="undertook_vocational_course" id="undertook_vocational_course" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1">YES</option>
                    <option value="2">NO</option>
                  </select>
                </div>
              </div>

                <div class="row d-none" id="vocational_course_div">
                  <!-- Trade/Sector -->
                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Trade/Sector <span class="text-danger">*</span></label>
                    <select name="trade_sector" id="trade_sector" class="form-select">
                      <option value="">-Select Trade/Sector-</option>
                    </select>
                  </div>

                  <!-- Job Role -->
                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Job Role <span class="text-danger">*</span></label>
                    <select name="job_role" id="job_role" class="form-select">
                      <option value="">-Select Job Role-</option>
                    </select>
                  </div>

                  <!-- Duration of classes -->
                  <h6 class="mt-4 mb-2 fw-bold text-primary">Duration of vocational classes attended by student</h6>

                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Theory (Hours) <span class="text-danger">*</span></label>
                    <input type="number" name="theory_hours" id="theory_hours" class="form-control" placeholder="Hours">
                  </div>

                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Practical (Hours) <span class="text-danger">*</span></label>
                    <input type="number" name="practical_hours" id="practical_hours" class="form-control" placeholder="Hours">
                  </div>

                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Training in industry (Hours) <span class="text-danger">*</span></label>
                    <input type="number" name="industry_hours" id="industry_hours" class="form-control" placeholder="Hours">
                  </div>

                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Field Visit (Hours) <span class="text-danger">*</span></label>
                    <input type="number" name="field_visit_hours" id="field_visit_hours" class="form-control" placeholder="Hours">
                  </div>

                  <!-- Examination Appearance -->
                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Whether Appeared for Examination in Previous Class for Vocational Subject <span class="text-danger">*</span></label>
                    <select name="appeared_exam" id="appeared_exam" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="1">Appeared and Passed</option>
                      <option value="2">Appeared and Not Passed</option>
                      <option value="4">Not  Appeared</option>
                      <option value="3">Not Applicable</option>
                    </select>
                  </div>

                  <!-- Marks Obtained -->
                  <div class="col-md-6 mt-3 d-none">
                    <label class="form-label small fw-bold">% of Marks obtained <span class="text-danger">*</span></label>
                    <input type="number" name="marks_obtained" id="marks_obtained" class="form-control" placeholder="% of Marks obtained">
                  </div>

                  <!-- Placement Status -->
                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Whether student applied for placement <span class="text-danger">*</span></label>
                    <select name="placement_applied" id="placement_applied" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="1">Applied and Placed</option>
                      <option value="2">Applied and Not Placed</option>
                      <option value="3">Not Applied</option>
                    </select>
                  </div>

                  <!-- Apprenticeship -->
                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Whether student applied for apprenticeship <span class="text-danger">*</span></label>
                    <select name="apprenticeship_applied" id="apprenticeship_applied" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="1">Applied and Given Apprenticeship</option>
                      <option value="2">Applied But Not Given Apprenticeship</option>
                      <option value="3">Not Applied Yet</option>
                    </select>
                  </div>

                  <!-- NSQF Level -->
                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Completed NSQF Level <span class="text-danger">*</span></label>
                    <select name="nsqf_level" id="nsqf_level" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="1">YES</option>
                      <option value="2">NO</option>
                    </select>
                  </div>

                  <!-- Employment / Placement Status -->
                  <div class="col-md-6 mt-3">
                    <label class="form-label small fw-bold">Employment/placement Status <span class="text-danger">*</span></label>
                    <select name="employment_status" id="employment_status" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="1">YES</option>
                      <option value="2">NO</option>
                    </select>
                  </div>

                  <!-- Salary Offered -->
                  <div class="col-md-6 mt-3 d-none">
                    <label class="form-label small fw-bold">Salary Offered <span class="text-danger">*</span></label>
                    <input type="number" name="salary_offered" id="salary_offered" class="form-control" placeholder="Salary Offered">
                  </div>
                </div>


              <!-- Navigation Buttons -->
              <div class="form-actions text-end mt-3">
                <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#facility_other_dtls_tab" type="button">Previous</button>
                <button class="btn btn-success" data-bs-toggle="tab" id="save_vocational_btn" type="button">Save & Next</button>
              </div>

            </form>
          </div>