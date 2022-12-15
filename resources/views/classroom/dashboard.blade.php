@extends('classroom/layout')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb ml-3">
        <li class="breadcrumb-item">Dashboard</li>
    </ol>
</nav>

<div class="row mt-5 d-flex justify-content-center mx-0">
    <div class="col-md-9">
        <p class="text-danger font-weight-bolder text-center">Certificate of Completion is found in the "My Certs" tab on the left panel under "Dashboard"</p>
        <p>Thank you for your interest in online training from Safety First Consulting. Your time is valuable and we
            know that. Each training module is packed with up to date and relevant information pertaining to the type of
            training
            you choose. The knowledge checks are designed to help you remember the content and expand your knowledge
            into your
            training option.
        </p>
        <p>
            The content has been designed and developed to explain and illustrate the safety hazards associated with the
            training option. The developer shared two decades of knowledge and experience into each presentation and
            carefully
            defined the safety hazards associated with mining, explosives and overall safety. Once again thank you for
            your time and share your
            experience with others.</p>

        <div class="row pt-5 logo-slogan">
            <div class="col-md-12 d-flex justify-content-center align-items-center ">
                <img class=" img-fluid nav-logo w-25 mx-auto" src="/img/Safety%20First%20Logo.png">
            </div>
            <div class="col-md-12 d-flex justify-content-center align-items-center text-center">
                <h3><b>TRAINING DEVELOPED FROM <BR>EXPERIENCE</b></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <h3>Links</h3>
        <a href="https://atf.gov">Bureau of Alcohol, Tobacco, Firearms and Explosives (ATF)</a><br />
        <a href="https://msha.gov">Mine Safety and Health Administration (MSHA)</a><br />
        <a href="https://osha.gov">Occupational Safety and Health Administration (OSHA)</a><br />
        <a href="https://phmsa.dot.gov">Pipeline and Hazardous Materials Safety Administration</a><br />
        <a href="https://transportation.gov">U.S. Department of Transportation</a><br />
        <a href="mailTo:Support@kdetechnology.com" class="btn btn-dark btn-lg btn-block mt-3">Support</a>
    </div>
</div>
@endsection
