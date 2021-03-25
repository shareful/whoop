@extends('admin.layouts.baselayout')
@section('title', 'User Profile')
@section('content')
@include('admin.includes.navigation')
<div class="main-container container-fluid addarticle">
   <!-- Page Container -->
   <div class="page-container">
      @include('admin.includes.sidebar');
      <!-- Page Content -->
      <div class="page-content">
         <div class="row">
            <div class="col-md-12">
               @if(isset($user))
               <div class="profile-container">
                  <div class="profile-header row">
                     
                     <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                        @if (isset($user['photo']))
                        <img src="{{ asset('/upload/user/'.$user['photo'])}}" alt="" class="header-avatar">
                        @else
                        <img src="{{ asset('/upload/user/no-user.jpg')}}" alt="" class="header-avatar">
                        @endif
                     </div>
                     
                     <div class="col-lg-5 col-md-8 col-sm-12 profile-info">
                        <div class="header-fullname">{{$user['firstname']." ".$user['lastname']}}</div>
                        <div class="header-information">
                           @if (isset($user['token_id']))
                           <div class="row">
                              <div class="col-md-4"><b>USER ID:</b></div>
                              <div class="col-md-8">{{$user['token_id']}}</div>
                           </div>
                           @endif
                           @if (isset($user['email']))
                           <div class="row">
                              <div class="col-md-4"><b>Email:</b></div>
                              <div class="col-md-8">{{$user['email']}}</div>
                           </div>
                           @endif
                           @if (isset($user['mobile']))
                           <div class="row">
                              <div class="col-md-4"><b>Contact:</b></div>
                              <div class="col-md-8">{{$user['mobile']}}</div>
                           </div>
                           @endif
                           @if (isset($user['zipcode']))
                           <div class="row">
                              <div class="col-md-4"><b>Zip Code:</b></div>
                              <div class="col-md-8">{{$user['zipcode']}}</div>
                           </div>
                           @endif
                           @if (isset($user['address']))
                           <div class="row">
                              <div class="col-md-4"><b>Address:</b></div>
                              <div class="col-md-8">{{$user['address']}}</div>
                           </div>
                           @endif
                        </div>
                     </div>
                     <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 stats-col">
                              <div class="stats-value pink">{{$deals_left}}</div>
                              <div class="stats-title">DEALS LEFT</div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 stats-col">
                              <div class="stats-value pink">{{$unlocked_deals}}</div>
                              <div class="stats-title">UNLOCKED DEALS</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
      <!-- /Page Content -->
   </div>
   <!-- /Page Container -->
   <!-- Main Container -->
</div>
@stop