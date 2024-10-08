<x-layouts.main>
    <div class="page-wrapper toggled">

        <!-- Start Page Content -->
        <main class="page-content bg-gray-50 dark:bg-slate-800">
            <div class="container-fluid relative px-3">
                <div class="layout-specing">
                    <!-- Start Content -->
                    <div class="md:flex justify-between items-center">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <x-ad-form :branches="$branches" :ad="$ad"/>

                </div>
            </div><!--end container-->
        </main>
    </div>
</x-layouts.main>
