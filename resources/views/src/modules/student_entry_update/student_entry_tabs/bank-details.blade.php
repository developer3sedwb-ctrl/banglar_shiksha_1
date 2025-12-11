
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

            $(function () {
  // when bank changes -> request branches
  $('#bank_name').on('change', function () {
    var bankId = $(this).val();
    $('#ifsc').val('');
    $('#branch_name').html('<option value="">Loading...</option>');

    if (!bankId) {
      $('#branch_name').html('<option value="">-Please Select-</option>');
      return;
    }

    $.ajax({
      url: '/get-branches',
      type: 'GET',
      data: { bank_id: bankId },
      success: function (res) {
        // res may be { branches: [...] } or [...] — normalize to an array
        var branches = [];
        if (Array.isArray(res)) {
          branches = res;
        } else if (res && Array.isArray(res.branches)) {
          branches = res.branches;
        } else if (res && res.data && Array.isArray(res.data)) {
          // in case of resource-wrapped response
          branches = res.data;
        }

        $('#branch_name').empty().append('<option value="">-Please Select-</option>');

        if (!branches.length) {
          $('#branch_name').append('<option value="">No branches found</option>');
          return;
        }

        // branches expected format: [{id, name, branch_ifsc}, ...] or [{id, name}]
        branches.forEach(function (b) {
          var id = (b.id !== undefined) ? b.id : '';
          var name = (b.name !== undefined) ? b.name : (b.branch_name || '');
          var ifsc = (b.branch_ifsc !== undefined) ? String(b.branch_ifsc).trim() : '';
          // Make sure id is used as option value
          $('#branch_name').append(
            '<option value="' + id + '" data-ifsc="' + ifsc + '">' + name + '</option>'
          );
        });

        // optional: if only one real branch, auto-select it
        var realOpts = $('#branch_name').find('option').filter(function () {
          return $(this).val() !== '';
        });
        if (realOpts.length === 1) {
          $('#branch_name').val(realOpts.val()).trigger('change');
        }
      },
      error: function (xhr, status, err) {
        console.error('Failed to load branches', status, err);
        $('#branch_name').html('<option value="">Error loading</option>');
      }
    });
  });

  // when branch selected -> fill IFSC (fast path from data-ifsc)
  $('#branch_name').on('change', function () {
    var raw = $(this).val();

    // fast path: read data-ifsc from selected option (no AJAX)
    var ifscFromData = $(this).find('option:selected').data('ifsc');
    if (ifscFromData) {
      $('#ifsc').val(String(ifscFromData).trim());
      return;
    }

    // validate branch id before sending to server
    if (!raw || raw === '' || isNaN(parseInt(raw, 10))) {
      console.warn('Invalid branch id selected:', raw);
      $('#ifsc').val('');
      return;
    }

    var branchId = parseInt(raw, 10);
    $('#ifsc').val('Loading...');

    $.ajax({
      url: '/get-ifsc',
      type: 'GET',
      data: { branch_id: branchId },
      success: function (res) {
        // res expected { ifsc: '...' }
        var ifsc = (res && (res.ifsc !== undefined)) ? res.ifsc : (res.branch_ifsc || '');
        $('#ifsc').val(ifsc ? String(ifsc).trim() : '');
      },
      error: function () {
        $('#ifsc').val('');
      }
    });
  });
});
          </script>