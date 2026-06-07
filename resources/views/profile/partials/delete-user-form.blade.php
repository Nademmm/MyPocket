<section class="space-y-6">
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
            class="px-8 py-4 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] text-white font-black rounded-2xl hover:from-[#c17b7b] hover:to-[#a85a5a] transition-all shadow-xl hover:shadow-red-200/50 border border-[#c17b7b]/40">
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 bg-white rounded-[2.5rem]">
            @csrf
            @method('delete')

            <h2 class="text-3xl font-black text-[#2d2d2d] mb-4">Are you absolutely sure?</h2>

            <p class="text-[#89986d] font-medium mb-8 leading-relaxed">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="space-y-3">
                <label for="password" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">Confirm Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm placeholder-[#9cab84]/50"
                       placeholder="Enter password to confirm"/>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <button type="button" x-on:click="$dispatch('close')" 
                        class="flex-1 py-4 text-[#89986d] hover:text-[#2d2d2d] font-black text-xs uppercase tracking-widest transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 py-4 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white font-black rounded-2xl shadow-xl hover:shadow-red-200/50 transition-all active:scale-95 border border-[#c17b7b]/40">
                    Yes, Delete My Account
                </button>
            </div>
        </form>
    </x-modal>
</section>
