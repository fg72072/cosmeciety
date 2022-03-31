@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">List Contest</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Contest</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-12 col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="add-btn-section">
                <a class="btn btn-primary" href="{{url('contest/create')}}">Add Contest</a>
              </div>
              </p>
              <div class="table-responsive">
                <table class="table table-hover datatable ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Contest</th>
                      <th>Entry Fee</th>
                      <th>Description</th>
                      <th>Entries Acceptance Date</th>
                      <th>Entries Close Date</th>
                      <th>Contest Live Date</th>
                      <th>Contest Close Date</th>
                      <th>Result Announce Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contests as $contest)
                    <tr>
                      <td>{{$contest->id}}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="{{asset('assets/images/contest/'.$contest->banner)}}" alt="image" />
                          <div class="table-user-name ml-3">
                            <p class="mb-0 font-weight-medium"> {{$contest->title}} </p>
                          </div>
                        </div>
                      </td>
                      <td>${{$contest->entry_fee}}</td>
                      <td>{{$contest->description}}</td>
                      <td>{{$contest->entries_acceptance_date}}</td>
                      <td>{{$contest->entries_close_date}}</td>
                      <td>{{$contest->contest_live_date}}</td>
                      <td>{{$contest->contest_close_date}}</td>
                      <td>{{$contest->result_announce_date}}</td>
                      <td>
                        @if ($contest->status == 1)
                        <label class="badge badge-success">Active</label>
                        @else
                        <label class="badge badge-danger">Unactive</label>
                        @endif
                      </td>
                      <td>
                        <div class="btn-flex">
                            <a href="{{url('contest/edit/'.$contest->id)}}" class="btn text-white btn-success btn-icon-text">
                                <i class="mdi mdi-pencil-box-outline btn-icon-prepend"></i> Edit </a>
                            <form action="{{url('contest/delete/'.$contest->id)}}" method="post" class="delete-form">
                            @csrf
                                <button type="submit" class="btn btn-danger btn-icon-text">
                                    <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete </button>
                            </form>
                        
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
