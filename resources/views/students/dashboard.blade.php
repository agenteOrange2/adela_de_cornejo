
@extends('layouts.principal')

@section('title', 'Mi Cuenta')

@section('content')

<div class="page-title-area item-bg1 jarallax" data-jarallax="{&quot;speed&quot;: 0.3}">
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Mi Cuenta</li>
            </ul>
            <h2>Mi Cuenta</h2>
        </div>
    </div>
</div>

<section class="my-account-area ptb-100">
    <div class="container">
        <div class="myAccount-profile">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5">
                    <div class="profile-image">
                        <img src="{{ $user->profile_photo_url }}" alt="image">
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    <div class="profile-content">
                        <h3>{{ $user->name }} {{ $user->last_name }}</h3>
                        <p>Matrícula: {{ $user->matricula }}</p>

                        <ul class="contact-info">
                            <li><i class="bx bx-envelope"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                            <li><i class="bx bx-phone"></i> <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
                        </ul>
                        <ul class="contact-info">
                            <li>Plantel: {{ $user->plantel->name ?? 'N/A' }}</li>
                            <li>Nivel Educativo: {{ $user->educationLevel->name ?? 'N/A' }}</li>
                            <li>Grado: {{ $user->grade->name ?? 'N/A' }}</li>
                            <li>Grupo: {{ $user->group->name ?? 'N/A' }}</li>
                        </ul>
                        {{-- <ul class="social">
                            <li><a href="#" class="d-block" target="_blank"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="#" class="d-block" target="_blank"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="#" class="d-block" target="_blank"><i class="bx bxl-instagram"></i></a></li>
                            <li><a href="#" class="d-block" target="_blank"><i class="bx bxl-linkedin"></i></a></li>
                            <li><a href="#" class="d-block" target="_blank"><i class="bx bxl-pinterest-alt"></i></a></li>
                        </ul> --}}

                        <a href="{{ route('student.edit') }}" class="myAccount-edit">Editar Información</a>
                        <a href="{{ route('logout') }}" class="myAccount-logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="myAccount-navigation">
            <ul>
                <li><a href="my-account.html" class="active"><i class="bx bxs-dashboard"></i> Dashboard</a></li>
                <li><a href="orders.html"><i class="bx bx-cart"></i> Orders</a></li>
                <li><a href="downloads.html"><i class="bx bx-download"></i> Downloads</a></li>
                <li><a href="edit-address.html"><i class="bx bx-home-alt"></i> Addresses</a></li>
                <li><a href="edit-account.html"><i class="bx bx-edit"></i> Account Details</a></li>
                <li><a href="#"><i class="bx bx-log-out"></i> Logout</a></li>
            </ul>
        </div>

        <div class="myAccount-content">
            <p>Hello <strong>James Anderson</strong> (not <strong>James Anderson</strong>? <a href="#">Log out</a>)</p>
            <p>From your account dashboard you can view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a>, and <a href="#">edit your password and account details</a>.</p>

            <h3>Recent Orders</h3>
            <div class="recent-orders-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#074145O5</td>
                            <td>October 18, 2023</td>
                            <td>Completed</td>
                            <td>$49.00 for 1 item</td>
                            <td><a href="#" class="view-button">View</a></td>
                        </tr>
                        <tr>
                            <td>#074145O6</td>
                            <td>October 18, 2023</td>
                            <td>On Hold</td>
                            <td>$49.00 for 1 item</td>
                            <td><a href="#" class="view-button">View</a></td>
                        </tr>
                        <tr>
                            <td>#074145O7</td>
                            <td>October 18, 2023</td>
                            <td>Completed</td>
                            <td>$49.00 for 1 item</td>
                            <td><a href="#" class="view-button">View</a></td>
                        </tr>
                        <tr>
                            <td>#074145O5</td>
                            <td>October 18, 2023</td>
                            <td>Completed</td>
                            <td>$49.00 for 1 item</td>
                            <td><a href="#" class="view-button">View</a></td>
                        </tr>
                        <tr>
                            <td>#074145O6</td>
                            <td>October 18, 2023</td>
                            <td>On Hold</td>
                            <td>$49.00 for 1 item</td>
                            <td><a href="#" class="view-button">View</a></td>
                        </tr>
                        <tr>
                            <td>#074145O7</td>
                            <td>October 18, 2023</td>
                            <td>Completed</td>
                            <td>$49.00 for 1 item</td>
                            <td><a href="#" class="view-button">View</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection