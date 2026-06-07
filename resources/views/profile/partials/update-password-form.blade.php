<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="space-y-3">
            <label for="update_password_current_password" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                Current Password
            </label>
            <input type="password" id="update_password_current_password" name="current_password" autocomplete="current-password"
                   class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm placeholder-[#9cab84]/50"/>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div class="space-y-3">
            <label for="update_password_password" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                New Password
            </label>
            <input type="password" id="update_password_password" name="password" autocomplete="new-password"
                   class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm placeholder-[#9cab84]/50"/>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-3">
            <label for="update_password_password_confirmation" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                Confirm New Password
            </label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password"
                   class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm placeholder-[#9cab84]/50"/>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] text-sm font-black rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 group border border-[#9cab84]/40">
                <span>Update Password</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#89986d] font-bold italic">{{ __('Password updated!') }}</p>
            @endif
        </div>
    </form>
</section>
