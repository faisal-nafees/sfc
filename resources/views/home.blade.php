@extends('layouts.app')
@section('title', 'Home')
@section('keywords',
    ' Hazwoper training, Kentucky, Tennessee, Surface Miner Training classes, Coal Miner Training
    class, Drilling Blasting and explosives training, employee safety training, MSHA training, OSHA, ISEE Potomac, New Miner
    training class, Surface Mine Annual retraining class, employee safety, HAZMAT, ',)
@section('content')
    <style>
        body {
            background: #0200d7;
        }
    </style>
    <section class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-center  d-flex justify-content-center align-items-center" style="height: 30vh;">
                    <h2 class="">
                        "Mine Training Offered in <br>English and Spanish"</h2>
                </div>
                <div class="col-md-6 text-center d-flex justify-content-center align-items-center" style="height: 30vh;">
                    <div class="">
                        <h2>Check Out Classes!</h2>
                        <a href="/register" class="btn nav-btn btn-lg">Register Today!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="color-fade"></div>
    <img class="bg-img" src="../img/Flag-Background.jpeg" alt="">
    <div class="color-fade-up"></div>
    <section class="sec d-flex justify-content-center align-items-end">
        <div class="container-fluid text-center">
            <div class="row ">
                <div class="col-md-12">
                    <h1 class="mb-5">What We Do</h1>
                    <p class="lead">Safety First Consulting offers online training from an experienced person’s point of
                        view. The development and presentation of our program is a culmination of nearly 30 years of
                        occupational and mining experience. Safety First Consulting provides the trainee with hazard
                        recognition and occupational safety awareness. Each module has been experienced by the developer and
                        shares the knowledge and skills that can only be learned through experience. </p>
                </div>
            </div>
        </div>
    </section>
    <aside class="callout">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-5"><a href="/register">Signup Today!</a></h1>
                </div>
            </div>
        </div>
    </aside>
    <section id="WWO" class="sec1">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-5">Training We Offer</h1>
                    <p class="lead">Safety First Consulting is offering training from a first-person point of view.
                        Each training module was developed from experience garnered in real construction and mining
                        environments.
                        MSHA training, Part 46, helps miners and contractors identify and minimize exposure to hazards
                        typically found at surface mines.
                        Depending on the type of online training you require, Safety First Consulting will meet your
                        occupational and safety training needs.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="row col-md-9 justify-content-center my-3">
                    <div class="col-md-6 my-3">
                        <div class="card">
                            <!-- <img src="https://via.placeholder.com/100x150" class="card-img-top" alt="...">-->
                            <div style="height: 250px;" class="card-body text-dark d-flex align-items-center flex-column ">
                                <h5 class="card-title">DRILLING, BLASTING & EXPLOSIVES</h5>
                                <p class="card-text">8 Hour Blasting CEU Module<br>
                                    Approved States: Kentucky <span>&#183;</span> Tennessee <span>&#183;</span> Pennsylvania
                                    <span>&#183;</span>Alabama <span>&#183;</span> Virginia <span>&#183;</span> South
                                    Carolina<span>&#183;</span>Indiana
                                    <br>
                                    OSM Approved
                                </p>
                                <a href="/drilling_blasting_explosives" class="btn btn-primary mt-auto">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">
                        <div class="card">
                            <!-- <img src="https://via.placeholder.com/100x150" class="card-img-top" alt="...">-->
                            <div style="height: 250px;" class="card-body text-dark d-flex align-items-center flex-column ">
                                <h5 class="card-title">SURFACE MINER</h5>
                                <p class="card-text">
                                    24 Hour New Miner Training <br>
                                    Annual Retraining – Surface Mining <br>
                                    Experienced Miner – Surface Mining <br>
                                    Surface Mine Supervisor <br>
                                </p>
                                <a href="Miner-New-Experienced-Annual" class="btn btn-primary mt-auto">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 my-3">
                        <div class="card">
                            <!-- <img src="https://via.placeholder.com/100x150" class="card-img-top" alt="...">-->
                            <div style="height: 200px;" class="card-body text-dark d-flex align-items-center flex-column ">
                                <h5 class="card-title">HAZWOPER</h5>
                                <p class="card-text">8 Hour HAZWOPER Refresher</p>
                                <a href="Other-Training" class="btn btn-primary mt-auto">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">
                        <div class="card">
                            <!-- <img src="https://via.placeholder.com/100x150" class="card-img-top" alt="...">-->
                            <div style="height: 200px;" class="card-body text-dark d-flex align-items-center flex-column ">
                                <h5 class="card-title">EMPLOYEE SAFETY</h5>
                                <p class="card-text">Designed to promote employee safety <br> in the workplace.</p>
                                <a href="Other-Training" class="btn btn-primary mt-auto">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 my-3">
                        <div class="card">
                            <!-- <img src="https://via.placeholder.com/100x150" class="card-img-top" alt="...">-->
                            <div style="height: 200px;" class="card-body text-dark d-flex align-items-center flex-column ">
                                <h5 class="card-title">ENTRENAMIENTO EN MINAS DE SUPERFICIE</h5>
                                <p class="card-text">Nueva Capacitación minera - Minería de superficie
                                    <br> Perforación y voladura <br>Reentrenamiento anual de MSHA
                                </p>
                                <a href="Other-Training" class="btn btn-primary mt-auto">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2 my-3"></div>
        </div>
    </section>
@endsection
