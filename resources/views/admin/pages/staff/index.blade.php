@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'staff';
        $sub = 'index';
    @endphp
@endsection

@section('js-other')
    <script>
      var usersData = @json($users);
      console.log(usersData);
      
    </script>
    <!-- Page JS -->
    <script src="{{ asset('webhtml/assets/js/tables-datatables-basic.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <!-- Form Validation -->
    <script src="{{asset('webhtml/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
  <script src="{{asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
  <script src="{{asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">DataTables /</span> Basic</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd">
                        <td class="control" tabindex="0" style=""></td>
                        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2"><span
                                            class="avatar-initial rounded-circle bg-label-success">GG</span></div>
                                </div>
                                <div class="d-flex flex-column"><span class="emp_name text-truncate">Glyn
                                        Giacoppo</span><small class="emp_post text-truncate text-muted">Hahaha</small></div>
                            </div>
                        </td>
                        <td>ggiacoppo2r@apache.org</td>
                        <td>04/15/2021</td>
                        <td>$24973.48</td>
                        <td><span class="badge  bg-label-success">Professional</span></td>
                        <td class="dtr-hidden" style="display: none;">
                            <div class="d-inline-block"><a href="javascript:;"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                        class="text-primary ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                    </li>
                                </ul>
                            </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                    class="text-primary ti ti-pencil"></i></a>
                        </td>
                    </tr>
                    <tr class="even">
                        <td class="control" tabindex="0" style=""></td>
                        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2"><img src="webhtml/assets/img/avatars/10.png" alt="Avatar"
                                            class="rounded-circle"></div>
                                </div>
                                <div class="d-flex flex-column"><span class="emp_name text-truncate">Evangelina
                                        Carnock</span><small class="emp_post text-truncate text-muted">Cost
                                        Accountant</small></div>
                            </div>
                        </td>
                        <td>ecarnock2q@washington.edu</td>
                        <td>01/26/2021</td>
                        <td>$23704.82</td>
                        <td><span class="badge  bg-label-warning">Resigned</span></td>
                        <td class="dtr-hidden" style="display: none;">
                            <div class="d-inline-block"><a href="javascript:;"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                        class="text-primary ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                    </li>
                                </ul>
                            </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                    class="text-primary ti ti-pencil"></i></a>
                        </td>
                    </tr>
                    <tr class="odd">
                        <td class="control" tabindex="0" style=""></td>
                        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2"><img src="webhtml/assets/img/avatars/7.png" alt="Avatar"
                                            class="rounded-circle"></div>
                                </div>
                                <div class="d-flex flex-column"><span class="emp_name text-truncate">Olivette
                                        Gudgin</span><small class="emp_post text-truncate text-muted">Paralegal</small>
                                </div>
                            </div>
                        </td>
                        <td>ogudgin2p@gizmodo.com</td>
                        <td>04/09/2021</td>
                        <td>$15211.60</td>
                        <td><span class="badge  bg-label-success">Professional</span></td>
                        <td class="dtr-hidden" style="display: none;">
                            <div class="d-inline-block"><a href="javascript:;"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                        class="text-primary ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                    </li>
                                </ul>
                            </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                    class="text-primary ti ti-pencil"></i></a>
                        </td>
                    </tr>
                    <tr class="even">
                        <td class="control" tabindex="0" style=""></td>
                        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input">
                        </td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2"><span
                                            class="avatar-initial rounded-circle bg-label-info">RP</span></div>
                                </div>
                                <div class="d-flex flex-column"><span class="emp_name text-truncate">Reina
                                        Peckett</span><small class="emp_post text-truncate text-muted">Quality Control
                                        Specialist</small></div>
                            </div>
                        </td>
                        <td>rpeckett2o@timesonline.co.uk</td>
                        <td>05/20/2021</td>
                        <td>$16619.40</td>
                        <td><span class="badge  bg-label-warning">Resigned</span></td>
                        <td class="dtr-hidden" style="display: none;">
                            <div class="d-inline-block"><a href="javascript:;"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                        class="text-primary ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                    </li>
                                </ul>
                            </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                    class="text-primary ti ti-pencil"></i></a>
                        </td>
                    </tr>
                    <tr class="odd">
                        <td class="control" tabindex="0" style=""></td>
                        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input">
                        </td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2"><span
                                            class="avatar-initial rounded-circle bg-label-info">AB</span></div>
                                </div>
                                <div class="d-flex flex-column"><span class="emp_name text-truncate">Alaric
                                        Beslier</span><small class="emp_post text-truncate text-muted">Tax
                                        Accountant</small></div>
                            </div>
                        </td>
                        <td>abeslier2n@zimbio.com</td>
                        <td>04/16/2021</td>
                        <td>$19366.53</td>
                        <td><span class="badge  bg-label-warning">Resigned</span></td>
                        <td class="dtr-hidden" style="display: none;">
                            <div class="d-inline-block"><a href="javascript:;"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                        class="text-primary ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                    </li>
                                </ul>
                            </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                    class="text-primary ti ti-pencil"></i></a>
                        </td>
                    </tr>
                    <tr class="even">
                        <td class="control" tabindex="0" style=""></td>
                        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input">
                        </td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2"><img src="webhtml/assets/img/avatars/2.png" alt="Avatar"
                                            class="rounded-circle"></div>
                                </div>
                                <div class="d-flex flex-column"><span class="emp_name text-truncate">Edwina
                                        Ebsworth</span><small class="emp_post text-truncate text-muted">Human Resources
                                        Assistant</small></div>
                            </div>
                        </td>
                        <td>eebsworth2m@sbwire.com</td>
                        <td>09/27/2021</td>
                        <td>$19586.23</td>
                        <td><span class="badge bg-label-primary">Current</span></td>
                        <td class="dtr-hidden" style="display: none;">
                            <div class="d-inline-block"><a href="javascript:;"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                        class="text-primary ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                    </li>
                                </ul>
                            </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                    class="text-primary ti ti-pencil"></i></a>
                        </td>
                    </tr>
                    <tr class="odd">
                        <td class="control" tabindex="0" style=""></td>
                        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input">
                        </td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2"><span
                                            class="avatar-initial rounded-circle bg-label-primary">RH</span></div>
                                </div>
                                <div class="d-flex flex-column"><span class="emp_name text-truncate">Ronica
                                        Hasted</span><small class="emp_post text-truncate text-muted">Software
                                        Consultant</small></div>
                            </div>
                        </td>
                        <td>rhasted2l@hexun.com</td>
                        <td>07/04/2021</td>
                        <td>$24866.66</td>
                        <td><span class="badge  bg-label-warning">Resigned</span></td>
                        <td class="dtr-hidden" style="display: none;">
                            <div class="d-inline-block"><a href="javascript:;"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                        class="text-primary ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                    </li>
                                </ul>
                            </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i
                                    class="text-primary ti ti-pencil"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
                <div class="col-sm-12">
                    <label class="form-label" for="basicFullname">Full Name</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="basicFullname" class="form-control dt-full-name" name="basicFullname"
                            placeholder="John Doe" aria-label="John Doe" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="basicPost">Post</label>
                    <div class="input-group input-group-merge">
                        <span id="basicPost2" class="input-group-text"><i class="ti ti-briefcase"></i></span>
                        <input type="text" id="basicPost" name="basicPost" class="form-control dt-post"
                            placeholder="Web Developer" aria-label="Web Developer" aria-describedby="basicPost2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="basicEmail">Email</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                        <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                            placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                    </div>
                    <div class="form-text">You can use letters, numbers & periods</div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="basicDate">Joining Date</label>
                    <div class="input-group input-group-merge">
                        <span id="basicDate2" class="input-group-text"><i class="ti ti-calendar"></i></span>
                        <input type="text" class="form-control dt-date" id="basicDate" name="basicDate"
                            aria-describedby="basicDate2" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="basicSalary">Salary</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary"
                            placeholder="12000" aria-label="12000" aria-describedby="basicSalary2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!--/ DataTable with Buttons -->

    <hr class="my-5" />
@endsection
