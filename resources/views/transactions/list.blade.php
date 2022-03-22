@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Transaction</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transaction</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-12 col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              {{-- <h4 class="card-title">Hoverable Table</h4> --}}
              </p>
              <div class="table-responsive">
                <table class="table table-hover datatable ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Txn ID</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transactions as $transaction)
                   <tr>
                    <td>{{$transaction->id}}</td>
                    <td>{{$transaction->txn_id}}</td>
                    <td>${{$transaction->amount}}</td>
                    <td>{{$transaction->description ? $transaction->description : '-'}}</td>
                    <td>{{$transaction->type}}</td>
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
