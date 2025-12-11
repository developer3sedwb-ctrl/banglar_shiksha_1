   <!-- ======= TAB 5: Contact Info -- SUBHAJIT DAS--================= -->
          <div class="tab-pane fade" id="contact_info_tab" role="tabpanel"    aria-labelledby="contact_info_tab-tab">
              <form id="contact_info_of_student_and_guardian" method="POST" action="{{ route('student.store_student_entry_contact_details') }}" novalidate>
              @csrf
              
              <h6 class=" card-header bg-heading-primary text-white py-2">
                CONTACT INFORMATION FOR STUDENT
              </h6> 
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3" id="student_country_section">
                    <label class="form-label small">Select Country</label>
                    <select name="student_country" id= "student_country" class="form-select">
                          <option value="">-Please Select-</option>
                            @foreach($bs_country_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['stu_country_code'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                      </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Address</label>
                    <input name="student_address" type="text" class="form-control" placeholder="Enter Address"   value="{{ old('stu_contact_address', $student_contact_info['stu_contact_address'] ?? '') }}">
                  </div>

                
                  <div class="mb-3" id="student_district_section">
                    <label class="form-label small">District</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="student_district" id= "student_district"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                           @foreach($district_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['stu_contact_district'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Panchayat</label>
                    <input name="student_panchayat" type="text" class="form-control" placeholder="Enter Panchayat / Ward"   value="{{ old('stu_contact_panchayat', $student_contact_info['stu_contact_panchayat'] ?? '') }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Police Station</label>
                    <input name="student_police_station" type="text" class="form-control" placeholder="Enter Plice Station"   value="{{ old('stu_police_station', $student_contact_info['stu_police_station'] ?? '') }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Mobile Number (Student / Parent / Guardian)</label>
                  <input name="student_mobile"
                    type="text"
                    maxlength="10"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Mobile number"
                     value="{{ old('stu_mobile_no', $student_contact_info['stu_mobile_no'] ?? '') }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3" id="student_state_section">
                    <label class="form-label small">State</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="student_state" id= "student_state"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($state_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['stu_state_code'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div> 


                  <div class="mb-3">
                    <label class="form-label small">Habitation / Locality</label>
                    <input name="student_locality" type="text" class="form-control" placeholder="Habitation / Locality"  value="{{ old('stu_contact_habitation', $student_contact_info['stu_contact_habitation'] ?? '') }}">
                  </div>

                  <div class="mb-3" id="student_block_section">
                    <label class="form-label small">Block / Municipality</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="student_block" id= "student_block"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($block_munc_corp_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['stu_contact_block'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Post Office</label>
                    <input name="student_post_office" type="text" class="form-control" placeholder="Post office" value="{{ old('stu_post_office', $student_contact_info['stu_post_office'] ?? '') }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Pin Code</label>
                    <input name="student_pincode"
                    type="text"
                    maxlength="6"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Pin Code"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required
                    value="{{ old('stu_pin_code', $student_contact_info['stu_pin_code'] ?? '') }}"
                    >
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Contact email id (Student/Parent/Guardian)</label>
                    <input name="student_email" type="email" class="form-control" placeholder="Email" value="{{ old('stu_email', $student_contact_info['stu_email'] ?? '') }}">
                  </div>
                </div>
              </div>

              <hr class="my-3">

              <h6 class=" card-header bg-heading-primary text-white py-2">
                CONTACT INFORMATION FOR GUARDIAN
              </h6> 
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="same-as-student" />
                <label class="form-check-label small" for="same-as-student">Same as Student Address</label>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3" id="guardian_country_section">
                    <label class="form-label small">Select Country</label>
                    <select name="guardian_country" id= "guardian_country" class="form-select">
                          <option value="">-Please Select-</option>
                         @foreach($bs_country_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['guardian_country_code'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Address</label>
                    <input name="guardian_address" type="text" class="form-control" placeholder="Guardian address" value="{{ old('guardian_contact_address', $student_contact_info['guardian_contact_address'] ?? '') }}"> 
                  </div>

                


                  <div class="mb-3" id="guardian_district_section">
                    <label class="form-label small">District</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="guardian_district" id= "guardian_district"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($district_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['guardian_contact_district'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Panchayat</label>
                    <input name="guardian_panchayat" type="text" class="form-control" placeholder="Panchayat / Ward" value="{{ old('guardian_contact_panchayat', $student_contact_info['guardian_contact_panchayat'] ?? '') }}" >
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Police Station</label>
                    <input name="guardian_police_station" type="text" class="form-control" placeholder="Police station"  value="{{ old('guardian_police_station', $student_contact_info['guardian_police_station'] ?? '') }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Mobile Number (Guardian)</label>
                    <input name="guardian_mobile"
                    type="text"
                    maxlength="10"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Mobile number"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required
                    value="{{ old('guardian_mobile_no', $student_contact_info['guardian_mobile_no'] ?? '') }}"
                    >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3" id="guardian_state_section">
                    <label class="form-label small">State</label>
                      <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                        <select name="guardian_state" id= "guardian_state"  class="select2  form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($state_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['guardian_state_code'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Habitation / Locality</label>
                    <input name="guardian_locality" type="text" class="form-control" placeholder="Habitation / Locality" value="{{ old('guardian_contact_habitation', $student_contact_info['guardian_contact_habitation'] ?? '') }}">
                  </div>

                  <div class="mb-3" id="guardian_block_section">
                    <label class="form-label small">Block / Municipality</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="guardian_block" id= "guardian_block" class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($block_munc_corp_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($student_contact_info['guardian_contact_block'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div> 
                  
                  <div class="mb-3">
                    <label class="form-label small">Post Office</label>
                    <input name="guardian_post_office" type="text" class="form-control" placeholder="Post office" value="{{ old('guardian_post_office', $student_contact_info['guardian_post_office'] ?? '') }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Pin Code</label>
                    <input name="guardian_pincode"
                    type="text"
                    maxlength="6"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Pin Code"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required
                    value="{{ old('guardian_pin_code', $student_contact_info['guardian_pin_code'] ?? '') }}"
                    >
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Contact email id (Guardian)</label>
                    <input name="guardian_email" type="email" class="form-control" placeholder="Email" value="{{ old('guardian_email', $student_contact_info['guardian_email'] ?? '') }}">
                  </div>
                </div>
              </div>

              <div class="form-actions text-end mt-3">
                <button class="btn btn-secondary me-2" data-bs-toggle="tab" type="button">Previous</button>
                <button id="contact_info_save_btn" class="btn btn-success" type="button">Next</button>
              </div>
            </form>
          </div>