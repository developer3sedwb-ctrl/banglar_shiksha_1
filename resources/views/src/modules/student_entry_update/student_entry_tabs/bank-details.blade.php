<!-- TAB 6: BANK DETAILS & UPLOAD  -- SUBHAJIT DAS-- -->
  <div class="tab-pane fade" id="bank_dtls_tab" role="tabpanel" aria-labelledby="bank_dtls-tab">
    <form id="bank_details_of_student" method="POST" action="{{ route('student.bank_details_of_student') }}" novalidate>
        @csrf

        <h6 class="card-header bg-heading-primary text-white py-2">
            BANK DETAILS
        </h6>

        <div class="row">

            <!-- LEFT COLUMN -->
            <div class="col-md-6">

                <!-- Bank Name -->
                <div class="mb-3">
                    <label class="form-label small">Bank Name</label>
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

                <!-- Branch Name -->
                <div class="mb-3">
                    <label class="form-label small">Branch Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                        <select name="branch_name" id="branch_name" class="form-select select2">
                          <option value="">-Please Select-</option>
                        @foreach($bank_branch_master ?? [] as $val => $label)
                          <option value="{{ $val }}"
                              {{ ($student_bank['branch_id_fk'] ?? '') == $val ? 'selected' : '' }}>
                              {{ $label }}
                          </option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <!-- IFSC -->
                <div class="mb-3">
                    <label class="form-label small">IFSC</label>
                    <input name="ifsc" id="ifsc" type="text" class="form-control" placeholder="IFSC code" value="{{ old('bank_ifsc', $student_bank['bank_ifsc'] ?? '') }}">
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-md-6">

                <!-- Account Number -->
                <div class="mb-3">
                    <label class="form-label small">Account Number</label>
                    <input name="account_number" type="text" class="form-control" placeholder="Account number" value="{{ old('stu_bank_acc_no', $student_bank['stu_bank_acc_no'] ?? '') }}">
                </div>


                <!-- Confirm Account Number -->
                <div class="mb-3">
                    <label class="form-label small">Confirm Account Number</label>
                    <input name="confirm_account_number" type="text" class="form-control" placeholder="Re-enter account number" value="{{ old('stu_bank_acc_no', $student_bank['stu_bank_acc_no'] ?? '') }}">
                </div>

            </div>
        </div>

        <div class="form-actions text-end mt-3">
            <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab5" type="button">
                Previous
            </button>

            <button class="btn btn-success" type="submit">
                Next
            </button>
        </div>

    </form>
  </div>

  <script>
    $(document).ready(function () {

        $('.select2').select2();

        // ================= Fetch Branches =================
        $('#bank_name').on('change', function () {
            let bankId = $(this).val();

            $('#branch_name').html('<option value="">-Please Select-</option>');
            $('#ifsc').val('');

            if (bankId) {
                $.ajax({
                    url: "{{ url('hoi/get-branches') }}",
                    type: "GET",
                    data: { bank_id: bankId },
                    success: function (response) {
                        if (response.branches && response.branches.length) {
                            $.each(response.branches, function (i, branch) {
                                $('#branch_name').append(
                                    `<option value="${branch.id}">${branch.name}</option>`
                                );
                            });
                        }
                    }
                });
            }
        });

      // ================= Fetch IFSC =================
      $('#branch_name').on('change', function () {
          let branchId = $(this).val();
          $('#ifsc').val('');

          if (branchId) {
              $.ajax({
                  url: "{{ url('hoi/get-ifsc') }}",
                  type: "GET",
                  data: { branch_id: branchId },
                  success: function (response) {
                      if (response.ifsc) {
                          $('#ifsc').val(response.ifsc);
                      }
                  }
              });
          }
      });

    });
  </script>
