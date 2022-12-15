@extends('layouts.app')
@section('title', 'Contact Us')
@section('keywords', ' Tom Dotson, MSHA certified instructor, OSHA Authorized Instructure, AED, First Aid, CPR
Instructor, Surface Miner training, Drilling Blasting and Explosives, Surface Mine Annual Retraining, OSHA, MSHA,
HAZMAT, ISEE, ISEE Potomac Chapter, New Miner Training, Employee Safety, ')
@section('content')
<section class="">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <h1>Contact Us</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="lead">Safety First Consulting offers a variety of unique training classes such as HAZWOPER and
                    Employee Safety Training. All of our classes are “Training Developed From Experience” and we are
                    committed to ensuring the quality of each module.</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <!-- Success message -->
              @include('inc.alert')

                <form action="" method="post" action="{{ route('contact.store') }}">

                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name"
                            id="name" required>

                        <!-- Error -->
                        @if ($errors->has('name'))
                        <div class="error">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email"
                            id="email" required>

                        @if ($errors->has('email'))
                        <div class="error">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone"
                            id="phone" required>

                        @if ($errors->has('phone'))
                        <div class="error">
                            {{ $errors->first('phone') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}"
                            name="subject" id="subject" required>

                        @if ($errors->has('subject'))
                        <div class="error">
                            {{ $errors->first('subject') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" name="message"
                            id="message" rows="4" required></textarea>

                        @if ($errors->has('message'))
                        <div class="error">
                            {{ $errors->first('message') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                                <div class="h-captcha w-100" data-sitekey="37df5f3f-3448-40cf-b20a-abc38b1bbf25"
                                    data-theme="light">
                    </div>




                    <input type="Submit" name="send" value="Submit" class="btn btn-dark btn-block">
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

<script src="https://hcaptcha.com/1/api.js" async defer></script>
@endsection
