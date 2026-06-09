<footer class="mt-auto py-12 bg-white border-t border-[#c5d89d]/40">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <!-- Brand Section -->
            <div class="space-y-4">
                <h2 class="text-xl font-black tracking-widest text-[#2d2d2d]">MYPOCKET</h2>
                <p class="text-sm text-[#64748b] leading-relaxed max-w-xs">
                    Your personal financial companion. Manage transactions, track savings, and achieve your financial goals with ease.
                </p>
                <div class="flex gap-4">
                    <a href="https://github.com/Nademmm" class="w-8 h-8 rounded-lg bg-[#faf8ed] border border-[#c5d89d]/30 flex items-center justify-center text-[#89986d] hover:bg-[#c5d89d] hover:text-white transition-all duration-300">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.instagram.com/nademazing/" class="w-8 h-8 rounded-lg bg-[#faf8ed] border border-[#c5d89d]/30 flex items-center justify-center text-[#89986d] hover:bg-[#c5d89d] hover:text-white transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6281252060878" class="w-8 h-8 rounded-lg bg-[#faf8ed] border border-[#c5d89d]/30 flex items-center justify-center text-[#89986d] hover:bg-[#c5d89d] hover:text-white transition-all duration-300">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div><br>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-sm font-black text-[#2d2d2d] uppercase tracking-wider">Quick Navigation</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="text-sm text-[#64748b] hover:text-[#89986d] transition-colors">Dashboard</a></li>
                    <li><a href="{{ route('transactions.index') }}" class="text-sm text-[#64748b] hover:text-[#89986d] transition-colors">Transactions</a></li>
                    <li><a href="{{ route('targets.index') }}" class="text-sm text-[#64748b] hover:text-[#89986d] transition-colors">Savings Targets</a></li>
                    <li><a href="{{ route('savings-arena.index') }}" class="text-sm text-[#64748b] hover:text-[#89986d] transition-colors">Savings Arena</a></li>
                    <li><a href="{{ route('reminders.index') }}" class="text-sm text-[#64748b] hover:text-[#89986d] transition-colors">Reminders</a></li>
                </ul>
            </div>

            <!-- Professional Support Section -->
            <div class="space-y-4">
                <h3 class="text-sm font-black text-[#2d2d2d] uppercase tracking-wider">Financial Security</h3>
                <p class="text-sm text-[#64748b]">
                    Your data is encrypted and stored securely. We prioritize your financial privacy and safety.
                </p>
            </div>
        </div>

        <div class="pt-8 border-t border-[#f1f5f9] flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs font-bold text-[#94a3b8]">
                &copy; {{ date('Y') }} MYPOCKET. All rights reserved.
            </p>
            <div class="flex gap-6 text-[10px] font-bold text-[#94a3b8] uppercase tracking-widest">
                <a href="#" class="hover:text-[#2d2d2d] transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-[#2d2d2d] transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
