<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="mt-5 md:mt-0 md:col-span-2 w-full md:w-auto">
                <form method="POST"
                      action="{{ route('admin.profile.update') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <div class="flex flex-col items-center justify-center"
                                         x-data="imageData()">
                                        <div class="relative w-20 h-20 rounded-full overflow-hidden">
                                            <img id="profile-preview"
                                                 :src="previewUrl !== '' ? previewUrl : (imgurl !== '' ?
                                                     imgurl : '/images/default-profile.png')"
                                                 alt="{{ $user->name }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div class="mt-2">
                                            <label for="profile"
                                                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer">
                                                {{ __('Change') }}
                                            </label>
                                            <button x-show="previewUrl !== ''"
                                                    type="button"
                                                    class="inline-flex items-center ml-2 px-2.5 py-1.5 bg-gray-200 border border-transparent rounded-md text-xs text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                    @click="clearPreview()">
                                                {{ __('Remove') }}
                                            </button>
                                            <input type="file"
                                                   name="profile"
                                                   id="profile"
                                                   class="hidden"
                                                   @change="updatePreview()">
                                        </div>
                                    </div>
                                    @error('profile')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="name"
                                           class="block font-medium text-gray-700">
                                        {{ __('ชื่อผู้ใช้งาน') }}
                                    </label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email"
                                           class="block font-medium text-gray-700">
                                        {{ __('Email') }}
                                    </label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="name"
                                           class="block font-medium text-gray-700">
                                        {{ __('รหัสผ่าน') }}
                                    </label>
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <small class="text-gray-500">ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</small>

                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="col-span-6 sm:col-span-4">
                                    <label for="name"
                                           class="block font-medium text-gray-700">
                                        {{ __('ยืนยันรหัสผ่าน') }}
                                    </label>
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                           </div>


                                </div>
                            </div>
                            <div class="px-4 py-3 text-center sm:px-6 mt-2">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-700 transition ease-in-out duration-150">
                                    {{ __('บันทึก') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function imageData() {
            return {
                previewUrl: "",
                imgurl: '/images/' + @json($user->profile),
                updatePreview() {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewUrl = e.target.result;
                        document.getElementById('profile-preview').src = e.target.result;
                    };
                    const file = document.getElementById('profile').files[0];
                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        this.previewUrl = "";
                    }
                },
                clearPreview() {
                    document.getElementById('profile').value = null;
                    this.previewUrl = "";
                    this.imgurl = '/images/' + @json($user->profile);
                    document.getElementById('profile-preview').src = this.imgurl !== '/images/null' ? this.imgurl :
                        '/images/default-profile.png';
                },
            };
        }
    </script>
</x-app-layout>
