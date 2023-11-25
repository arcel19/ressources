<x-layout>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Employee</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Employee</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i
                        class="fa fa-plus"></i> Add Employee</a>
                <div class="view-icons">
                    <a href="employees.html" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                    <a href="employees-list.html" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Header -->

    <!-- Search Filter -->
    <form action="{{ route('soldier.index') }}">
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" name="search1">
                    <label class="focus-label">Soldier Matricular ID</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" name="search">
                    <label class="focus-label">Soldier Name</label>
                </div>
            </div>
            {{-- <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus" >
                    <select class="select floating" name="search2">
                        <option disabled>Select Position</option>
                        <option value="Officer">Officer</option>
                        <option value="Non-officer">Non Officer</option>
                    </select>
                    <label class="focus-label">Position</label>
                </div>
            </div> --}}
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
    </form>
    <!-- /Search Filter -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table-striped custom-table datatable table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Matricular ID</th>
                            <th>UNIT/Company</th>
                            <th>Sprecialization</th>
                            <th class="text-nowrap"> Date Of Birth</th>
                            <th>Position</th>
                            <th class="no-sort text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($soldier as $sol)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="{{ route('soldier.show', $sol->id) }}" class="avatar"><img
                                                alt="" src="{{ '/storage/' . $sol->photo }}"></a>
                                        <a href="{{ route('soldier.show', $sol->id) }}">{{ $sol->name }}
                                            <span>{{ $sol->position }}</span></a>
                                    </h2>
                                </td>
                                <td>{{ $sol->matricular }}</td>
                                <td>company</td>
                                <td>{{ $sol->specialization }}</td>
                                <td>{{ $sol->date_of_birth }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">{{ $sol->rank }} </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">{{ $sol->position }}</a>

                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit_employee{{ $sol->id }}"><i
                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_employee{{ $sol->id }}"><i
                                                    class="fa fa-trash-o m-r-5"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <!-- Edit Employee Modal -->
                            <div id="edit_employee{{ $sol->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Employee: {{ $sol->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('soldier.update', $sol->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="profile-img-wrap edit-img">
                                                    <img class="inline-block" src="{{ '/storage/' . $sol->photo }}"
                                                        alt="user">
                                                    <div class="fileupload btn">
                                                        <span class="btn-text">edit Passport
                                                            photo</span>
                                                        <input class="upload" type="file" name="photo">
                                                    </div>
                                                </div>
                                                <div class="container mt-5">
                                                    <!-- Radio Buttons -->
                                                    <div class="form-group">
                                                        <label>Rank: <span
                                                                class="text-danger">{{ $sol->position }}</span>
                                                        </label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="position" id="officer" value="officer"
                                                                checked>
                                                            <label class="form-check-label"
                                                                for="officer">Officer</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="position" id="nonOfficer" value="non-officer">
                                                            <label class="form-check-label"
                                                                for="nonOfficer">Non-Officer</label>
                                                        </div>
                                                    </div>
                                                    <!-- Dropdowns -->
                                                    <div class="form-group">
                                                        <label for="rankDetails">Rank Details: <span
                                                                class="text-danger">
                                                                {{ $sol->rank }}</span></label>
                                                        <!-- Dropdown for Officer -->
                                                        <select class="form-control form-select-sm form-select mt-2"
                                                            id="officerDropdown" name="rank">

                                                            <option disabled class="text-danger">Select Non-Officer
                                                                Rank</option>
                                                            <option>2nd Class PVT</option>
                                                            <option>1st Class PVT</option>
                                                            <option>Corporal</option>
                                                            <option>Staff Corporal</option>
                                                            <option>Sergent</option>
                                                            <option>Staff Sergent</option>
                                                            <option>Warrant Officer</option>
                                                            <option>Chief Warrant Officer</option>
                                                            <option>Senior Warrant Officer</option>
                                                            <hr class="dropdown-divider">
                                                            <option disabled class="text-danger"> Select Officer Rank
                                                            </option>
                                                            <option>2nd LT</option>
                                                            <option>LT</option>
                                                            <option>CPT</option>
                                                            <option>Major/Commandant</option>
                                                            <option>LT Col</option>
                                                            <option>Col</option>
                                                            <option>Brigadier Gen</option>
                                                            <option>Major Gen</option>
                                                            <option>LT Gen</option>
                                                            <option>General</option>
                                                        </select>
                                                        <!-- Dropdown for Non-Officer -->

                                                    </div>

                                                </div>



                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Full Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="name"
                                                                value={{ $sol->name }}>
                                                            @error('name')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Matricular Number</label>
                                                            <input class="form-control" type="text"
                                                                name="matricular" value="{{ $sol->matricular }}">
                                                            @error('matricular')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Blood Group</label>
                                                            <div class="col-lg-9">
                                                                <select class="select" name="bloodGroup">
                                                                    <option>{{ $sol->bloodGroup }}</option>
                                                                    <option value="A+">A+</option>
                                                                    <option value="O+">O+</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="AB+">AB+</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="O-">O-</option>
                                                                    <option value="B-">B-</option>
                                                                    <option value="AB-">AB-</option>
                                                                </select>
                                                                @error('bloodGroup')
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-lg-3 col-form-label">Specialization</label>
                                                            <div class="col-lg-9">
                                                                <select class="select" name="specialization"
                                                                    value="">
                                                                    <option>{{ $sol->specialization }}</option>
                                                                    <option value="INF">INF</option>
                                                                    <option value="ART ">ART </option>
                                                                </select>
                                                                @error('specialization')
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Date of Birth <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="cal-icon"><input
                                                                    class="form-control datetimepicker" type="text"
                                                                    name="date_of_birth"
                                                                    value="{{ $sol->date_of_birth }}">
                                                                @error('date_of_birth')
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Marial
                                                                Status</label>
                                                            <div class="col-lg-9">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="marialStatus" id="Single"
                                                                        value="Single" checked>
                                                                    <label class="form-check-label"
                                                                        for="marialStatus">
                                                                        Single
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="marialStatus" id="Married"
                                                                        value="Married">
                                                                    <label class="form-check-label"
                                                                        for="marialStatus">
                                                                        Married
                                                                    </label>
                                                                </div>
                                                                @error('marialStatus')
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Gender</label>
                                                            <div class="col-lg-9">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="gender_male"
                                                                        value="Male" checked>
                                                                    <label class="form-check-label" for="gender_male">
                                                                        Male
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="gender_female"
                                                                        value="Female">
                                                                    <label class="form-check-label"
                                                                        for="gender_female">
                                                                        Female
                                                                    </label>
                                                                </div>
                                                                @error('gender')
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Region of birth <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="select" name="regionOfBirth">
                                                                <option>{{ $sol->regionOfBirth }}</option>
                                                                <option>Adamawa</option>
                                                                <option>center</option>
                                                                <option>Far North</option>
                                                                <option>Littoral</option>
                                                                <option>North</option>
                                                                <option>Northwest</option>
                                                                <option>South</option>
                                                                <option>Southwest</option>
                                                                <option>West</option>
                                                            </select>
                                                            @error('regionOfBirth')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nationality <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="select" name="nationality">
                                                                <option>{{ $sol->nationality }}</option>
                                                                <option value="CMR">CMR</option>
                                                            </select>
                                                            @error('nationality')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-md-2">Passport
                                                                photo</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" type="file"
                                                                    name="photo">
                                                                @error('photo')
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                                <img class="avatar" alt=""
                                                                    src="{{ '/storage/' . $sol->photo }}">
                                                            </div>

                                                        </div>
                                                    </div> --}}

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
                            <!-- /Edit Employee Modal -->

                            <!-- Delete Employee Modal -->
                            <div class="modal custom-modal fade" id="delete_employee{{ $sol->id }}"
                                role="dialog">
                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">
                                        <form action={{ route('soldier.destroy', $sol->id) }} Method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-body">
                                                <div class="form-header">
                                                    <h3>Delete Employee {{ $sol->name }}</h3>
                                                    <p>Are you sure want to delete?</p>
                                                </div>
                                                <div class="modal-btn delete-action">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button class="btn btn-primary continue-btn"
                                                                type="submit">Delete</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="javascript:void(0);" data-dismiss="modal"
                                                                class="btn btn-primary cancel-btn">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- /Delete Employee Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Employee Modal -->
    <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('soldier.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">RANK</label>
                            <div class="col-lg-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="position" id="officerRadio"
                                        value="Officer" checked>
                                    <label class="form-check-label" for="officerRadio">
                                        Officer
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="position"
                                        id="nonOfficerRadio" value="Non-officer">
                                    <label class="form-check-label" for="nonOfficerRadio">
                                        Non-officer
                                    </label>
                                </div>
                                <div class="mt-3">
                                    <select class="form-control" id="rankDropdown" name="rank" disabled>
                                        <option value="" selected>Select a rank</option>
                                    </select>
                                    @error('rank')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Matricular Number</label>
                                    <input class="form-control" type="text" name="matricular">
                                    @error('matricular')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Blood Group</label>
                                    <div class="col-lg-9">
                                        <select class="select" name="bloodGroup">
                                            <option>Select</option>
                                            <option value="A+">A+</option>
                                            <option value="O+">O+</option>
                                            <option value="B+">B+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="A-">A-</option>
                                            <option value="O-">O-</option>
                                            <option value="B-">B-</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                        @error('bloodGroup')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Specialization</label>
                                    <div class="col-lg-9">
                                        <select class="select" name="specialization">
                                            <option>Select</option>
                                            <option value="INF">INF</option>
                                            <option value="ART ">ART </option>
                                        </select>
                                        @error('specialization')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Unit/Company <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="unit_company">
                                    @error('unit_company')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                                </div>
                            </div> --}}


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Date of Birth <span
                                            class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text"
                                            name="date_of_birth">
                                        @error('date_of_birth')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Marial Status</label>
                                    <div class="col-lg-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="marialStatus"
                                                id="Single" value="Single" checked>
                                            <label class="form-check-label" for="marialStatus">
                                                Single
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="marialStatus"
                                                id="Married" value="Married">
                                            <label class="form-check-label" for="marialStatus">
                                                Married
                                            </label>
                                        </div>
                                        @error('marialStatus')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Gender</label>
                                    <div class="col-lg-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                id="gender_male" value="Male" checked>
                                            <label class="form-check-label" for="gender_male">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                id="gender_female" value="Female">
                                            <label class="form-check-label" for="gender_female">
                                                Female
                                            </label>
                                        </div>
                                        @error('gender')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Region of birth <span class="text-danger">*</span></label>
                                    <select class="select" name="regionOfBirth">
                                        <option>Select region</option>
                                        <option>Adamawa</option>
                                        <option>center</option>
                                        <option>Far North</option>
                                        <option>Littoral</option>
                                        <option>North</option>
                                        <option>Northwest</option>
                                        <option>South</option>
                                        <option>Southwest</option>
                                        <option>West</option>
                                    </select>
                                    @error('regionOfBirth')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nationality <span class="text-danger">*</span></label>
                                    <select class="select" name="nationality">
                                        <option>Select Nationality</option>
                                        <option value="CMR">CMR</option>

                                    </select>
                                    @error('nationality')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Passport photo</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="file" name="photo">
                                        @error('photo')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Employee Modal -->



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script>
        // Show/hide dropdown based on selected radio button
        $('input[type=radio]').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'officer') {
                $('#officerDropdown').show();
                $('#nonOfficerDropdown').hide();
            } else {
                $('#officerDropdown').hide();
                $('#nonOfficerDropdown').show();
            }
        });
    </script>


</x-layout>
