<x-app-layout title="UIComponents">
<!-- Header -->
<div class="mb-8">
    <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">UI Components Library</h1>
    <p class="text-slate-600 dark:text-slate-400">A comprehensive showcase of reusable fintech-style components</p>
</div>
<!-- Components Grid -->
<div class="space-y-12">
    <!-- Buttons Section -->
    <section class="animate-fade-in" style="animation-delay:0.1s;">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Buttons</h2>
            <p class="text-slate-600 dark:text-slate-400">Various button styles and states</p>
        </div>
        <div class="card p-8 rounded-2xl">
            <div class="flex flex-wrap gap-4 mb-8">
                <x-button type="primary">Primary Button</x-button>
                <x-button type="secondary">Secondary Button</x-button>
                <x-button type="outline">Outline Button</x-button>
                <x-button type="ghost">Ghost Button</x-button>
                <x-button type="danger">Danger Button</x-button>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-700 pt-8">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-4">Button Sizes</h4>
                <div class="flex flex-wrap gap-4 items-center">
                    <x-button type="primary" size="sm">Small</x-button>
                    <x-button type="primary" size="md">Medium</x-button>
                    <x-button type="primary" size="lg">Large</x-button>
                    <x-button type="primary" size="xl">Extra Large</x-button>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-700 pt-8 mt-8">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-4">With Icons</h4>
                <div class="flex flex-wrap gap-4">
                    <x-button type="primary"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Item</x-button>
                    <x-button type="secondary"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-1m-4-4l-4-4m0 0l-4-4m4 4V4"/></svg>Download</x-button>
                    <x-button type="outline"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 0l-7 7 7 7"/></svg>Go Back</x-button>
                </div>
            </div>
        </div>
    </section>
    <!-- Form Inputs Section -->
    <section class="animate-fade-in" style="animation-delay:0.2s;">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Form Inputs</h2>
            <p class="text-slate-600 dark:text-slate-400">Input fields with validation states</p>
        </div>
        <div class="card p-8 rounded-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white mb-6">Basic Inputs</h4>
                    <x-form-input name="email" label="Email Address" type="email" placeholder="you@example.com"/>
                    <x-form-input name="password" label="Password" type="password" placeholder="••••••••"/>
                    <x-form-input name="amount" label="Amount" type="number" placeholder="0.00"/>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white mb-6">With Icons & Errors</h4>
                    <x-form-input name="search" label="Search Transactions" placeholder="Search..." icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2121l-6-6m2-5a77011-14077001140z"/></svg>'/>
                    <x-form-input name="invalid" label="Invalid Input" placeholder="This has an error" error="This field is required"/>
                </div>
            </div>
        </div>
    </section>
    <!-- Stat Cards Section -->
    <section class="animate-fade-in" style="animation-delay:0.3s;">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Stat Cards</h2>
            <p class="text-slate-600 dark:text-slate-400">Display key metrics and KPIs</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-stat-card label="Total Revenue" icon='<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M44a22000-22v4a2200022V6h10a22000-2-2H4zm26a220012-2h8a2200122v4a22001-22H8a22001-2-2v-4zm64a220100-42200004z"/></svg>' trend="12" trend-label="vslastmonth" gradient="true">
                <div class="text-3xl font-bold text-white">₱125,400</div>
            </x-stat-card>
            <x-stat-card label="Active Users" icon='<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M96a33011-603300160zM912a66011-12066001120z"/></svg>' trend="8" trend-label="vslastmonth">
                <div class="text-3xl font-bold text-slate-900 dark:text-white">2,847</div>
            </x-stat-card>
            <x-stat-card label="Conversion Rate" trend="-3" trend-label="vslastmonth">
                <div class="text-3xl font-bold text-slate-900 dark:text-white">3.24%</div>
            </x-stat-card>
        </div>
    </section>
    <!-- Progress Bars Section -->
    <section class="animate-fade-in" style="animation-delay:0.4s;">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Progress Bars</h2>
            <p class="text-slate-600 dark:text-slate-400">Track goal progress with visual indicators</p>
        </div>
        <div class="card p-8 rounded-2xl space-y-8">
            <div>
                <h4 class="font-semibold text-slate-900 dark:text-white mb-6">Color Variants</h4>
                <div class="space-y-6">
                    <x-progress-bar value="75" max="100" label="PrimaryProgress" color="primary"/>
                    <x-progress-bar value="60" max="100" label="SecondaryProgress" color="secondary"/>
                    <x-progress-bar value="45" max="100" label="AccentProgress" color="accent"/>
                    <x-progress-bar value="20" max="100" label="DangerProgress" color="red"/>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-700 pt-8">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-6">Without Labels</h4>
                <div class="space-y-4">
                    <x-progress-bar value="85" max="100" :show-label="false"/>
                    <x-progress-bar value="50" max="100" color="secondary" :show-label="false"/>
                    <x-progress-bar value="30" max="100" color="accent" :show-label="false"/>
                </div>
            </div>
        </div>
    </section>
    <!-- Badges Section -->
    <section class="animate-fade-in" style="animation-delay:0.5s;">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Badges</h2>
            <p class="text-slate-600 dark:text-slate-400">Labels and status indicators</p>
        </div>
        <div class="card p-8 rounded-2xl">
            <div class="flex flex-wrap gap-4">
                <span class="badge badge-primary"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M1018a880100-1688000016zm3.707-9.293a11000-1.414-1.414L910.5867.7079.293a11000-1.4141.414l22a110001.4140l4-4z" clip-rule="evenodd"/></svg>LightGray</span>
                <span class="badge badge-secondary"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M1018a880100-1688000016zm3.707-9.293a11000-1.414-1.414L910.5867.7079.293a11000-1.4141.414l22a110001.4140l4-4z" clip-rule="evenodd"/></svg>MidGray</span>
                <span class="badge badge-accent"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M1018a880100-1688000016zm3.707-9.293a11000-1.414-1.414L910.5867.7079.293a11000-1.4141.414l22a110001.4140l4-4z" clip-rule="evenodd"/></svg>DarkGray</span>
            </div>
        </div>
    </section>
    <!-- Color Palette -->
    <section class="animate-fade-in" style="animation-delay:0.6s;">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Color Palette</h2>
            <p class="text-slate-600 dark:text-slate-400">Monochromatic color scheme</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Primary Colors -->
            <div class="card p-8 rounded-2xl">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-6">LightGray</h4>
                <div class="space-y-3">
                    @foreach([50,100,200,300,400,500,600,700,800,900]as$shade)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-gray-{{$shade}} border border-slate-200 dark:border-slate-600"></div>
                        <span class="text-sm font-monotext-slate-600 dark:text-slate-400">gray-{{$shade}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Secondary Colors -->
            <div class="card p-8 rounded-2xl">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-6">MidGray</h4>
                <div class="space-y-3">
                    @foreach([50,100,200,300,400,500,600,700,800,900]as$shade)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-gray-{{$shade}} border border-slate-200 dark:border-slate-600"></div>
                        <span class="text-sm font-monotext-slate-600 dark:text-slate-400">gray-{{$shade}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Accent Colors -->
            <div class="card p-8 rounded-2xl">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-6">DarkGray</h4>
                <div class="space-y-3">
                    @foreach([50,100,200,300,400,500,600,700,800,900]as$shade)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-gray-{{$shade}} border border-slate-200 dark:border-slate-600"></div>
                        <span class="text-sm font-monotext-slate-600 dark:text-slate-400">gray-{{$shade}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Neutral Colors -->
            <div class="card p-8 rounded-2xl">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-6">Neutral(Gray)</h4>
                <div class="space-y-3">
                    @foreach([50,100,200,300,400,500,600,700,800,900]as$shade)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-gray-{{$shade}} border border-slate-200 dark:border-slate-600"></div>
                        <span class="text-sm font-monotext-slate-600 dark:text-slate-400">gray-{{$shade}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Typography -->
    <section class="animate-fade-in" style="animation-delay:0.7s;">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Typography</h2>
            <p class="text-slate-600 dark:text-slate-400">Heading and text styles</p>
        </div>
        <div class="card p-8 rounded-2xl space-y-8">
            <div>
                <h1 class="text-5xl font-bold text-slate-900 dark:text-white mb-2">Heading1(5xl,bold)</h1>
                <p class="text-slate-600 dark:text-slate-400">Used for page titles and main headings</p>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-700 pt-8">
                <h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">Heading2(4xl,bold)</h2>
                <p class="text-slate-600 dark:text-slate-400">Used for section titles</p>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-700 pt-8">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Heading3(2xl,bold)</h3>
                <p class="text-slate-600 dark:text-slate-400">Used for subsection titles</p>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-700 pt-8">
                <p class="text-basetext-slate-900 dark:text-white mb-2">Body Text(base)</p>
                <p class="text-slate-600 dark:text-slate-400">This is regular body text used for main content throughout the application.</p>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-700 pt-8">
                <p class="text-sm text-slate-600 dark:text-slate-400">Small Text(sm)</p>
                <p class="text-xs text-slate-500 dark:text-slate-400mt-2">Extra Small Text(xs)</p>
            </div>
        </div>
    </section>
</x-app-layout>





