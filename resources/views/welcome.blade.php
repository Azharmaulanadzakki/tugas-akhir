@extends('layout.app')
@section('content')

    <body class="bg-gray-100">

        <!-- Hero Section -->
        <header class="text-gray-800 py-8 sm:py-12 md:py-16 lg:py-20 px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12">

                <div class="container mx-auto text-center">
                    <div class="text-[#55c097] text-lg font-bold text-left">#SemangatCogg</div>
                    <h1
                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl mt-4 sm:mt-6 md:mt-8 font-bold leading-tight text-left">
                        Your Dream Career Starts With Us
                    </h1>
                    <div class="text-gray-400 text-base sm:text-lg md:text-xl text-left mt-4 sm:mt-6 md:mt-8 xl:w-[25rem]">
                        LearnWithAzhar menyediakan kelas UI/UX design, Prototyping, dan Quiz UI/UX untuk pemula.
                    </div>

                    <div class="w-full md:w-[16rem] mt-6 sm:mt-8 md:mt-10">
                        <a href="{{ route('login') }}"
                            class="text-left font-bold inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 sm:px-8 rounded-full text-base sm:text-lg md:text-base lg:text-lg xl:text-base transition duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="ml-4 sm:ml-5 text-left font-bold inline-block bg-gray-200 hover:shadow-xl text-gray-900 py-2 px-4 sm:px-6 rounded-full text-base sm:text-lg md:text-base lg:text-lg xl:text-base transition duration-300">
                            Register
                        </a>
                    </div>
                </div>

                <div class="hidden md:block">
                    <img class="rounded-xl" src="https://i.pinimg.com/736x/8a/ed/3b/8aed3badcde62dcd68780e1be562611c.jpg"
                        alt="">
                </div>

            </div>
        </header>

        <!-- Features Section -->
        <section class="mx-20">

            <div class="container mx-auto py-16 px-4">
                <h1 class="text-4xl font-semibold mb-8 text-center">Discover a most popular Online Course</h1>
                <div class="flex items-center justify-center">
                    <form action="{{ route('home.index') }}" method="GET">
                        <div
                            class="mx-auto relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border py-2 px-2 rounded-2xl gap-2 shadow-2xl focus-within:border-gray-300">
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search course"
                                class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white">
                            <button type="submit"
                                class="w-full md:w-auto px-6 py-3 bg-black border-black text-white fill-white active:scale-110 duration-300 border will-change-transform overflow-hidden relative rounded-xl transition-all disabled:opacity-70">

                                <div class="relative">

                                    <!-- Loading animation change opacity to display -->
                                    <div
                                        class="flex items-center justify-center h-3 w-3 absolute inset-1/2 -translate-x-1/2 -translate-y-1/2 transition-all">
                                        <svg class="opacity-0 animate-spin w-full h-full" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>

                                    <div class="flex items-center transition-all opacity-1 valid:"><span
                                            class="text-sm font-semibold whitespace-nowrap truncate mx-auto">
                                            Search
                                        </span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- untuk card --}}
            <section class="mx-11 my-6">
                {{-- grid --}}
                <div class="owl-carousel grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($mapels as $index => $mapel)
                        <div id="mapel-list-{{ $index }}" class="rounded-xl shadow-lg mapel-item"
                            data-index="{{ $index }}">
                            <div class="rounded-xl shadow-lg">
                                <div class="rounded-b-none rounded-t-xl overflow-hidden">
                                    <img src="{{ asset('/storage/mapels/' . $mapel->image) }}" alt=""
                                        class="aspect-[1/1] w-full h-full">
                                </div>
                                <div class="p-2 sm:p-4 flex flex-col">
                                    <h5 class="text-md font-medium mt-3"> {{ $mapel->judul }}</h5>
                                    <h7 class="text-md font-semibold"> Rp.{{ $mapel->harga }}</h7>
                                    {{-- <p class="text-slate-400 text-base mt-3"> {{ $mapel->description }} </p> --}}
                                    <form action="{{ route('materi', ['parent_id' => $mapel->id]) }}">
                                        <button
                                            class="my-3 rounded-md px-4 sm:px-3 py-2 text-sm bg-indigo-500 text-white font-semibold hover:bg-indigo-600 duration-300">
                                            Lihat Materi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button id="showMoreBtn"
                    class="my-3 rounded-md px-9 py-2 bg-black text-white font-semibold hover:bg-gray-900 duration-300">Show
                    More
                </button>

                <button id="lessMoreBtn" style="display: none; "
                    class="my-3 rounded-md px-9 py-2 bg-black text-white font-semibold hover:bg-gray-900 duration-300">Less
                    More
                </button>

            </section>
            {{-- end card --}}

            @include('components.about')

        </section>
        
        @include('components.scroll')
        @include('components.infinite-scroll')



        {{-- script untuk show more --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const mapelItems = document.querySelectorAll(".mapel-item");
                const showMoreBtn = document.getElementById("showMoreBtn");
                const lessMoreBtn = document.getElementById("lessMoreBtn");
                const seacrhBtn = document.getElementById("seacrhBtn");

                // Semua elemen dengan indeks lebih besar dari 7 akan disembunyikan
                mapelItems.forEach((item, index) => {
                    if (index > 7) {
                        item.style.display = "none";
                    }
                });

                // Tambahkan event listener pada tombol "Show More"
                showMoreBtn.addEventListener("click", function() {
                    mapelItems.forEach((item, index) => {
                        item.style.display = "block";
                    });
                    // Sembunyikan tombol "Show More" dan tampilkan tombol "Less More"
                    showMoreBtn.style.display = "none";
                    lessMoreBtn.style.display = "block";
                });

                // Tambahkan event listener pada tombol "Less More"
                lessMoreBtn.addEventListener("click", function() {
                    // Semua elemen dengan indeks lebih besar dari 7 akan disembunyikan
                    mapelItems.forEach((item, index) => {
                        if (index > 7) {
                            item.style.display = "none";
                        }
                    });
                    // Tampilkan tombol "Show More" dan sembunyikan tombol "Less More"
                    showMoreBtn.style.display = "block";
                    lessMoreBtn.style.display = "none";
                    seacrhBtn.style.display = "none";
                });

                // Tambahkan event listener pada tombol "Seach"
                seacrhBtn.addEventListener("click", function() {
                    // Tampilkan tombol "Show More" dan sembunyikan tombol "Less More"
                    showMoreBtn.style.display = "block";
                    lessMoreBtn.style.display = "none";
                });
            });
        </script>

    </body>
@endsection
