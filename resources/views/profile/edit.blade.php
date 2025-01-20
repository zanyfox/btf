@extends('layouts/app')

@section('content')

<nav class="master-breadcrumb" aria-label="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Portal Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Your Profile</li>
    </ol>
  </div>
</nav>
<div class="verification-banner email-verification">
  <div class="container">
    <div class="row">
      <div class="col-2 col-sm-1 order-3">
        <button id="btnEmailVerificationClose" type="button" class="btn close" data-uri="/index.php?rp=/dismiss/email-verification"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="col-10 col-sm-7 col-md-8 order-1">
        <i class="fas fa-exclamation-triangle"></i>
        <span class="text">Please check your email and follow the link to verify your email address.</span>
      </div>
      <div class="col-12 col-sm-4 col-md-3 order-sm-2 order-md-last">
        <button id="btnResendVerificationEmail" class="btn btn-default btn-sm btn-block btn-resend-verify-email btn-action" data-email-sent="Email Sent" data-error-msg="Error" data-uri="/index.php?rp=/user/verification/resend">
          <span class="loader w-hidden"><i class="fa fa-spinner fa-spin"></i></span>
          Resend Verification Email
        </button>
      </div>
    </div>
  </div>
</div>

<section id="main-body">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-xl-3">
        <div class="sidebar">
          <div menuItemName="Profile" class="mb-3 card card-sidebar">
            <div class="card-header">
              <h3 class="card-title m-0">
                <i class="fas fa-user"></i>&nbsp;Your Profile <i class="fas fa-chevron-up card-minimise float-right"></i>
              </h3>
            </div>
            <div class="collapsable-card-body">
              <div class="list-group list-group-flush d-md-flex" role="tablist">
                <a href="/user/profile" class="list-group-item list-group-item-action active">Your Profile</a>
                <a href="/user/password" class="list-group-item list-group-item-action">Change Password</a>
                <a href="/user/security" class="list-group-item list-group-item-action">Security Settings</a>
                <a href="/logout" class="list-group-item list-group-item-action">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-xl-9 primary-content">

        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')

        @include('profile.partials.delete-user-form')
      </div>
    </div>
  </div>
</section>
@endsection
