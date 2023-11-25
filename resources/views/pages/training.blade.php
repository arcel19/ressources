<base href="/">
<x-layout>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Training</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Training</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_designation"><i
                        class="fa fa-plus"></i> Add Training</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table-striped custom-table datatable mb-0 table">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Employee</th>

                            <th>school Name </th>
                            <th>Training Type </th>
                            <th>Completed</th>

                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training as $nat)
                            <tr>

                                <td>{{ $nat->id }}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="profile.html" class="avatar"><img alt=""
                                                src="{{ '/storage/' . \App\Models\Soldier::where('id', $nat->soldier_id)->first()->photo }}"></a>
                                        <a href="#">{{ \App\Models\Soldier::where('id', $nat->soldier_id)->first()->name }}
                                            <span>{{ \App\Models\Soldier::where('id', $nat->soldier_id)->first()->rank }}</span></a>
                                    </h2>
                                </td>
                                <td>{{ $nat->schoolName }}</td>
                                <td>{{ $nat->trainingType }}</td>
                                <td>
                                    @if ($nat->schoolCompleted === 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>


                               


                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit_designation{{ $nat->id }}"><i
                                                    class="fa fa-pencil m-r-5"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_designation{{ $nat->id }}"><i
                                                    class="fa fa-trash-o m-r-5"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Designation Modal -->
                            <div id="edit_designation{{ $nat->id }}" class="modal custom-modal fade"
                                role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit training</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="trainingForm2" action="{{ route('training.update', $nat->id) }}"
                                                method="POST">
                                                @method('put')
                                                @csrf
                                                <label>Select training type : <span
                                                        class="text-danger">*{{ $nat->trainingType }}</span></label>

                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="trainingType"
                                                        value="basicSchool">
                                                    <label class="form-check-label">Basic School</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="trainingType"
                                                        value="specialtySchool">
                                                    <label class="form-check-label">Specialty School</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="trainingType"
                                                        value="other">
                                                    <label class="form-check-label">Other</label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="schoolName">School Name:</label>
                                                    <input class="form-control" type="text" id="schoolName"
                                                        name="schoolName" value="{{ $nat->schoolName }}">
                                                    @error('schoolName')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="schoolName">School Year:</label>
                                                    <input class="form-control" type="date" id="schoolYear"
                                                        name="schoolYear" value="{{ $nat->schoolYear }}">
                                                    @error('schoolYear')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="schoolCompleted" name="schoolCompleted"
                                                        value="{{ $nat->schoolCompleted }}">
                                                        <label for="schoolName">: completed </label>
                                                    @error('schoolCompleted')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror


                                                </div>


                                                <div class="submit-section">
                                                    <button type="submit"
                                                        class="btn btn-primary submit-btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /Edit Designation Modal -->

                            <!-- Delete Designation Modal -->
                            <div class="modal custom-modal fade" id="delete_designation{{ $nat->id }}"
                                role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete training</h3>
                                                <p>Are you sure want to delete?</p>
                                            </div>
                                            <form action="{{ route('training.destroy', $nat->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
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
                            <!-- /Delete Designation Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Designation Modal -->
    <div id="add_designation" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="trainingForm" action="{{ route('training.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Select a soldier <span class="text-danger">*</span></label>
                            <select class="select" name="id">
                                @foreach (\App\Models\Soldier::all() as $army)
                                    <option value="{{ $army->id }}">{{ $army->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <label>Select training type <span class="text-danger">*</span></label>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="trainingType" value="basicSchool">
                            <label class="form-check-label">Basic School</label>

                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="trainingType"
                                value="specialtySchool">
                            <label class="form-check-label">Specialty School</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="trainingType" value="other">
                            <label class="form-check-label">Other</label>
                        </div>
                        @error('trainingType')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror

                        <div id="dynamicFields" class="mt-3"></div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Designation Modal -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="trainingType"]').change(function() {
                updateFormFields($(this).val());
            });

            function updateFormFields(trainingType) {
                var dynamicFields = $('#dynamicFields');
                dynamicFields.empty();

                if (trainingType === 'basicSchool' || trainingType === 'specialtySchool' || trainingType ===
                    'other') {
                    dynamicFields.append('<label for="schoolName">School Name:</label>');
                    dynamicFields.append(
                        '<input class="form-control" type="text" id="schoolName" name="schoolName">');

                    dynamicFields.append('<label for="schoolYear">School Year:</label>');
                    dynamicFields.append(
                        '<input class="form-control" type="date" id="schoolYear" name="schoolYear">');

                    dynamicFields.append('<div class="form-check">');
                    dynamicFields.append(
                        '<input  type="checkbox" class="form-check-input " id="schoolCompleted" name="schoolCompleted">'
                    );
                    dynamicFields.append('<label class="form-check-label" for="schoolCompleted">Completed</label>');
                    dynamicFields.append('</div>');
                }
            }


        });
    </script>



</x-layout>
