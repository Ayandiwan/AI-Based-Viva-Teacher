<x-mail::layout>

    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            <div style="padding:30px;background:linear-gradient(135deg,#0d6efd,#6610f2);text-align:center;">
                <h1 style="margin:0;color:#ffffff;font-size:30px;">
                    🎓 AI Based Viva Teacher
                </h1>

                <p style="margin-top:10px;color:#ffffff;">
                    Smart AI Powered Viva Examination System
                </p>
            </div>
        </x-mail::header>
    </x-slot:header>

    {!! $slot !!}

    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {!! $subcopy !!}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            <div style="text-align:center;padding:20px;">
                <h3 style="margin:0;color:#2563eb;">
                    🎓 AI Based Viva Teacher
                </h3>

                <p style="margin:10px 0;color:#666;">
                    Intelligent • Fast • Secure
                </p>

                <p style="font-size:13px;color:#999;">
                    © {{ date('Y') }} AI Based Viva Teacher. All Rights Reserved.
                </p>
            </div>
        </x-mail::footer>
    </x-slot:footer>

</x-mail::layout>