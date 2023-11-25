<base href="/">
<x-layout>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Medical situation</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Medical situation</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_designation"><i
                        class="fa fa-plus"></i> Add Medical situation</a>
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
                            <th>Physical health </th>
                            <th>Immunization </th>
                            <th>HIV Test </th>
                            <th>Others... </th>

                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medical as $nat)
                            <tr>
                                <td>{{ $nat->id }}</td>
                                <td>{{ $nat->physicalHealth }}</td>
                                <td>{{ $nat->immunization }}</td>
                                <td>{{ $nat->hiv_test }}</td>
                                <td>{{ $nat->others }}</td>


                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit_designation{{ $nat->id }}"><i class="fa fa-pencil m-r-5"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_designation{{ $nat->id }}"><i class="fa fa-trash-o m-r-5"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Designation Modal -->
                            <div id="edit_designation{{ $nat->id }}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Unit/Company</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('medical.update',$nat->id) }}" method="POST">
                                                @method('put')
                                                @csrf

                                                <div class="form-group">
                                                    <label>Unit/Company Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name" value="{{ $nat->name }}"  >
                                                    @error('name')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>city <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="city" value="{{ $nat->city }}"  >
                                                    @error('city')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>location <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="location" value="{{ $nat->location }}"  >
                                                    @error('location')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="submit-section">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Designation Modal -->

                            <!-- Delete Designation Modal -->
                            <div class="modal custom-modal fade" id="delete_designation{{ $nat->id }}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete medical situation</h3>
                                                <p>Are you sure want to delete?</p>
                                            </div>
                                            <form action="{{ route('medical.destroy', $nat->id) }}" method="POST">
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
                    <h5 class="modal-title">Add medical situation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('medical.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Select a soldier <span class="text-danger">*</span></label>
                            <select class="select" name="id">
                                @foreach (\App\Models\Soldier::all() as $army )
                                <option value="{{ $army->id }}">{{ $army->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Physical Health <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="physicalHealth">
                            @error('physicalHealth')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> HIV Test <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="hiv_test">
                            @error('hiv_test')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> Immunization  <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="immunization">
                            @error('immunization')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Others <span class="text-danger">*</span></label>
                            <textarea name="others" rows="4" class="form-control"></textarea>
                            @error('others')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>




                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Designation Modal -->



</x-layout>

