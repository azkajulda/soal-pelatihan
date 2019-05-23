@extends('layouts.main')
@section('title')
    | Quizzes
@endsection
@section('content')
    <div class="content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('alert'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('alert')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->has('level'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $errors->first('level') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-plain">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title mt-0">Data User</h4>
                            <p class="card-category">Manage user if you need</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="">
                                    <th>
                                        NO
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Access Code
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($user as $users): ?>
                                    <tr>
                                        <td>
                                            {{$i}}
                                        </td>
                                        <td>
                                            {{$users->email}}
                                        </td>
                                        <td>
                                            {{$users->level}}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#editAccess">
                                                <i class="material-icons">edit</i> Edit Access
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Pagination Nutritious">
                        <ul class="pagination pagination-success justify-content-center">
                            {{$user->links()}}
                        </ul>
                    </nav>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            Information
                        </div>
                        <div class="card-body">
                            If Access Code is :
                            <ul>
                                <li>0 = user has not been activated,</li>
                                <li>1 = Admin,</li>
                                <li>2 = user has been activated.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($user as $users)
    {{--Modal Add Training--}}
    <div class="modal fade" id="editAccess" tabindex="-1" role="dialog" aria-labelledby="editAccessLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('editAccess',$users->id)}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Level" name="level">
                        </div>
                        @if ($errors->has('level'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('level') }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection