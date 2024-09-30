<div class="container relative mt-28">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-6 mt-6">
        <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
            <div>
                <p class="font-medium mb-4">Rasmni shu yerga olib keling yoki "Rasm yuklash" tugmasini bosing</p>
                <div
                    class="preview-box flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small w-auto max-h-60">
                    Qabul qilinadigan kengaytmalar: JPG, PNG
                    <br> Hajm bo'yicha cheklov: 10MB
                </div>
                <input form="ads-create" type="file" id="input-file" name="image" accept="image/*"
                       onchange={handleChange()} hidden>
                <label
                    class="btn-upload btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-6 cursor-pointer"
                    for="input-file">
                    <i class="mdi mdi-upload me-2"></i>Rasm yuklash
                </label>
            </div>
        </div>

        <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
            <form id="ads-create" action="{{ route('create.ad') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (request()->route()->getName() === 'ads.update')
                    <input type="hidden" name="_method" value="patch">
                @endif
                <div class="grid grid-cols-12 gap-5">
                    <!-- Title -->
                    <div class="col-span-12">
                        <label for="title" class="font-medium">Sarlavha:</label>
                        <div class="form-icon relative mt-2">
                            <i class="fa-solid fa-t text-xl absolute top-7 left-3 -translate-y-1/2 text-gray-500"></i>
                            <input name="title" id="title" type="text" class="form-input pl-9 mt-2" placeholder="Sarlavha" value="{{ $ad?->title }}">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-12">
                        <label for="description" class="font-medium">Ta'rif:</label>
                        <div class="form-icon relative mt-2">
                            <i class="fa-regular fa-clipboard text-xl absolute top-5 left-3 -translate-y-1/2 text-gray-500"></i>
                            <textarea name="description" id="description" class="form-input ps-11" placeholder="E'lon bo'yicha ta'rif...">{{ $ad?->description }}</textarea>
                        </div>
                    </div>

                    <!-- Gender and Branch -->
                    <div class="flex space-x-4 col-span-12">
                        <div class="flex-1">
                            <label for="gender" class="font-medium">Jinsi:</label>
                            <div class="form-icon relative mt-2">
                                <i class="fa-solid fa-venus-mars text-xl absolute top-2 left-3 text-gray-500"></i>
                                <select class="form-select pl-11 form-input w-full py-2 h-10 bg-white dark:bg-slate-900 dark:text-slate-200 rounded border border-gray-300 focus:border-gray-400 dark:border-gray-700 focus:ring-0" id="gender" name="gender">
                                    <option value="male" {{ (isset($ad) && $ad->gender === 'male') ? 'selected' : '' }}>Erkak</option>
                                    <option value="female" {{ (isset($ad) && $ad->gender === 'female') ? 'selected' : '' }}>Ayol</option>
                                    <option value="other" {{ (isset($ad) && $ad->gender === 'other') ? 'selected' : '' }}>Jins Yoq</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex-1">
                            <label for="branch" class="font-medium">Filial:</label>
                            <div class="form-icon relative mt-2">
                                <i class="fa-solid fa-code-branch text-xl absolute top-2 left-3 text-gray-500"></i>
                                <select class="form-select pl-11 form-input w-full py-2 h-10 bg-white dark:bg-slate-900 dark:text-slate-200 rounded border border-gray-300 focus:border-gray-400 dark:border-gray-700 focus:ring-0" id="branch" name="branch_id">
                                    {{ isset($ad) ? '' : "<option value='0'>Filialni tanlang</option>" }}
                                    @foreach ($branches as $branch)
                                        <option value='{{ $branch->id }}' {{ (isset($ad) && $branch->id === $ad->branch_id) ? 'selected' : '' }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-span-12">
                        <label for="address" class="font-medium">Manzil:</label>
                        <div class="form-icon relative mt-2">
                            <i class="fa-solid fa-location-dot text-xl absolute top-1 left-3 text-gray-500"></i>
                            <input name="address" id="address" type="text" class="form-input pl-9" placeholder="Manzil:" value="{{ $ad?->address }}">
                        </div>
                    </div>

                    <!-- Price and Rooms -->
                    <div class="flex space-x-4 col-span-12">
                        <div class="flex-1">
                            <label for="price" class="font-medium">Narxi:</label>
                            <div class="form-icon relative mt-2">
                                <i class="fa-solid fa-hand-holding-dollar text-xl absolute top-2 left-3 text-gray-500"></i>
                                <input name="price" id="price" type="number" class="form-input ps-11" placeholder="Narxi($):" value="{{ $ad?->price }}">
                            </div>
                        </div>

                        <div class="flex-1">
                            <label for="rooms" class="font-medium">Xonalar:</label>
                            <div class="form-icon relative mt-2">
                                <i class="fa-solid fa-house text-xl absolute top-2 left-3 text-gray-500"></i>
                                <input name="rooms" id="rooms" type="number" class="form-input ps-11" placeholder="Xonalar:" value="{{ $ad?->rooms }}">
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-4 col-span-12">
                        <div class="flex-1">
                            <label for="square" class="font-medium">Maydon:</label>
                            <div class="form-icon relative mt-2">
                                <i class="fa-solid fa-ruler-combined text-xl absolute top-2 left-3 text-gray-500"></i>
                                <input name="square" id="square" type="number" class="form-input ps-11" placeholder="Maydon (m²):" value="{{ $ad?->square }}">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" id="submit" name="send" class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-5">
                    <i class="mdi mdi-content-save me-2"></i>
                    Saqlash
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const handleChange = () => {
        const fileUploader = document.querySelector('#input-file');
        const getFile = fileUploader.files
        if (getFile.length !== 0) {
            const uploadedFile = getFile[0];
            readFile(uploadedFile);
        }
    }

    const readFile = (uploadedFile) => {
        if (uploadedFile) {
            const reader = new FileReader();
            reader.onload = () => {
                const parent = document.querySelector('.preview-box');
                parent.innerHTML = `<img class="preview-content" src=${reader.result} />`;
            };

            reader.readAsDataURL(uploadedFile);
        }
    };
</script>
