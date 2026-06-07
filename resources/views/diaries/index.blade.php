<x-app-layout title="Saving Diary">
    <!-- Header Section -->
    <div class="mb-16">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-4xl md:text-5xl font-black text-[#2d2d2d] mb-3 tracking-tight">Saving Diary.</h1>
                <p class="text-[#89986d] text-lg font-medium">Capture your financial journey, one reflection at a time.</p>
            </div>
            <a href="{{ route('diaries.create') }}" class="inline-flex items-center gap-3 px-4 py-4 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-black rounded-xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 active:scale-95 group relative z-10 border border-[#9cab84]/40 w-fit shrink-0">
                <div class="w-5 h-5 bg-white/40 rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                    <svg class="w-3.5 h-3.5 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="uppercase tracking-widest text-[10px]">Write Diary</span>
            </a>
        </div>
    </div>
    <br>

    <!-- Success Message -->
    @if($message = Session::get('success'))
        <div class="mb-8 p-5 bg-white border-l-4 border-[#c5d89d] rounded-2xl shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-[#c5d89d]/20 rounded-full flex items-center justify-center text-[#6b7854]">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </div>
                <span class="font-bold text-[#2d2d2d]">{{ $message }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-[#89986d] hover:text-[#2d2d2d] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <!-- Diary Feed -->
    @if($diaries->count())
        <div class="max-w-4xl">
            <div class="space-y-12">
                @foreach($diaries as $diary)
                    <article class="relative pl-8 md:pl-12 group">
                        <!-- Timeline Line -->
                        <div class="absolute left-0 top-0 bottom-0 w-px bg-gradient-to-b from-[#c5d89d] via-[#c5d89d]/30 to-transparent"></div>
                        <!-- Timeline Dot -->
                        <div class="absolute left-[-4px] top-2 w-2 h-2 rounded-full bg-[#c5d89d] ring-4 ring-white group-hover:scale-150 group-hover:bg-[#89986d] transition-all duration-300"></div>

                        <div class="bg-white border border-[#c5d89d]/20 rounded-[2.5rem] p-8 md:p-10 shadow-sm hover:shadow-2xl hover:border-[#c5d89d]/40 transition-all duration-500 relative overflow-hidden">
                            <!-- Decorative background -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#faf8ed] rounded-bl-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-700 opacity-50"></div>

                            <header class="relative flex items-start justify-between gap-4 mb-6">
                                <div class="flex-1">
                                    <time class="text-[10px] font-black uppercase tracking-[0.2em] text-[#9cab84] mb-2 block">
                                        {{ $diary->diary_date->format('l, F d, Y') }}
                                    </time>
                                    <h2 class="text-2xl md:text-3xl font-black text-[#2d2d2d] leading-tight group-hover:text-[#6b7854] transition-colors">
                                        <a href="{{ route('diaries.show', $diary->id) }}">{{ $diary->title }}</a>
                                    </h2>
                                </div>
                                <div class="flex gap-2 shrink-0">
                                    <a href="{{ route('diaries.edit', $diary->id) }}" class="p-2 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] rounded-xl transition border border-[#9cab84]/40 shadow-sm" title="Edit Diary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('diaries.destroy', $diary->id) }}" method="POST" class="inline" onsubmit="return confirm('Archive this diary?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white rounded-xl transition border border-[#c17b7b]/40 shadow-sm" title="Delete Diary">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </header>

                            <section class="relative">
                                <p class="text-[#6b7854] text-base md:text-lg leading-relaxed line-clamp-4 mb-8">
                                    {{ $diary->content }}
                                </p>
                            </section>

                            <footer class="relative flex items-center justify-between border-t border-[#faf8ed] pt-6">
                                <a href="{{ route('diaries.show', $diary->id) }}" class="inline-flex items-center gap-2 text-sm font-black text-[#2d2d2d] hover:text-[#6b7854] transition-colors group/link">
                                    Read Full Diary
                                    <svg class="w-4 h-4 transform group-hover/link:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#c5d89d]"></span>
                                    <span class="text-[10px] font-bold text-[#9cab84] uppercase tracking-wider">
                                        {{ $diary->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                            </footer>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $diaries->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white border border-[#c5d89d]/30 rounded-[3rem] p-16 md:p-24 text-center shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-[#faf8ed] to-white opacity-50"></div>
            <div class="relative z-10">
                <div class="w-24 h-24 bg-[#faf8ed] border border-[#c5d89d]/30 rounded-3xl flex items-center justify-center mx-auto mb-8 text-[#6b7854] rotate-3 hover:rotate-0 transition-transform duration-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-[#2d2d2d] mb-4">The diary is empty, but your journey isn't.</h3>
                <p class="text-[#89986d] text-lg mb-10 max-w-md mx-auto leading-relaxed font-medium">Your financial reflections belong here. Start writing your first entry to see your diary unfold.</p>
                <a href="{{ route('diaries.create') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-[#89986d] text-white hover:bg-[#6b7854] font-bold rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 active:scale-95 group">
                    Begin Your Diary
                </a>
            </div>
        </div>
    @endif
</x-app-layout>
