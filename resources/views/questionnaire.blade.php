@extends('layouts.base')

@section('title', 'Client Registration Form')
@section('header', 'Client Registration Form')

@section('content')
    <div class="mx-auto max-w-4xl py-12">
        <div class="rounded-2xl bg-white shadow ring-1 ring-black/5">
            <div class="p-6 sm:p-8">
                {{-- Header --}}
                <div class="flex flex-col items-center">
                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo" class="w-40">
                    <div class="mt-10">
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900">
                            CLIENT REGISTRATION FORM
                        </h1>
                    </div>
                </div>

                <form method="POST" action="{{ route('questionnaire.store') }}" class="mt-6">
                    @csrf

                    {{-- Contact Info --}}
                    <section class="p-4 sm:p-6">
                        <p class="text-xs text-gray-500">
                            Please complete all required fields.
                        </p>

                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            {{-- First Name --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-700">FIRST NAME</label>
                                <input
                                    type="text"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                                >
                                @error('first_name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Last Name --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-700">LAST NAME</label>
                                <input
                                    type="text"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                                >
                                @error('last_name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-700">EMAIL</label>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                                >
                                @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Contact Number --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-700">CONTACT NUMBER</label>
                                <input
                                    type="text"
                                    name="contact_number"
                                    value="{{ old('contact_number') }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                                >
                                @error('contact_number')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            {{-- Country of Residence --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-gray-700">COUNTRY OF RESIDENCE</label>
                                <input
                                    type="text"
                                    name="country_of_residence"
                                    value="{{ old('country_of_residence') }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                                >
                                @error('country_of_residence')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Unit of Interest --}}
                            <section class="sm:col-span-2">
                                <div class="col">
                                    <h2 class="text-sm font-semibold text-gray-900">UNIT OF INTEREST</h2>
                                    <span class="text-xs text-gray-500">(Select one or more)</span>
                                </div>

                                <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                                    @php
                                        $units = [
                                            '1_bedroom' => '1-Bedroom',
                                            '2_bedroom' => '2-Bedroom',
                                            '3_bedroom' => '3-Bedroom',
                                            '4_bedroom' => '4-Bedroom',
                                            'penthouse' => 'Penthouse',
                                        ];
                                    @endphp

                                    @foreach($units as $key => $label)
                                        <label class="flex items-center gap-3 rounded-lg border border-gray-200 px-4 py-3 hover:bg-gray-50">
                                            <input
                                                type="checkbox"
                                                name="unit_interest[]"
                                                value="{{ $key }}"
                                                class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900"
                                                @checked(is_array(old('unit_interest')) && in_array($key, old('unit_interest', [])))
                                            >
                                            <span class="text-sm text-gray-900">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                @error('unit_interest')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </section>

                            {{-- Remark --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-gray-700">REMARK</label>
                                <textarea
                                    name="remark"
                                    rows="4"
                                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                                >{{ old('remark') }}</textarea>
                                @error('remark')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    {{-- Consent Text --}}
                    <section class="p-4 sm:p-6">

                        <div class="mt-4 space-y-4 text-sm leading-6 text-gray-800 text-xs">
                            <p class="text-gray-800">
                                By signing hereinbelow, I, the undersigned, hereby acknowledge that I have thoroughly read, reviewed, understood and agreed to City Dynamic Co., Ltd. (“City Dynamic”) collecting, using,
                                disclosing and otherwise processing (“processing”) my personal data provided in accordance with the applicable personal data protection laws and regulations, City Dynamic’s Privacy Notice
                                for Customers (https://www.uhresidencesbangkok.com/privacy-policy/) (the “Privacy Notice”), and Terms of Service (https://www.uhresidencesbangkok.com/terms-and-conditions/), and
                            </p>

                            <p class="text-gray-800">
                                โดยการลงลายมือชื่อด้านล่างนี้ ข้าพเจ้าซึ่งเป็นผู้ลงลายมือชื่อข้างท้าย ขอรับรองว่าข้าพเจ้าได้อ่าน พิจารณา และเข้าใจแบบฟอร์มนี้โดยตลอด และตกลงให้ บริษัท ซิตี้ ไดนามิค จำกัด (“ซิตี้ ไดนามิค”) เก็บรวบรวม ใช้ เปิดเผย และประมวลผล (“ประมวลผล”) ข้อมูลส่วนบุคคลของข้าพเจ้าที่ได้ให้ไว้ โดยเป็นไปตามกฎหมายและข้อบังคับเกี่ยวกับการคุ้มครองข้อมูลส่วนบุคคลที่ใช้บังคับ นโยบายความเป็นส่วนตัวสำหรับลูกค้าของซิตี้ ไดนามิค (https://www.uhresidencesbangkok.com/privacy-policy/
                                ) และข้อกำหนดการให้บริการ (https://www.uhresidencesbangkok.com/terms-and-conditions/) และ
                            </p>

                            <div class="space-y-3">
                                <label class="flex items-start gap-3">
                                    <input
                                        type="checkbox"
                                        name="consent_transfer"
                                        value="1"
                                        class="mt-1 h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900"
                                        @checked(old('consent_transfer'))
                                    >
                                    <span>
                                         I hereby consent to the transfer of my full name, contact details and other personal data as set forth in the Privacy Notice outside of my jurisdiction in accordance with the Privacy Notice
             and for the purposes listed therein, including without limitation,to City Dynamic’s affiliates and group companies, and Swire Properties Hotel Management Limited and its affiliates.
                                        <span class="block text-gray-600">
                                           ข้าพเจ้ายินยอมให้ส่งหรือโอนชื่อและนามสกุล ข้อมูลติดต่อ และข้อมูลส่วนบุคคลอื่น ๆ ของข้าพเจ้าตามที่ระบุไว้ในนโยบายความเป็นส่วนตัวไปยังต่างประเทศ โดยเป็นไปตามนโยบายความเป็นส่วนตัวและเพื่อวัตถุประสงค์ที่ระบุไว้ในนโยบายดังกล่าว ซึ่งรวมถึงแต่ไม่จำกัดเพียงการส่งหรือโอนข้อมูลดังกล่าวไปยังบริษัทในเครือและบริษัทในกลุ่มบริษัทของ ซิตี้ ไดนามิค ซึ่งรวมถึง Swire Properties Hotel Management Limited และบริษัทในเครือ
                                        </span>
                                    </span>
                                </label>
                                @error('consent_transfer')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror

                                <label class="flex items-start gap-3">
                                    <input
                                        type="checkbox"
                                        name="consent_citydynamic_marketing"
                                        value="1"
                                        class="mt-1 h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900"
                                        @checked(old('consent_citydynamic_marketing'))
                                    >
                                    <span>
                                         I hereby consent to City Dynamic’s processing of my full name and contact details to receive marketing information and communications (including real estate project offers)
             from City Dynamic.
                                        <span class="block text-gray-600">
                                            ข้าพเจ้ายินยอมให้ ซิตี้ ไดนามิค ประมวลผลชื่อและนามสกุล และข้อมูลติดต่อของข้าพเจ้า เพื่อให้ข้าพเจ้าได้รับข้อมูลและการติดต่อสื่อสารด้านการตลาด (รวมถึงข้อเสนอเกี่ยวกับโครงการอสังหาริมทรัพย์) จาก ซิตี้ ไดนามิค
                                        </span>
                                    </span>
                                </label>
                                @error('consent_citydynamic_marketing')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror

                                <label class="flex items-start gap-3">
                                    <input
                                        type="checkbox"
                                        name="consent_affiliate_marketing"
                                        value="1"
                                        class="mt-1 h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900"
                                        @checked(old('consent_affiliate_marketing'))
                                    >
                                    <span>
                                         I hereby consent to the disclosure of my full name and contact details to Swire Properties Hotel Management Limited and its affiliates, in accordance with the Privacy Notice,
             in order to receive marketing information and communications (including real estate project offers) from them. I understand that there will be no adverse impact on my rights
             and benefits for not giving consent.
                                        <span class="block text-gray-600">
                                            ข้าพเจ้ายินยอมให้เปิดเผยชื่อและนามสกุล และข้อมูลติดต่อของข้าพเจ้าแก่ Swire Properties Hotel Management Limited และบริษัทในเครือตามนโยบายความเป็นส่วนตัว เพื่อให้ข้าพเจ้าได้รับข้อมูลและการติดต่อสื่อสารด้านการตลาด (รวมถึงข้อเสนอเกี่ยวกับโครงการอสังหาริมทรัพย์) จากบริษัทดังกล่าว ข้าพเจ้าเข้าใจว่าการไม่ให้ความยินยอมจะไม่ส่งผลกระทบเชิงลบต่อสิทธิและประโยชน์ของข้าพเจ้าแต่อย่างใด
                                        </span>
                                    </span>
                                </label>
                                @error('consent_affiliate_marketing')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <p class="text-gray-700">
                                I also understand that I may withdraw my consent at any time by contacting through email address: enquiry@uhresidencesbangkok.com I acknowledge my withdrawal of consent to
                                any processing or transfer does not affect the processing of my personal data which has lawfully been carried out by City Dynamic prior to such withdrawal nor City Dynamic’s ability
                                to process or transfer my personal data without consent where required or permitted by applicable personal data protection laws and regulations.
                                <span class="block text-gray-600">
                                    นอกจากนี้ ข้าพเจ้ารับทราบว่า ข้าพเจ้าสามารถถอนความยินยอมได้ทุกเมื่อ โดยการส่งคำขอไปยังอีเมล enquiry@uhresidencesbangkok.com
 ข้าพเจ้ารับทราบว่าการถอนความยินยอมของข้าพเจ้าในการประมวลผลหรือการส่ง หรือโอนข้อมูลส่วนบุคคลใด ๆ จะไม่ส่งผลกระทบต่อการประมวลผลข้อมูลส่วนบุคคลของข้าพเจ้าที่ ซิตี้ ไดนามิค ได้ดำเนินการไปแล้วโดยชอบด้วยกฎหมายก่อนการถอนความยินยอมดังกล่าว และจะไม่กระทบต่อสิทธิของ ซิตี้ ไดนามิค ในการประมวลผลหรือส่งหรือโอนข้อมูลส่วนบุคคลของข้าพเจ้าโดยไม่ต้องได้รับความยินยอม ในกรณีที่กฎหมายคุ้มครองข้อมูลส่วนบุคคลที่ใช้บังคับกำหนดหรืออนุญาตให้สามารถกระทำได้
                                </span>
                            </p>
                        </div>

                        @error('consent_required')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </section>

                    <section class="p-4 sm:p-6">

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
                            <a href="{{ url()->previous() }}"
                               class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-lg border-gray-300 px-4 py-2 text-sm font-semibold text-white bg-green-600 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                                Submit
                            </button>
                        </div>

                        <p class="mt-10 text-xs text-gray-500 text-center">
                            City Dynamic Co.,Ltd. Unit 6A, 6/F, 140 Wireless Building, 140 Wireless Road, Lumphini, Pathumwan, Bangkok 10330, Thailand
                        </p>
                    </section>
                </form>
            </div>
        </div>
    </div>
@endsection
