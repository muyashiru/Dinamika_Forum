@extends('layouts.app', [
    'title' => 'Verifikasi Email',
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <div class="container mx-auto p-10" style="min-height: 80vh;">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-lg">

                @if (session('resent'))
                    <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                        Link verifikasi baru telah dikirim ke alamat email Anda.
                    </div>
                @endif

                <div class="flex flex-col break-words bg-white border-2 rounded shadow-md">
                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Verifikasi Alamat Email Anda
                    </div>

                    <div class="w-full flex flex-col p-6 space-y-4">
                        <p class="leading-normal">
                            Sebelum melanjutkan, silakan periksa email Anda untuk link verifikasi.
                        </p>

                        <p class="leading-normal text-gray-700">
                            Jika Anda tidak menerima email,
                            <button type="submit" form="resend-verification-form" class="text-blue-600 hover:text-blue-800 underline cursor-pointer">
                                klik di sini untuk mengirim ulang
                            </button>.
                        </p>

                        <form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                        </form>

                        <div class="pt-4 border-t mt-4">
                            <p class="text-sm text-gray-600">
                                Email terdaftar: <strong>{{ auth()->user()->email }}</strong>
                            </p>
                            <p class="text-sm text-gray-500 mt-2">
                                Pastikan untuk memeriksa folder spam jika tidak menemukan email verifikasi.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
