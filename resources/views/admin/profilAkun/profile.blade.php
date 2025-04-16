@extends('Layout.layoutAdmin')
<!-- @section('content') -->
    <x-layout>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <img src="{{ asset('sbadmin2/img/undraw_profile.svg') }}" alt="Foto Profil" class="rounded-circle mb-3"
                                width="130" height="130">

                            <h4 class="fw-bold">Nama Admin</h4>
                            <p class="text-muted mb-4">admin@example.com</p>

                            <ul class="list-group list-group-flush text-start">
                                <li class="list-group-item">
                                    <strong>Nama Lengkap:</strong> Nama Admin
                                </li>
                                <li class="list-group-item">
                                    <strong>Email:</strong> admin@example.com
                                </li>
                                <li class="list-group-item">
                                    <strong>No Telepon:</strong> 081234567890
                                </li>
                                <li class="list-group-item">
                                    <strong>Perusahaan:</strong> PT Contoh Perusahaan
                                </li>
                            </ul>

                            {{-- <div class="mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit Profil
                        </a>
                    </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layout>
