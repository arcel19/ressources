<x-layout>
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Leaves</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leaves</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i
                            class="fa fa-plus"></i> Add Leave</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Leave Statistics -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Today Presents</h6>
                    <h4>{{ \App\Models\Soldier::whereHas('leaves')->count() }} / {{ \App\Models\Soldier::count() }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Planned Leaves</h6>
                    <h4>{{ \App\Models\Leave::count() }} <span>Today</span></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Approved Leaves</h6>
                    <h4>{{ \App\Models\Leave::where('status', 'approved')->count() }} <span>Today</span></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Declined Requests</h6>
                    <h4>{{ \App\Models\Leave::where('status', 'declined')->count() }}</h4>
                </div>
            </div>
        </div>
        <!-- /Leave Statistics -->

        <!-- Search Filter -->
        <form action="{{ route('leave.index') }}">
            @csrf
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="search">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" name="search1">
                            <option> -- Select -- </option>
                            <option>Casual Leave</option>
                            <option>Medical Leave</option>
                            <option>Loss of Pay</option>
                        </select>
                        <label class="focus-label">Leave Type</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" name="search2">
                            <option> -- Select -- </option>
                            <option value="approved"> approved </option>
                            <option value="declined"> declined </option>
                        </select>
                        <label class="focus-label">Leave Status</label>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <button type="submit" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>
        <!-- /Search Filter -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table-striped custom-table datatable mb-0 table">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>No of Days</th>
                                <th>Reason</th>
                                <th class="text-center">Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave as $l)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="profile.html" class="avatar"><img alt=""
                                                    src="{{ '/storage/' . \App\Models\Soldier::where('id', $l->soldier_id)->first()->photo }}"></a>
                                            <a href="#">{{ \App\Models\Soldier::where('id', $l->soldier_id)->first()->name }}
                                                <span>{{ \App\Models\Soldier::where('id', $l->soldier_id)->first()->rank }}</span></a>
                                        </h2>
                                    </td>
                                    <td>{{ $l->type }}</td>
                                    <td>{{ $l->from }}</td>
                                    <td>{{ $l->to }}</td>
                                    <td>{{ $l->number_of_days }}</td>
                                    <td>{{ $l->reason }}</td>
                                    <td class="text-center">
                                        <div class="dropdown action-label">
                                            @if ($l->status === 'declined')
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                    href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o text-danger"></i> Declined
                                                </a>
                                            @elseif($l->status === 'approved')
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                    href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o text-success"></i> Approved
                                                </a>
                                            @endif

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fa fa-dot-circle-o text-danger"></i> Declined</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#approve_leave{{ $l->id }}"><i
                                                        class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit_leave{{ $l->id }}"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete_approve{{ $l->id }}"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Edit Leave Modal -->
                                <div id="edit_leave{{ $l->id }}" class="modal custom-modal fade"
                                    role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Leave</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('leave.update', $l->id) }}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Leave Type <span class="text-danger">*</span></label>
                                                        <select class="select" name="type">
                                                            <option>Select Leave Type</option>
                                                            <option>Casual Leave 12 Days</option>
                                                            <option>Medical Leave</option>
                                                            <option>Loss of Pay</option>
                                                        </select>
                                                        @error('type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>From <span class="text-danger">*</span></label>
                                                        <div class="cal-icon">
                                                            <input class="form-control datetimepicker"
                                                                value="{{ $l->from }}" type="text"
                                                                name="from">
                                                        </div>
                                                        @error('from')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>To <span class="text-danger">*</span></label>
                                                        <div class="cal-icon">
                                                            <input class="form-control datetimepicker"
                                                                value="{{ $l->to }}" type="text"
                                                                name="to">
                                                        </div>
                                                        @error('to')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Number of days <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" readonly type="text"
                                                            name="number_of_days" value="{{ $l->number_of_days }}">
                                                        @error('number_of_days')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Remaining Leaves <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" readonly
                                                            value="{{ $l->remaining_leave }}" type="text"
                                                            name="remaining_leave">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Leave Reason <span class="text-danger">*</span></label>
                                                        <textarea rows="4" class="form-control" name="reason">{{ $l->reason }}</textarea>
                                                    </div>
                                                    <div class="submit-section">
                                                        <button class="btn btn-primary submit-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Edit Leave Modal -->

                                <!-- Approve Leave Modal -->
                                <div class="modal custom-modal fade" id="approve_leave{{ $l->id }}"
                                    role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-header">
                                                    <h3>Leave Approve</h3>
                                                    <p>Are you sure want to approve for this leave?</p>
                                                </div>
                                                <div class="modal-btn delete-action">
                                                    <div class="row">
                                                        <form action="{{ route('approved', $l->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="col-6">
                                                                <button type="submit"
                                                                    class="btn btn-primary continue-btn">Approve</button>
                                                            </div>
                                                        </form>
                                                        <div class="col-6">
                                                            <a href="javascript:void(0);" data-dismiss="modal"
                                                                class="btn btn-primary cancel-btn">Decline</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Approve Leave Modal -->

                                <!-- Delete Leave Modal -->
                                <div class="modal custom-modal fade" id="delete_approve{{ $l->id }}"
                                    role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-header">
                                                    <h3>Delete Leave</h3>
                                                    <p>Are you sure want to delete this leave?</p>
                                                </div>
                                                <form action="{{ route('leave.destroy', $l->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-btn delete-action">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button
                                                                    class="btn btn-primary continue-btn">Delete</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="javascript:void(0);" data-dismiss="modal"
                                                                    class="btn btn-primary cancel-btn">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Delete Leave Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Leave Modal -->
    <div id="add_leave" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leave.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Select a soldier <span class="text-danger">*</span></label>
                            <select class="select" name="id">
                                @foreach (\App\Models\Soldier::all() as $army)
                                    <option value="{{ $army->id }}">{{ $army->name }}</option>
                                @endforeach
                                @error('id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <select class="select" name="type">
                                <option>Select Leave Type</option>
                                <option>Casual Leave 12 Days</option>
                                <option>Medical Leave</option>
                                <option>Loss of Pay</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>From <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text" name="from"
                                    value="{{ old('from') }}">
                                @error('from')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>To <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text" name="to"
                                    value="{{ old('to') }}">
                                @error('to')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Remaining Leaves <span class="text-danger">*</span></label>
                            <input class="form-control" readonly value="12" type="text"
                                name="remaining_leave" value="{{ old('remaining_leave') }}">
                            @error('remaining_leave')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Leave Reason <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" name="reason" value="{{ old('reason') }}"></textarea>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Leave Modal -->


</x-layout>
