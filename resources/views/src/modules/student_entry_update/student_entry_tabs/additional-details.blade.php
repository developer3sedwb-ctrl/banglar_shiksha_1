  <!-- TAB 7: Additional Details  -- SUBHAJIT DAS-- -->
          <div class="tab-pane fade" id="additional_dtls_tab" role="tabpanel" aria-labelledby="additional_dtls">
            <form id="bank_details_of_student" method="POST" action="{{ route('student.bank_details_of_student') }}" novalidate>
                @csrf

                <h6 class="card-header bg-heading-primary text-white py-2">
                    Additional Details
                </h6>
                <div class="row">
                    <!-- LEFT COLUMN -->
                    <div class="col-md-6">
                        <!-- Bank Name -->
                          <div class="mb-3">
                            <label class="form-label small">Add Info</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <select name="bank_name" id="bank_name" class="form-select select2">
                                    <option value="">-Please Select-</option>
                                    @foreach($bank_code_name_master ?? [] as $val => $label)
                                      <option value="{{ $val }}"
                                          {{ ($student_bank['bank_id_fk'] ?? '') == $val ? 'selected' : '' }}>
                                          {{ $label }}
                                      </option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="form-actions text-end mt-3">
                    <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab5" type="button">
                        Previous
                    </button>

                    <button class="btn btn-success" type="submit">
                    Save as Dreaft
                    </button>

                    <button class="btn btn-success" type="button" id="previewBtn">
                    Preview & Submit
                    </button>
                </div>
            </form>
          </div>


        <div class="modal fade" id="previewModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                    <button type="button" id="student_form_preview" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Whatever you want to preview -->
                    <p>This is your preview content.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Final Submit</button>
                </div>

                </div>
            </div>
        </div>

    <script>

    document.getElementById('previewBtn').addEventListener('click', function () {
        let modal = new bootstrap.Modal(document.getElementById('previewModal'));
        modal.show();
    });
    </script>


