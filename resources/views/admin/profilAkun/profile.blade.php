@extends('Layout.layoutAdmin')

<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <!-- Card Profil -->
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    
                    <!-- Header dengan Gradient -->
                    <div class="bg-gradient-primary text-white text-center p-4">
                        <img src="{{ asset('sbadmin2/img/undraw_profile.svg') }}" alt="Foto Profil"
                            class="rounded-circle border border-light shadow-sm mb-3"
                            width="110" height="110">
                        <h4 class="fw-bold mb-0">Nama Admin</h4>
                        <small>admin@example.com</small>
                    </div>

                    <!-- Informasi Profil -->
                    <div class="card-body px-4 py-4 bg-light">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-person-fill me-2 text-primary"></i><strong>Nama Lengkap</strong></span>
                                <span>Nama Admin</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-envelope-fill me-2 text-primary"></i><strong>Email</strong></span>
                                <span>admin@example.com</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-telephone-fill me-2 text-primary"></i><strong>No Telepon</strong></span>
                                <span>081234567890</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-building me-2 text-primary"></i><strong>Perusahaan</strong></span>
                                <span>PT Contoh Perusahaan</span>
                            </li>
                        </ul>

                        <!-- Tombol Edit -->
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn-primary px-4">
                                <i class="bi bi-pencil-fill me-2"></i>Edit Profile
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-layout>
