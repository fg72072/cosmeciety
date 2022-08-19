
      <form class="forms-sample" action="{{ url('order/update/'.$order->id) }}" method="POST"
                                enctype="multipart/form-data">
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order : #{{$order->id}}</h5>
<!--         
        <h5 class="modal-title" id="exampleModalLabel">SubTotal : ${{$order->subtotal}}</h5>
        <h5 class="modal-title" id="exampleModalLabel">Tax : ${{$order->tax}}</h5>
        <h5 class="modal-title" id="exampleModalLabel">GrandTotal : ${{$order->grand_total}}</h5> -->
        <h5 class="modal-title" id="exampleModalLabel">Total : ${{$order->orderItems->sum('total')}}</h5>
        <i class="mdi mdi-close menu-icon pointer" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      
      <div class="modal-body ">
      <div class="row ">
                <div class="col-12 grid-margin ">
                    <div class="card">
                        <div class="card-body">
                           
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" readonly value="{{$order->first_name}}" name="first_name" id="first_name"
                                                placeholder="First Name" />
                                            @error('first_name')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" readonly value="{{$order->last_name}}" name="last_name" id="last_name"
                                                placeholder="Last Name" />
                                            @error('last_name')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="mobile" class="form-control" readonly value="{{$order->mobile}}" name="mobile" id="mobile"
                                                placeholder="Mobile" />
                                            @error('mobile')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code</label>
                                            <input type="postal_code" class="form-control" readonly value="{{$order->postal_code}}" name="postal_code" id="postal_code"
                                                placeholder="Postal Code" />
                                            @error('postal_code')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="postal_code" class="form-control" readonly value="{{$order->country ? $order->country->name : ''}}" name="postal_code" id="postal_code"
                                                placeholder="Postal Code" />
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="postal_code" class="form-control" readonly value="{{$order->city ? $order->city->name : ''}}" name="postal_code" id="postal_code"
                                                placeholder="Postal Code" />
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            @if($order->orderItems[0]->status == 4)
                                            <input  class="form-control" readonly value="Delivered" name="postal_code" id="postal_code"/>
                                            @else
                                            <select class="form-control" name="status" id="status" style="width: 100%;">
                                                @foreach ($statuses as $status)
                                                <option value="{{$status->id}}" @if($order->orderItems[0]->status == $status->id) selected @endif>{{$status->title}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Order Items</h4>
                      </p>
                      <div class="table-responsive">
                        <table class="table table-hover datatable ">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Product</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>

                            @foreach ($order->orderItems as $item)
                            <tr>
                              <td>{{$item->id}}</td>
                              <td>
                                <div class="d-flex align-items-center">
                                  @foreach($item->product->media as $media)
                                  <img style="border-radius: 0 !important;" src="{{$media ? asset('assets/images/product/'.$media->file) : asset('assets/images/faces/face1.jpg')}}" alt="image" />
                                  @endforeach
                                  <div class="table-user-name ml-3">
                                    <p class="mb-0 font-weight-medium"> {{$item->product->title}} </p>
                                  </div>
                                </div>
                              </td>
                              <td>${{$item->price}}</td>
                              <td>{{$item->qty}}</td>
                              <td>${{$item->total}}</td>
                              <td>
                              @if ($item->deliveryStatus->title == "Pending" || $item->deliveryStatus->title == "Cancel")
                              <label class="badge badge-danger">{{$item->deliveryStatus->title}}</label>
                              @elseif ($item->deliveryStatus->title == "Confirm" || $item->deliveryStatus->title == "Delivered")
                              <label class="badge badge-success">{{$item->deliveryStatus->title}}</label>
                              @endif
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>

