@extends('Admin.layout.master')
@section('content')
<div class="row mt-5 mx-auto">
    <div class="col-12 card">
        <div class="mt-2">
            <h3 class="" style="font-family: cursive;">Traveller Profile</h3>
            <a href="{{url('/traveller_user')}}" class="btn btn-sm float-right btn-dark ">Back</a>
            </div>
            <div class="pt-4">
            <div class="row">
                <div class="col-9" >
        <table class="table table-responsive-lg">
            <tbody>
                <tr>
                    <td>First_name</td>
                    <td>{{$travel->First_Name}}</td>
                </tr>
                <tr>
                    <td>Last_name</td>
                    <td>{{$travel->Last_Name}}</td>
                </tr>
                <tr>
                    <td>Short Intro</td>
                    <td>{{$travel->Short_Intro}}</td>
                </tr>
                <tr>
                    <td>D.O.B</td>
                    <td>{{$travel->DOB}}</td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td>{{$travel->Contact_No}}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{$travel->City}}</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{$travel->Country}}</td>
                </tr>
                <tr>
                    <td>Pincode</td>
                    <td>{{$travel->Pin_Code}}</td>
                </tr>
            </tbody>
        </table>
                </div>
                <div class="col-2" style="border:2px solid black; height:200px;">
        <div class="">
        <img src="{{asset('traveller')}}/{{$travel->Profile_URLs}}" style="height: 190px;" >
        </div>
    </div>
            </div>
    </div>
    
    </div>
</div>

<div class="row">
       <div class="col-12 card p-3 mt-5">
            <h4 class="p-3" style="font-family: initial;">Details Search</h4>
            <form  method="post" action="{{url('/traveller_details_serach').'/'.base64_encode($travel->id)}}" >
           @csrf
            <div class="row mx-auto">
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="trip_id" class="form-control" placeholder="Trip id"  value="{{$trip_id ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
               <select class="form-control" name="trip_status" >
                   @php
                       $trip_status=$trip_status ?? '';
                   @endphp
                   <option value="">Choose Status</option>
                   <option value="1"  @if($trip_status==1) selected @endif>Archived</option>
                   <option value="2"  @if($trip_status==2) selected @endif>Underreview</option>
                   <option value="3"  @if($trip_status==3) selected @endif>Reject</option>
                   <option value="4"  @if($trip_status==4) selected @endif>Ongoing</option>
                   <option value="5"  @if($trip_status==5) selected @endif>Cancel</option>
               </select>
            </div><!-- //form-group -->  
        </div>
        {{-- <div class="col-lg-3 col-11">
           <div class="form-group">
            <select class="form-control" name="trip_ratings">
                @php
                 $trip_rating   =$trip_ratings ?? '';
                @endphp
                   <option value="" @if($trip_rating=='') selected @endif>Choose Rating</option>
                   <option value="1" @if($trip_rating==1) selected @endif>1</option>
                   <option value="2" @if($trip_rating==2) selected @endif>2</option>
                   <option value="3" @if($trip_rating==3) selected @endif>3</option>
                   <option value="4" @if($trip_rating==4) selected @endif>4</option>
                   <option value="5" @if($trip_rating==5) selected @endif>5</option>
               </select>       
        </div><!-- //form-group -->  
        </div> --}}
       
        <div class="col-lg-3 col-11">
            <div class="row">
                <div class="col-6">
           <div class="form-group">
               <button class="btn btn-sm btn-danger"  type="submit">Search</button>
            </div><!-- //form-group -->  </div>
           <div class="col-6">
           <div class="form-group">
               <a class="btn btn-sm btn-dark" href="{{url('/travel_view').'/'.base64_encode($travel->id)}}" type="submit">Reset</a>
            </div><!-- //form-group -->  </div>
        </div>
        </div>
        </div>
        </form>
        </div>
    <div class="col-12 mx-auto mb-5 card">
        <h4 class="p-3">Traveller Trip Details</h4>
        <table class="table table-responsive-lg">
            <thead>
                <tr>
                    <th>Trip_id</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
@foreach ($trip as $item)
    <tr>
        <td>{{$item->trip_id}}</td>
        <td>
        @if($item->status==1)
                <p>archived</p>
               @elseif($item->status==2)    
            <p>wait for admin response</p>
                @elseif($item->status==3)
              <p>Rejected</p>
                 @elseif($item->status==4)
                   <p>Ongoing</p>
                    @elseif($item->status==5)
                  <p>cancelled</p>
                @endif                        
        </td>
        <td>
            {{ROUND($item['ratings']->avg('rating'))}}
        </td>
        <td>
            <a class="dropdown-item" href="{{route('trip_view',['id'=>$item->id])}}"><i class="dw dw-eye"></i> View</a>
        </td>
    </tr>
@endforeach
                
                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        {{$trip->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection