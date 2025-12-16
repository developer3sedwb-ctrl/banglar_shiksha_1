          <!-- ========TAB 3: FACILITY AND OTHER DETAILS START BY AZIZA ======-->
          <div class="tab-pane fade" id="facility_other_dtls_tab" role="tabpanel" aria-labelledby="tab3-tab">

            @php
            $val = $data['facility'] ?? [];
            @endphp

            <form id="student_facility_other_dtls_form">
              @csrf

              <!-- ========================================================= -->
              <!-- FACILITIES PROVIDED -->
              <!-- ========================================================= -->
              <h6 class="card-header bg-heading-primary text-white py-2">
                FACILITIES AND OTHER DETAILS OF THE STUDENT
              </h6>

              <div class="row mt-3">

                {{-- Facilities Provided --}}
                <div class="col-md-6">
                  <label for="facilities_provided_for_the_yeear" class="form-label small fw-bold">
                    Facilities provided to the student<span class="text-danger"> *</span>
                  </label>
                  <select id="facilities_provided_for_the_yeear" name="facilities_provided_for_the_yeear"
                    class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['facilities_provided_for_the_yeear'] ?? '' )==1 ? 'selected' : '' }}>YES
                    </option>
                    <option value="2" {{ ($val['facilities_provided_for_the_yeear'] ?? '' )==2 ? 'selected' : '' }}>NO
                    </option>
                  </select>
                </div>

                {{-- FREE TRANSPORT FACILITY --}}
                <div class="col-md-6">
                  <label for="free_transport_facility" class="form-label small fw-bold">Free Transport Facility<span class="text-danger"> *</span></label>
                  <select id="free_transport_facility" name="free_transport_facility" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['free_transport_facility'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['free_transport_facility'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- FREE HOST FACILITY --}}
                <div class="col-md-6">
                  <label for="free_host_facility" class="form-label small fw-bold">Free Host Facility<span class="text-danger"> *</span></label>
                  <select id="free_host_facility" name="free_host_facility" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['free_host_facility'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['free_host_facility'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- FREE BICYCLE --}}
                <div class="col-md-6">
                  <label for="free_bicycle" class="form-label small fw-bold">Free Bicycle<span class="text-danger">
                      *</span></label>
                  <select id="free_bicycle" name="free_bicycle" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['free_bicycle'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['free_bicycle'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- FREE UNIFORMS --}}
                <div class="col-md-6">
                  <label for="free_uniforms" class="form-label small fw-bold">Free Uniforms<span class="text-danger">
                      *</span></label>
                  <select id="free_uniforms" name="free_uniforms" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['free_uniforms'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['free_uniforms'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- FREE ESCORT --}}
                <div class="col-md-6">
                  <label for="free_escort" class="form-label small fw-bold">Free Escort<span class="text-danger">
                      *</span></label>
                  <select id="free_escort" name="free_escort" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['free_escort'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['free_escort'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- FREE SHOE --}}
                <div class="col-md-6">
                  <label for="free_shoe" class="form-label small fw-bold">Free Shoe<span class="text-danger">
                      *</span></label>
                  <select id="free_shoe" name="free_shoe" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['free_shoe'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['free_shoe'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- FREE EXERCISE BOOK --}}
                <div class="col-md-6">
                  <label for="free_exercise_book" class="form-label small fw-bold">Free Exercise Book<span class="text-danger"> *</span></label>
                  <select id="free_exercise_book" name="free_exercise_book" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['free_exercise_book'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['free_exercise_book'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- COMPLETE FREE BOOKS --}}
                <div class="col-md-6">
                  <label for="complete_free_books" class="form-label small fw-bold">Complete Set of Free Books<span class="text-danger"> *</span></label>
                  <select id="complete_free_books" name="complete_free_books" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="1" {{ ($val['complete_free_books'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['complete_free_books'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

              </div>

              <!-- ========================================================= -->
              <!-- SCHOLARSHIP SECTION WITH PREFILL -->
              <!-- ========================================================= -->

              <h6 class="card-header bg-heading-primary text-white py-2 mt-3">SCHOLARSHIP RECEIVED BY STUDENT</h6>

              <div class="row mt-3">

                {{-- CENTRAL SCHOLARSHIP --}}
                <div class="col-md-6">
                  <label for="central_scholarship" class="form-label small fw-bold">Central Scholarship<span class="text-danger"> *</span></label>
                  <select id="central_scholarship" name="central_scholarship" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['central_scholarship'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['central_scholarship'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- CENTRAL SCHOLARSHIP NAME --}}
                <div
                  class="col-md-6 {{ isset($val['central_scholarship']) && $val['central_scholarship'] == 1 ? '' : 'd-none' }}">
                  <label for="central_scholarship_name" class="form-label small fw-bold">Name of Central
                    Scholarship<span class="text-danger"> *</span></label>
                  <select id="central_scholarship_name" name="central_scholarship_name" class="form-select">
                    <option value="">--Select Scholarship--</option>

                    @foreach ($data['centralScholarships'] as $sch)
                    <option value="{{ $sch->id }}" {{ ($val['central_scholarship_name'] ?? '' )==$sch->id ? 'selected' :
                      '' }}>
                      {{ $sch->name }}
                    </option>
                    @endforeach

                  </select>
                </div>

                {{-- CENTRAL AMOUNT --}}
                <div
                  class="col-md-6 {{ isset($val['central_scholarship']) && $val['central_scholarship'] == 1 ? '' : 'd-none' }}">
                  <label for="central_scholarship_amount" class="form-label small fw-bold">Central Scholarship
                    Amount<span class="text-danger"> *</span></label>
                  <input type="number" id="central_scholarship_amount" name="central_scholarship_amount"
                    class="form-control" value="{{ $val['central_scholarship_amount'] ?? '' }}">
                </div>

                {{-- STATE SCHOLARSHIP --}}
                <div class="col-md-6">
                  <label for="state_scholarship" class="form-label small fw-bold">State Scholarship<span class="text-danger"> *</span></label>
                  <select id="state_scholarship" name="state_scholarship" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['state_scholarship'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['state_scholarship'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- STATE SCHOLARSHIP NAME --}}
                <div
                  class="col-md-6 {{ isset($val['state_scholarship']) && $val['state_scholarship'] == 1 ? '' : 'd-none' }}">
                  <label for="state_scholarship_name" class="form-label small fw-bold">State Scholarship Name<span class="text-danger"> *</span></label>
                  <select id="state_scholarship_name" name="state_scholarship_name" class="form-select">
                    <option value="">-- Select Scholarship --</option>

                    @foreach ($data['stateScholarships'] as $sch)
                    <option value="{{ $sch->id }}" {{ ($val['state_scholarship_name'] ?? '' )==$sch->id ? 'selected' : ''
                      }}>
                      {{ $sch->name }}
                    </option>
                    @endforeach

                  </select>
                </div>

                {{-- STATE AMOUNT --}}
                <div
                  class="col-md-6 {{ isset($val['state_scholarship']) && $val['state_scholarship'] == 1 ? '' : 'd-none' }}">
                  <label for="state_scholarship_amount" class="form-label small fw-bold">State Scholarship Amount <span class="text-danger">*</span></label>
                  <input type="number" id="state_scholarship_amount" name="state_scholarship_amount" class="form-control"
                    value="{{ $val['state_scholarship_amount'] ?? '' }}">
                </div>
                {{-- Other SCHOLARSHIP NAME --}}
                <div
                  class="col-md-6">
                  <label for="state_scholarship_name" class="form-label small fw-bold">Other Scholarship<span class="text-danger"> *</span></label>
                  <select id="other_scholarship" name="other_scholarship" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['other_scholarship'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['other_scholarship'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- STATE AMOUNT --}}
                <div
                  class="col-md-6 {{ isset($val['other_scholarship']) && $val['other_scholarship'] == 1 ? '' : 'd-none' }}">
                  <label for="other_scholarship_amount" class="form-label small fw-bold">Other Scholarship Amount<span class="text-danger"> *</span></label>
                  <input type="number" id="other_scholarship_amount" name="other_scholarship_amount" class="form-control"
                    value="{{ $val['other_scholarship_amount'] ?? '' }}">
                </div>

              </div>

              <!-- ========================================================= -->
              <!-- OTHER FIELDS, GIFTED, DIGITAL ACCESS... (SIMILAR FORMAT) -->
              <!-- ========================================================= -->

              <!-- ========================================================= -->
              <!-- GIFTED / TALENTED CHILD -->
              <!-- ========================================================= -->
              <h6 class="card-header bg-heading-primary text-white py-2 mt-3">
                GIFTED / TALENTED CHILD IDENTIFICATION
              </h6>

              <div class="row">
                <div class="col-md-6">
                  <label for="child_hyperactive_disorder" class="form-label small fw-bold">
                    Whether child has been screened for Attention Deficit Hyperactive Disorder<span class="text-danger">
                      *</span>
                  </label>
                  <select id="child_hyperactive_disorder" name="child_hyperactive_disorder" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['child_hyperactive_disorder'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['child_hyperactive_disorder'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="stu_extracurricular_activity" class="form-label small fw-bold">
                    Is the student involved in any extracurricular activity? <span class="text-danger">*</span>
                  </label>
                  <select id="stu_extracurricular_activity" name="stu_extracurricular_activity" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['stu_extracurricular_activity'] ?? '' )==1 ? 'selected' : '' }}>YES
                    </option>
                    <option value="2" {{ ($val['stu_extracurricular_activity'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>
              </div>

              {{-- Gifted fields (auto show if extracurricular = YES) --}}
              <div class="row mt-3 {{ ($val['stu_extracurricular_activity'] ?? '') == 1 ? '' : 'd-none' }}"
                id="gifted_section">

                <div class="col-md-4">
                  <label for="gifted_math" class="form-label small fw-bold">Mathematics<span class="text-danger"> *</span></label>
                  <select id="gifted_math" name="gifted_math" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['gifted_math'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['gifted_math'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="gifted_language" class="form-label small fw-bold">Language<span class="text-danger"> *</span></label>
                  <select id="gifted_language" name="gifted_language" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['gifted_language'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['gifted_language'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="gifted_science" class="form-label small fw-bold">Science<span class="text-danger"> *</span></label>
                  <select id="gifted_science" name="gifted_science" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['gifted_science'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['gifted_science'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                <div class="col-md-4 mt-3">
                  <label for="gifted_technical" class="form-label small fw-bold">Technical<span class="text-danger"> *</span></label>
                  <select id="gifted_technical" name="gifted_technical" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['gifted_technical'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['gifted_technical'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                <div class="col-md-4 mt-3">
                  <label for="gifted_sports" class="form-label small fw-bold">Sports<span class="text-danger"> *</span></label>
                  <select id="gifted_sports" name="gifted_sports" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['gifted_sports'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['gifted_sports'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                <div class="col-md-4 mt-3">
                  <label for="gifted_art" class="form-label small fw-bold">Art<span class="text-danger"> *</span></label>
                  <select id="gifted_art" name="gifted_art" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['gifted_art'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['gifted_art'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

              </div>
              <!-- ========================================================= -->
              <!-- OTHER DETAILS -->
              <!-- ========================================================= -->
              <h6 class="card-header bg-heading-primary text-white py-2 mt-3">OTHER DETAILS</h6>

              <div class="row mt-3">

                {{-- PROVIDED MENTORS --}}
                <div class="col-md-6">
                  <label for="provided_mentors" class="form-label small fw-bold">Whether provided mentors<span class="text-danger"> *</span></label>
                  <select id="provided_mentors" name="provided_mentors" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['provided_mentors'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['provided_mentors'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- Nurturance Camp Main --}}
                <div class="col-md-6">
                  <label for="whether_participated_nurturance_camp" class="form-label small fw-bold">
                    Whether participated in Nurturance Camps<span class="text-danger"> *</span>
                  </label>
                  <select id="whether_participated_nurturance_camp" name="whether_participated_nurturance_camp"
                    class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['whether_participated_nurturance_camp'] ?? '' )==1 ? 'selected' : '' }}>YES
                    </option>
                    <option value="2" {{ ($val['whether_participated_nurturance_camp'] ?? '' )==2 ? 'selected' : '' }}>NO
                    </option>
                  </select>
                </div>

                {{-- State Nurturance --}}
                <div class="col-md-6 mt-3 {{ ($val['whether_participated_nurturance_camp'] ?? '') == 2 ? '' : 'd-none' }}"
                  id="state_nurturance_div">
                  <label for="state_nurturance" class="form-label small fw-bold">State Level<span class="text-danger"> *</span></label>
                  <select id="state_nurturance" name="state_nurturance" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['state_nurturance'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['state_nurturance'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- National Nurturance --}}
                <div class="col-md-6 mt-3 {{ ($val['whether_participated_nurturance_camp'] ?? '') == 2 ? '' : 'd-none' }}"
                  id="national_nurturance_div">
                  <label for="national_nurturance" class="form-label small fw-bold">National Level<span class="text-danger"> *</span></label>
                  <select id="national_nurturance" name="national_nurturance" class="form-select">
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['national_nurturance'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['national_nurturance'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- COMPETITIONS --}}
                <div class="col-md-6 mt-3">
                  <label for="participated_competitions" class="form-label small fw-bold">
                    Has the student appeared in competitions?<span class="text-danger"> *</span>
                  </label>
                  <select id="participated_competitions" name="participated_competitions" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['participated_competitions'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['participated_competitions'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- NCC / NSS --}}
                <div class="col-md-6 mt-3">
                  <label for="ncc_nss_guides" class="form-label small fw-bold">Participated in NCC/NSS/Guides?<span class="text-danger"> *</span></label>
                  <select id="ncc_nss_guides" name="ncc_nss_guides" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['ncc_nss_guides'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['ncc_nss_guides'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- RTE FREE EDUCATION --}}
                <div class="col-md-6 mt-3">
                  <label for="rte_free_education" class="form-label small fw-bold">Free education as per RTE Act?<span class="text-danger"> *</span></label>
                  <select id="rte_free_education" name="rte_free_education" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['rte_free_education'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['rte_free_education'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                {{-- HOMELESS --}}
                <div class="col-md-6 mt-3">
                  <label for="homeless" class="form-label small fw-bold">Whether child is Homeless?<span class="text-danger"> *</span></label>
                  <select id="homeless" name="homeless" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="999" {{ ($val['homeless'] ?? '' )==999 ? 'selected' : '' }}>NOT APPLICABLE</option>
                    <option value="1" {{ ($val['homeless'] ?? '' )==1 ? 'selected' : '' }}>
                      HOMELESS WITH PARENT/GUARDIAN
                    </option>
                    <option value="2" {{ ($val['homeless'] ?? '' )==2 ? 'selected' : '' }}>
                      HOMELESS WITHOUT ADULT PROTECTION
                    </option>
                  </select>
                </div>

                {{-- SPECIAL TRAINING --}}
                <div class="col-md-6 mt-3">
                  <label for="special_training" class="form-label small fw-bold">Special Training Provided?<span class="text-danger"> *</span></label>
                  <select id="special_training" name="special_training" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['special_training'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['special_training'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>
                <div class="col-md-6 mt-3">
                  <label for="able_to_handle_devices" class="form-label small fw-bold">
                    Capable of handling digital devices?<span class="text-danger"> *</span>
                  </label>
                  <select id="able_to_handle_devices" name="able_to_handle_devices" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['able_to_handle_devices'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['able_to_handle_devices'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

                <div class="col-md-6 mt-3">
                  <label for="internet_access" class="form-label small fw-bold">
                    Whether child has access to Internet?<span class="text-danger"> *</span>
                  </label>
                  <select id="internet_access" name="internet_access" class="form-select" required>
                    <option value="">-Select-</option>
                    <option value="1" {{ ($val['internet_access'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                    <option value="2" {{ ($val['internet_access'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                  </select>
                </div>

              </div>



              <!-- Buttons -->
              <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" 
                      type="button" 
                      data-bs-toggle="tab"
                      data-bs-target="#enrollment_details">
                  Previous
              </button>


                <button class="btn btn-success" type="button" id="save_facility_and_other_dtls">Save & Next</button>
              </div>

            </form>
          </div>