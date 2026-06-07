<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="space-y-3">
            <label for="name" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                Full Name
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm placeholder-[#9cab84]/50"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div class="space-y-3">
            <label for="email" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                Email Address
            </label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm placeholder-[#9cab84]/50"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 border border-amber-100 rounded-xl">
                    <p class="text-sm text-amber-700 font-medium">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline hover:text-amber-900 transition">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-amber-600 uppercase tracking-wider">
                            {{ __('A new verification link has been sent.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] text-sm font-black rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 group border border-[#9cab84]/40">
                <span>Save Changes</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#89986d] font-bold italic">{{ __('Profile updated!') }}</p>
            @endif
        </div>
    </form>
</section>
